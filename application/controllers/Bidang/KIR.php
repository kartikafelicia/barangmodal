<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KIR extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KIR_model');
    }

    public function index()
    {
        $data['kir']    = $this->KIR_model->get_all();
        $data['lokasi'] = $this->KIR_model->get_lokasi();
        $data['barang'] = $this->KIR_model->get_barang();

        $this->load->view('bidang/kir', $data);
    }
    
    public function get_barang_by_lokasi($id_lokasi)
{
    $this->db->where('id', $id_lokasi);
    $data = $this->db->get('permintaan_barang')->result();

    echo json_encode($data);
}

public function simpan()
{
    $id = $this->input->post('id');

    $kode_barang = $this->input->post('kode_barang');
    $jumlah      = $this->input->post('jumlah');
    $keterangan  = $this->input->post('keterangan');

    // 🔥 kalau edit → hapus dulu detail lama
    if ($id) {
        $this->db->where('id_kir', $id)->delete('kir');
    }

    // 🔥 insert ulang detail
    foreach ($kode_barang as $i => $kb) {
        $this->db->insert('kir', [
            'id_kir'      => $id,
            'kode_barang' => $kb,
            'jumlah'      => $jumlah[$i],
            'keterangan'  => $keterangan[$i] ?? null
        ]);
    }

    redirect('bidang/kir');
}

public function get_detail($id)
{
    $data = $this->db
        ->select('
            k.kode_barang,
            k.jumlah,
            k.keterangan,
            m.merk_type,
            m.tahun_pengadaan AS tahun
        ')
        ->from('kir k')
        ->join('master_barang_modal m', 'm.no_register = k.kode_barang')
        ->where('k.id', $id)
        ->get()
        ->result();

    header('Content-Type: application/json');
    echo json_encode($data);
}

}