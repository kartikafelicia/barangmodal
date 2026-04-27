<?php
class Riwayat_model extends CI_Model {

    // 🔥 ambil semua barang
    public function get_barang()
    {
        return $this->db
            ->order_by('nama_barang', 'ASC')
            ->get('master_barang_modal')
            ->result();
    }

    // 🔥 hitung total barang
public function count_barang($keyword = null)
{
    if ($keyword) {
        $this->db->like('nama_barang', $keyword);
    }

    return $this->db->count_all_results('master_barang_modal');
}

// 🔥 pagination barang
public function get_barang_paginated($limit, $start, $keyword = null)
{
    if ($keyword) {
        $this->db->like('nama_barang', $keyword);
    }

    return $this->db
        ->order_by('nama_barang', 'ASC')
        ->limit($limit, $start)
        ->get('master_barang_modal')
        ->result();
}

    // 🔥 ambil 1 barang
    public function get_barang_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('master_barang_modal')
            ->row();
    }

    // 🔥 ambil RIWAYAT barang
    public function get_riwayat($id_barang)
{
    return $this->db
        ->select('
            MONTH(p.tanggal) as bulan,
            YEAR(p.tanggal) as tahun,
            p.lokasi_tujuan as lokasi_barang,
            p.lokasi_asal as ruangan,
            d.kondisi as kondisi
        ')
        ->from('detail_permintaan d')
        ->join('permintaan_barang p', 'p.kode_unik = d.kode_unik', 'left')
        ->join('master_barang_modal m', 'm.kode_barang = d.kode_barang', 'left')
        ->where('m.id', $id_barang)
        ->order_by('p.tanggal', 'DESC')
        ->get()
        ->result();
}


}