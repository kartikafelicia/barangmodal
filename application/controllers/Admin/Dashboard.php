<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function index()
    {
        $data['nama_user'] = $this->session->userdata('nama');

        $data['total_barang'] = $this->db->count_all('master_barang_modal');
        $data['total_kategori'] = $this->db->count_all('master_kategori');
        $data['total_lokasi'] = $this->db->count_all('master_lokasi');
        $data['total_penerimaan'] = $this->db->count_all('penerimaan_barang');
        $data['total_permintaan'] = $this->db->count_all('permintaan_barang');

        // penerimaan
        $data['penerimaan_terbaru'] = $this->db
            ->select('penerimaan_barang.*, master_barang_modal.nama_barang')
            ->from('penerimaan_barang')
            ->join('master_barang_modal','master_barang_modal.id = penerimaan_barang.id')
            ->order_by('tanggal','DESC')
            ->limit(5)
            ->get()
            ->result();

        // permintaan
        $data['permintaan_terbaru'] = $this->db
            ->select('permintaan_barang.*, master_barang_modal.nama_barang')
            ->from('permintaan_barang')
            ->join('master_barang_modal','master_barang_modal.id = permintaan_barang.id')
            ->order_by('tanggal','DESC')
            ->limit(5)
            ->get()
            ->result();
        
            // 🔥 DATA GRAFIK BULANAN
$penerimaan = $this->db
    ->select("MONTH(tanggal) as bulan, COUNT(*) as total")
    ->from("penerimaan_barang")
    ->group_by("MONTH(tanggal)")
    ->get()
    ->result();

$permintaan = $this->db
    ->select("MONTH(tanggal) as bulan, COUNT(*) as total")
    ->from("permintaan_barang")
    ->group_by("MONTH(tanggal)")
    ->get()
    ->result();

// isi 12 bulan default 0
$dataPenerimaan = array_fill(1, 12, 0);
$dataPermintaan = array_fill(1, 12, 0);

foreach ($penerimaan as $p) {
    $dataPenerimaan[$p->bulan] = (int)$p->total;
}

foreach ($permintaan as $p) {
    $dataPermintaan[$p->bulan] = (int)$p->total;
}

// kirim ke view
$data['penerimaan_chart'] = array_values($dataPenerimaan);
$data['permintaan_chart'] = array_values($dataPermintaan);

        $this->load->view('admin/dashboard', $data);
    }
}