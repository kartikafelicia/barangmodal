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

        $this->load->view('admin/dashboard', $data);
    }
}