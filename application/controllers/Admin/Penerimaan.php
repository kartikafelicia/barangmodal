<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller {

    public function __construct()
    {
    parent::__construct();
    $this->load->database();
    $this->load->model('Penerimaan_model');
    $this->load->helper(['url', 'form']); // <<< WAJIB
    $this->load->library('upload');       // <<< biar upload ga undefined
    }

    public function index()
    {
    $data['title'] = 'Penerimaan Barang';
    $data['barang'] = $this->db
        ->get('master_barang_modal')
        ->result();

    $data['pengadaan'] = $this->Penerimaan_model->get_by_jenis('pengadaan');
    $data['hibah']     = $this->Penerimaan_model->get_by_jenis('hibah');
    $data['instansi']  = $this->Penerimaan_model->get_by_jenis('instansi');

    $this->load->view('admin/penerimaan/penerimaan', $data);
    }

    // ================== SIMPAN ==================

    public function simpan_pengadaan()
    {$this->simpan('pengadaan');}
    public function simpan_hibah()
    {$this->simpan('hibah');}
    public function simpan_instansi()
    {$this->simpan('instansi');}

    // ================== CORE SIMPAN ==================
    private function simpan($jenis)
{
    $nama_penyedia = $this->input->post('nama_penyedia');
    $tanggal       = $this->input->post('tanggal');

    $kode_barang = $this->input->post('kode_barang');
    $jumlah      = $this->input->post('jumlah');
    $kondisi     = $this->input->post('kondisi');

    // ================= GENERATE KODE UNIK =================
    do {
        $kode_unik = 'BRG' . strtoupper(bin2hex(random_bytes(4)));
        $cek = $this->db
            ->get_where('penerimaan_barang', ['kode_unik' => $kode_unik])
            ->row();
    } while ($cek);

   // ================= UPLOAD DOKUMEN =================
    $dokumen = '';

    if (isset($_FILES['dokumen']) 
        && isset($_FILES['dokumen']['name']) 
        && is_string($_FILES['dokumen']['name']) 
        && $_FILES['dokumen']['name'] != '') {

        if (!is_dir('./uploads/dokumen_penerimaan')) {
            mkdir('./uploads/dokumen_penerimaan', 0777, true);
        }

        $config['upload_path']   = './uploads/dokumen_penerimaan/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('dokumen')) {
            $dokumen = $this->upload->data('file_name');
        }
    }

    // ================= INSERT HEADER =================
    $header = [
        'kode_unik'        => $kode_unik,
        'jenis_penerimaan' => $jenis,
        'nama_penyedia'    => $nama_penyedia,
        'tanggal'          => $tanggal,
        'dokumen'          => $dokumen,
    ];

    $this->db->insert('penerimaan_barang', $header);

    // ================= INSERT DETAIL =================
    for ($i = 0; $i < count($kode_barang); $i++) {

        $barang = $this->db->get_where(
            'master_barang_modal',
            ['no_register' => $kode_barang[$i]]
        )->row();

        if ($barang) {

            $detail = [
                'kode_unik'   => $kode_unik,
                'kategori'    => $barang->kategori,
                'kode_barang' => $barang->kode_barang,
                'no_register' => $barang->no_register,
                'nama_barang' => $barang->nama_barang,
                'jumlah'      => $jumlah[$i],
                'kondisi'     => $kondisi[$i],
            ];

            $this->db->insert('detail_penerimaan', $detail);
        }
    }

    redirect('admin/penerimaan');
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
        ->get('detail_penerimaan')
        ->result_array();

    echo json_encode($data);
}


public function update_kondisi()
{
    $id = $this->input->post('id');
    $kondisi = $this->input->post('kondisi');

    $this->db->where('id', $id);
    $this->db->update('detail_penerimaan', ['kondisi' => $kondisi]);

    echo json_encode(['status' => 'success']);
}

public function hapus_detail()
{
    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->delete('detail_penerimaan');

    echo json_encode(['status' => 'deleted']);
}

public function hapus_semua()
{
    $kode_unik = $this->input->post('kode_unik');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('detail_penerimaan');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('penerimaan_barang');

    echo json_encode(['status'=>'deleted']);
}

public function export_nota($kode_unik)
{
    $this->load->library('pdf');

    // HEADER
    $data['penerimaan'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('penerimaan_barang')
        ->row();

    if (!$data['penerimaan']) {
        echo "Data tidak ditemukan";
        return;
    }

    // DETAIL
    $data['detail'] = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('detail_penerimaan')
        ->result();

    // DEFAULT VALUE (biar aman kayak permintaan)
    $data['penerimaan']->nama_penyedia = $data['penerimaan']->nama_penyedia ?? '-';
    $data['penerimaan']->tanggal = $data['penerimaan']->tanggal ?? '-';

    foreach ($data['detail'] as $d) {
        $d->nama_barang = $d->nama_barang ?? '-';
        $d->jumlah = $d->jumlah ?? 0;
        $d->kondisi = $d->kondisi ?? '-';
    }

    // LOAD VIEW HTML
    $html = $this->load->view('admin/penerimaan/export_nota', $data, true);

    // TCPDF
    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('times','',11);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('Nota_Penerimaan.pdf', 'I');
}

    public function test_db()
{
    var_dump($this->db);
}

}
