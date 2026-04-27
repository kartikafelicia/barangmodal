<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('upload');
    }

    public function index()
{
    $data['barang'] = $this->db
        ->get('master_barang_modal')
        ->result();

    $data['lokasi'] = $this->db
        ->get('master_lokasi')
        ->result();

    $data['permintaan'] = $this->db
        ->order_by('id', 'DESC')
        ->get('permintaan_barang')
        ->result();

    $this->load->view('admin/permintaan/permintaan', $data);
}

public function get_detail($kode_unik = null)
{
    header('Content-Type: application/json');

    if (!$kode_unik) {
        echo json_encode([]);
        return;
    }

    $data = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('detail_permintaan')
        ->result_array();

    echo json_encode($data);
}


public function update_kondisi()
{
    $id = $this->input->post('id');
    $kondisi = $this->input->post('kondisi');

    $this->db->where('id', $id);
    $this->db->update('detail_permintaan', ['kondisi' => $kondisi]);

    echo json_encode(['status' => 'success']);
}

public function hapus_detail()
{
    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->delete('detail_permintaan');

    echo json_encode(['status' => 'deleted']);
}

/* =====================================
   NOTA PERMINTAAN
===================================== */
public function cetak_nota($kode_unik)
{
    $this->load->library('pdf');

    // 🔥 ambil data header
    $permintaan = $this->db
        ->get_where('permintaan_barang', ['kode_unik' => $kode_unik])
        ->row();

    if (!$permintaan) {
        show_error('Data tidak ditemukan');
    }

    // 🔥 ambil detail
    $detail = $this->db
        ->get_where('detail_permintaan', ['kode_unik' => $kode_unik])
        ->result();

    $data = [
        'permintaan' => $permintaan,
        'detail'     => $detail
    ];

    // 🔥 load view jadi HTML
    $html = $this->load->view('admin/permintaan/export_nota', $data, true);

    // 🔥 generate PDF
    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
    $pdf->AddPage();
    $pdf->SetFont('times','',11);
    $pdf->writeHTML($html,true,false,true,false,'');

    // 🔥 tampilkan (I = preview, D = download langsung)
    $pdf->Output('Nota_Permintaan.pdf','I');
}

/* =====================================
   SPB
===================================== */
public function get_spb($kode_unik)
{
    // Nonaktifkan tampilan error HTML (biar jadi teks)
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    header('Content-Type: application/json');
    
    // Tangkap semua output buffer (agar error tidak merusak JSON)
    ob_start();
    
    try {
        $permintaan = $this->db->where('kode_unik', $kode_unik)->get('permintaan_barang')->row();
        if (!$permintaan) {
            echo json_encode(['error' => 'Data tidak ditemukan']);
            return;
        }
        
        // Normalisasi nama
        $permintaan->nama = $permintaan->nama ?? ($permintaan->pemohon ?? '-');
        
        $detail = $this->db
            ->select('d.id, d.kode_barang, d.jumlah, d.jumlah_persetujuan, d.satuan, m.nama_barang')
            ->from('detail_permintaan d')
            ->join(
                    '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
                    FROM master_barang_modal 
                    GROUP BY kode_barang) m',
                    'm.kode_barang = d.kode_barang',
                    'left'
                )
            ->where('d.kode_unik', $kode_unik)
            ->get()
            ->result();
        
        echo json_encode([
            'permintaan' => $permintaan,
            'detail'     => $detail,
            'is_locked'  => ($permintaan->status_spb ?? 0) == 1
        ]);
    } catch (Throwable $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    
    ob_end_flush();
}
public function simpan_spb()
{
    $kode_unik = $this->input->post('kode_unik');

    // update header
    $this->db->where('kode_unik', $kode_unik)->update('permintaan_barang', [
    'nomor_spb' => $this->input->post('nomor_spb'),
    'nama'      => $this->input->post('pemohon'),
    'keperluan' => $this->input->post('keperluan'),
    'status_spb'=> 1 // 🔥 penanda sudah dikunci
]);

    // detail
    $id = $this->input->post('id');
    $jumlah_setuju = $this->input->post('jumlah_persetujuan');

foreach ($id as $i => $val) {
    $this->db->where('id', $val)->update('detail_permintaan', [
        'jumlah_persetujuan' => $jumlah_setuju[$i]
    ]);
}

    echo json_encode(['status' => 'success']);
}
public function cetak_spb($kode_unik)
{
    $this->load->library('pdf');

    // ======================
    // HEADER (permintaan)
    // ======================
    $data['permintaan'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('permintaan_barang')
        ->row();

    if (!$data['permintaan']) {
        echo "Data tidak ditemukan";
        return;
    }

    // ======================
    // TAMBAHAN FIELD
    // ======================
    $data['permintaan']->nomor_spb = $data['permintaan']->nomor_spb ?? '-';
    $data['permintaan']->pihak = $data['permintaan']->nama ?? '-';
    $data['permintaan']->nama_petugas = 'Pengurus Barang';
    $data['permintaan']->nip = '123456789';

    // ======================
    // DETAIL BARANG
    // ======================
    $data['detail'] = $this->db
    ->select('d.*, m.nama_barang')
    ->from('detail_permintaan d')
    ->join(
        '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
        FROM master_barang_modal 
        GROUP BY kode_barang) m',
        'm.kode_barang = d.kode_barang',
        'left'
    )
    ->where('d.kode_unik', $kode_unik)
    ->get()
    ->result();

    foreach ($data['detail'] as $d) {
        $d->kode_barang = $d->kode_barang ?? '-';
        $d->nama_barang = $d->nama_barang ?? '-';
        $d->jumlah = $d->jumlah ?? 0;
        $d->satuan = $d->satuan ?? 'Unit';
        $d->keperluan = $d->keperluan ?? '-';
        $d->keterangan = $d->keterangan ?? '-';
    }

    // ======================
    // LOAD VIEW PDF
    // ======================
    $html = $this->load->view('admin/permintaan/export_spb', $data, true);

    $pdf = new Pdf('L','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('times','',10);
    $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

    $pdf->AddPage();
    $pdf->writeHTML($html,true,false,true,false,'');

    $pdf->Output('SPB.pdf','I');
}

/* =====================================
   SPPB
===================================== */
public function get_sppb($kode_unik)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    header('Content-Type: application/json');
    
    // Tangkap semua output buffer (agar error tidak merusak JSON)
    ob_start();

    try {
        $permintaan = $this->db->where('kode_unik', $kode_unik)->get('permintaan_barang')->row();
        if (!$permintaan) {
            echo json_encode(['error' => 'Data tidak ditemukan']);
            return;
        }

    // 🔥 normalisasi nama
    $permintaan->nama = $permintaan->nama ?? '-';

    // 🔥 ambil detail (SAMA KAYAK SPB)
    $detail = $this->db
        ->select('d.id, d.kode_barang, d.jumlah, d.jumlah_persetujuan, d.satuan, d.keterangan, m.nama_barang')
        ->from('detail_permintaan d')
        ->join(
            '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
              FROM master_barang_modal 
              GROUP BY kode_barang) m',
            'm.kode_barang = d.kode_barang',
            'left'
        )
        ->where('d.kode_unik', $kode_unik)
        ->get()
        ->result();

    echo json_encode([
        'permintaan' => $permintaan,
        'detail'     => $detail,
        'is_locked'  => ($permintaan->status_sppb ?? 0) == 1

    ]);
    } catch (Throwable $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    
    ob_end_flush();
}
public function simpan_sppb()
{
    $kode_unik = $this->input->post('kode_unik');

    // ======================
    // HEADER
    // ======================
    $this->db->where('kode_unik', $kode_unik)->update('permintaan_barang', [
        'nomor_sppb' => $this->input->post('nomor_sppb'),
        'nama'       => $this->input->post('nama'),
        'status_sppb'=> 1 
    ]);

    $id      = $this->input->post('id');
    $jumlah  = $this->input->post('jumlah_persetujuan');
    $ket     = $this->input->post('keterangan');

    foreach ($id as $i => $val) {
        $this->db->where('id', $val)->update('detail_permintaan', [
            'jumlah_persetujuan' => $jumlah[$i],
            'keterangan'         => $ket[$i]
        ]);
    }

    echo json_encode(['status' => 'success']);
}
public function cetak_sppb($kode_unik)
{
    $this->load->library('pdf');

    // ======================
    // HEADER
    // ======================
    $data['permintaan'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('permintaan_barang')
        ->row();

    if (!$data['permintaan']) {
        echo "Data tidak ditemukan";
        return;
    }

    // ======================
    // TAMBAHAN FIELD
    // ======================
    $data['permintaan']->nomor_sppb = 'SPPB-' . date('Ymd');
    $data['permintaan']->pihak = $data['permintaan']->nama ?? '-';

    // ======================
    // DETAIL
    // ======================
    $data['detail'] = $this->db
        ->select('d.*, m.nama_barang')
        ->from('detail_permintaan d')
        ->join(
            '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
            FROM master_barang_modal 
            GROUP BY kode_barang) m',
            'm.kode_barang = d.kode_barang',
            'left'
        )
        ->where('kode_unik', $kode_unik)
        ->get()
        ->result();

    foreach ($data['detail'] as $d) {
        $d->kode_barang = $d->kode_barang ?? '-';
        $d->nama_barang = $d->nama_barang ?? '-';
        $d->jumlah = $d->jumlah ?? 0;
        $d->satuan = $d->satuan ?? 'Unit';
        $d->keterangan = $d->keterangan ?? '-';
    }

    // ======================
    // LOAD VIEW
    // ======================
    $html = $this->load->view('admin/permintaan/export_sppb', $data, true);

    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('times','',11);
    $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

    $pdf->AddPage();
    $pdf->writeHTML($html,true,false,true,false,'');

    $pdf->Output('SPPB.pdf','I');
}

/* =====================================
   BAST
===================================== */
public function get_bast($kode_unik)
{
    header('Content-Type: application/json');

    $permintaan = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('permintaan_barang')
        ->row();

    if (!$permintaan) {
        echo json_encode(['error' => 'Data tidak ditemukan']);
        return;
    }

    $permintaan->nama = $permintaan->nama ?? '-';

    $detail = $this->db
        ->select('d.id, d.kode_barang, d.jumlah, d.jumlah_persetujuan, d.satuan, d.keterangan, m.nama_barang')
        ->from('detail_permintaan d')
        ->join(
            '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
              FROM master_barang_modal 
              GROUP BY kode_barang) m',
            'm.kode_barang = d.kode_barang',
            'left'
        )
        ->where('d.kode_unik', $kode_unik)
        ->get()
        ->result();

    echo json_encode([
        'permintaan' => $permintaan,
        'detail'     => $detail,
        'is_locked'  => ($permintaan->status_bast ?? 0) == 1
    ]);
}
public function simpan_bast()
{
    $kode_unik = $this->input->post('kode_unik');

    // HEADER
    $this->db->where('kode_unik', $kode_unik)->update('permintaan_barang', [
        'nomor_bast' => $this->input->post('nomor_bast'),
        'nama'       => $this->input->post('nama'),
        'status_bast'=> 1
    ]);

    // DETAIL
    $id  = $this->input->post('id');
    $ket = $this->input->post('keterangan');

    foreach ($id as $i => $val) {
        $this->db->where('id', $val)->update('detail_permintaan', [
            'keterangan' => $ket[$i]
        ]);
    }

    echo json_encode(['status' => 'success']);
}
public function cetak_bast($kode_unik)
{
    $this->load->library('pdf');

    // ======================
    // HEADER
    // ======================
    $data['permintaan'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('permintaan_barang')
        ->row();

    if (!$data['permintaan']) {
        echo "Data tidak ditemukan";
        return;
    }

    // ======================
    // TAMBAHAN FIELD
    // ======================
    $data['permintaan']->nomor_bast = 'BAST-' . date('Ymd');
    $data['permintaan']->pihak = $data['permintaan']->nama ?? '-';

    // ======================
    // DETAIL
    // ======================
    $data['detail'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('detail_permintaan')
        ->result();

    $no = 1;
    foreach ($data['detail'] as $d) {
        $d->no = $no++; // nomor urut
        $d->kode_barang = $d->kode_barang ?? '-';
        $d->nama_barang = $d->nama_barang ?? '-';
        $d->jumlah = $d->jumlah ?? 0;
        $d->satuan = $d->satuan ?? 'Unit';
        $d->keterangan = $d->keterangan ?? '-';
    }

    // ======================
    // LOAD VIEW
    // ======================
    $html = $this->load->view('admin/permintaan/export_bast', $data, true);

    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('times','',11);
    $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

    $pdf->AddPage();
    $pdf->writeHTML($html,true,false,true,false,'');

    $pdf->Output('BAST.pdf','I');
}

public function hapus_semua()
{
    $kode_unik = $this->input->post('kode_unik');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('detail_permintaan');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('permintaan_barang');

    echo json_encode(['status'=>'deleted']);
}

}
