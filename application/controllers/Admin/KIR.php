<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kir_model');
    }

    public function index()
{
    $this->load->library('pagination');

    $keyword = $this->input->get('search') ?? '';

    $config['base_url']   = site_url('admin/kir/index');
    $config['total_rows'] = $this->Kir_model->count_all($keyword);

    // 🔥 LIMIT
    $limit = $this->input->get('limit');

    if ($limit == 'all') {
        $config['per_page'] = $config['total_rows'];
    } elseif ($limit) {
        $config['per_page'] = (int)$limit;
    } else {
        $config['per_page'] = 10;
    }

    $config['uri_segment'] = 4;
    $config['reuse_query_string'] = TRUE;

    // 🔥 STYLE BOOTSTRAP
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = false;
    $config['last_link'] = false;

    $config['prev_link'] = '<i class="bx bx-chevrons-left"></i>';
    $config['next_link'] = '<i class="bx bx-chevrons-right"></i>';

    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    $page = (int) $this->uri->segment(4);
    $page = ($page) ? $page : 0;

    $data['kir'] = $this->Kir_model->get_paginated(
        $config['per_page'],
        $page,
        $keyword
    );

    $data['start'] = $page;
    $data['links'] = $this->pagination->create_links();
    $data['limit'] = $limit;

    // ini tetap
    $data['lokasi'] = $this->Kir_model->get_lokasi();
    $data['barang'] = $this->Kir_model->get_barang();

    $this->load->view('admin/kir', $data);
}
    
public function get_barang_by_lokasi($id_lokasi)
{
    $lokasi = $this->db->where('id', $id_lokasi)->get('master_lokasi')->row();

    if (!$lokasi) {
        echo json_encode([]);
        return;
    }

    $merged = [];

    // 1. Data KIR (input form terbaru)
    $data_kir = $this->db
        ->select('k.kode_barang, MAX(m.nama_barang) as nama_barang, SUM(k.jumlah) as jumlah')
        ->from('kir k')
        ->join('master_barang_modal m', 'm.kode_barang = k.kode_barang', 'left')
        ->where('k.id_lokasi', $id_lokasi)
        ->group_by('k.kode_barang')
        ->get()
        ->result_array();

    foreach ($data_kir as $row) {
        $kb = $row['kode_barang'];
        $merged[$kb] = [
            'kode_barang' => $kb,
            'nama_barang' => $row['nama_barang'] ?? $kb,
            'jumlah'      => (int) $row['jumlah']
        ];
    }

    // 2. Data dari Permintaan (input dari menu Permintaan)
    $data_permintaan = $this->db
        ->select('d.kode_barang, MAX(d.nama_barang) as nama_barang, SUM(d.jumlah_persetujuan) as jumlah_setuju, SUM(d.jumlah) as jumlah_awal')
        ->from('detail_permintaan d')
        ->join('permintaan_barang p', 'p.kode_unik = d.kode_unik', 'left')
        ->where('p.lokasi_tujuan', $lokasi->lokasi)
        ->group_by('d.kode_barang')
        ->get()
        ->result_array();

    foreach ($data_permintaan as $row) {
        $kb = $row['kode_barang'];
        // Pakai jumlah persetujuan jika > 0, kalau tidak pakai jumlah awal
        $jml = (int) $row['jumlah_setuju'] > 0 ? (int) $row['jumlah_setuju'] : (int) $row['jumlah_awal'];
        
        if (!isset($merged[$kb])) {
            $merged[$kb] = [
                'kode_barang' => $kb,
                'nama_barang' => $row['nama_barang'] ?? $kb,
                'jumlah'      => $jml
            ];
        } else {
            // Tambahkan jumlah jika barang sama
            $merged[$kb]['jumlah'] += $jml;
        }
    }

    echo json_encode(array_values($merged));
}

public function simpan()
{
    header('Content-Type: application/json');

    $id_lokasi   = $this->input->post('id_lokasi');
    $kode_barang = $this->input->post('kode_barang');
    $jumlah      = $this->input->post('jumlah');
    $keterangan  = $this->input->post('keterangan');

    if (!$id_lokasi || empty($kode_barang) || !is_array($kode_barang)) {
        echo json_encode(['status' => 'error', 'msg' => 'Data kosong']);
        return;
    }

    foreach ($kode_barang as $i => $kb) {
        if (!$kb) continue;

        $jml = isset($jumlah[$i]) ? (int) $jumlah[$i] : 0;
        $ket = isset($keterangan[$i]) ? $keterangan[$i] : null;

        // Cek apakah kombinasi id_lokasi + kode_barang sudah ada
        $existing = $this->db
            ->where('id_lokasi', $id_lokasi)
            ->where('kode_barang', $kb)
            ->get('kir')
            ->row();

        if ($existing) {
            // Barang sama → tambah jumlah
            $this->db
                ->where('id_lokasi', $id_lokasi)
                ->where('kode_barang', $kb)
                ->update('kir', [
                    'jumlah'     => $existing->jumlah + $jml,
                    'keterangan' => $ket
                ]);
        } else {
            // Barang baru → insert
            $this->db->insert('kir', [
                'id_lokasi'   => $id_lokasi,
                'kode_barang' => $kb,
                'jumlah'      => $jml,
                'keterangan'  => $ket
            ]);
        }
    }

    echo json_encode(['status' => 'success']);
}

public function get_detail($id)
{
    try {

        $data = $this->db
            ->select('k.kode_barang, MAX(k.jumlah) as jumlah, MAX(k.keterangan) as keterangan, MAX(m.nama_barang) as nama_barang')
            ->from('kir k')
            ->join('master_barang_modal m', 'm.kode_barang = k.kode_barang', 'left')
            ->where('k.id_lokasi', $id)
            ->group_by('k.kode_barang')
            ->get()
            ->result();

        echo json_encode($data);

    } catch (Exception $e) {
        echo json_encode([
            'error' => $e->getMessage()
        ]);
    }
}

public function simpan_permintaan()
{
    header('Content-Type: application/json');

    $raw  = file_get_contents('php://input');
    $post = json_decode($raw, true);

    $id_lokasi   = $post['id_lokasi']   ?? null;
    $nama_lokasi = $post['nama_lokasi'] ?? null;
    $items       = $post['items']       ?? [];

    if (!$id_lokasi || empty($items)) {
        echo json_encode(['status' => 'error', 'msg' => 'Data kosong']);
        return;
    }

    try {
        $kode_unik = 'KIR-' . date('YmdHis') . '-' . $id_lokasi;

        // sesuai kolom tabel permintaan_barang
        $this->db->insert('permintaan_barang', [
            'kode_unik'     => $kode_unik,
            'nomor_lokasi'  => (int) $id_lokasi, 
            'lokasi_tujuan' => $nama_lokasi,
            'tanggal'       => date('Y-m-d'),
        ]);

        $id_permintaan = $this->db->insert_id();

        foreach ($items as $item) {
            if (empty($item['kode_barang'])) continue;

            // sesuai kolom tabel detail_permintaan
            $this->db->insert('detail_permintaan', [
                'id_permintaan' => $id_permintaan,
                'kode_unik'     => $kode_unik,
                'kode_barang'   => $item['kode_barang'],
                'nama_barang'   => $item['nama_barang'],
                'jumlah'        => (int) $item['jumlah'],
                'lokasi_tujuan' => $nama_lokasi,
            ]);
        }

        echo json_encode(['status' => 'success', 'id_permintaan' => $id_permintaan]);

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
    }
}
public function export_kir($id)
{
    $permintaan = $this->db->where('id', $id)->get('permintaan_barang')->row();

    $this->load->library('pdf');

    $permintaan = $this->db
        ->where('id', $id)
        ->get('permintaan_barang')
        ->row();

    if (!$permintaan) show_error('Data tidak ditemukan');
    
    $id_lokasi = $permintaan->nomor_lokasi;

    $lokasi = $this->db
    ->select('l.lokasi, p.ruangan, p.nomor_ruangan')
    ->from('master_lokasi l')
    ->join('master_posisi_barang p', 'p.id_lokasi = l.id', 'left')
    ->where('l.id', $id_lokasi)   // pakai id langsung, bukan string lokasi
    ->limit(1)
    ->get()
    ->row();

    $data['ruangan'] = $lokasi
    ? ($lokasi->nomor_ruangan ?? '-') . ' - ' . ($lokasi->ruangan ?? '-')
    : ($permintaan->lokasi_tujuan ?? '-');

    $data['lokasi']  = $permintaan->lokasi_tujuan ?? '-';
    $data['tanggal'] = $permintaan->tanggal ?? '-';

    $data['kir'] = $this->db
    ->select('
        d.kode_barang,
        d.nama_barang,
        MAX(m.no_register) as no_register,
        MAX(m.merk_type) as merk_type,
        MAX(m.tahun_pengadaan) as tahun_pengadaan,
        SUM(d.jumlah) as jumlah
    ')
    ->from('detail_permintaan d')
    ->join('master_barang_modal m', 'm.kode_barang = d.kode_barang', 'left')
    ->where('d.id_permintaan', $id)
    ->group_by([
        'd.kode_barang',
        'd.nama_barang'
    ])
    ->get()
    ->result();
    

    foreach ($data['kir'] as $k) {
        $k->kode_barang = $k->kode_barang ?? '-';
        $k->nama_barang = $k->nama_barang ?? '-';
        $k->jumlah      = $k->jumlah ?? 0;
        $k->keterangan  = $k->keterangan ?? '-';
    }

    $html = $this->load->view('admin/export_kir', $data, true);
    ob_end_clean();

    $pdf = new Pdf('P', 'mm', 'A4');
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetFont('times', '', 10);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('KIR.pdf', 'I');
}

public function get_permintaan_terakhir($id_lokasi)
{
    header('Content-Type: application/json');

    $lokasi = $this->db->where('id', $id_lokasi)->get('master_lokasi')->row();

    if (!$lokasi) {
        echo json_encode(['id_permintaan' => null]);
        return;
    }

    $permintaan = $this->db
        ->where('lokasi_tujuan', $lokasi->lokasi)
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('permintaan_barang')
        ->row();

    echo json_encode([
        'id_permintaan' => $permintaan ? $permintaan->id : null
    ]);
}

public function hapus_kir_item()
{
    $id_lokasi   = $this->input->post('id_lokasi');
    $kode_barang = $this->input->post('kode_barang');

    $this->db
        ->where('id_lokasi', $id_lokasi)
        ->where('kode_barang', $kode_barang)
        ->delete('kir');

    echo json_encode(['status' => 'success']);
}
}