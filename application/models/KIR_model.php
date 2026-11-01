<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kir_model extends CI_Model {

    // Ambil semua data kir
    public function get_all()
    {
        return $this->db
                    ->order_by('tanggal', 'DESC')
                    ->get('kir')
                    ->result();
    }

    // Ambil lokasi buat dropdown
    public function get_lokasi()
{
    return $this->db
        ->select('
            l.id,
            l.lokasi,
            p.ruangan
        ')
        ->from('master_lokasi l')
        ->join('master_posisi_barang p', 'p.id_lokasi = l.id', 'left')
        ->order_by('l.lokasi', 'ASC')
        ->get()
        ->result();
}

    // Ambil barang buat dropdown
    public function get_barang()
{
    return $this->db
                ->select('kode_barang, no_register, nama_barang, merk_type, tahun_pengadaan')
                ->order_by('nama_barang', 'ASC')
                ->get('master_barang_modal')
                ->result();
}

public function count_all($keyword = '')
{
    $this->db->from('master_lokasi l');
    $this->db->join('master_posisi_barang p', 'p.id_lokasi = l.id', 'left');

    if ($keyword) {
        $this->db->group_start();
        $this->db->like('l.lokasi', $keyword);
        $this->db->or_like('p.ruangan', $keyword);
        $this->db->group_end();
    }

    return $this->db->count_all_results();
}

public function get_paginated($limit, $offset, $keyword = '')
{
    $this->db->select('
        l.id,
        l.lokasi,
        p.ruangan
    ');

    $this->db->from('master_lokasi l');
    $this->db->join('master_posisi_barang p', 'p.id_lokasi = l.id', 'left');

    if ($keyword) {
        $this->db->group_start();
        $this->db->like('l.lokasi', $keyword);
        $this->db->or_like('p.ruangan', $keyword);
        $this->db->group_end();
    }

    return $this->db
        ->order_by('l.lokasi', 'ASC')
        ->limit($limit, $offset)
        ->get()
        ->result();
}

}