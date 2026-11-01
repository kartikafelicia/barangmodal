<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_posisi_barang_model extends CI_Model {

    protected $table = 'master_posisi_barang';
    protected $table_lokasi = 'master_lokasi';

    /* ===============================
       GET DATA POSISI (PAGINATION)
    =============================== */
    public function get_paginated($limit, $offset, $search = null)
{
    if ($search) {
        $this->db->group_start();
        $this->db->like('lokasi', $search);
        $this->db->or_like('ruangan', $search);
        $this->db->or_like('nomor_ruangan', $search);
        $this->db->group_end();
    }

    return $this->db
        ->limit($limit, $offset)
        ->get('master_posisi_barang')
        ->result();
}

    /* ===============================
       COUNT TOTAL DATA
    =============================== */
    public function count_all($search = null)
{
    if ($search) {
        $this->db->group_start();
        $this->db->like('lokasi', $search);
        $this->db->or_like('ruangan', $search);
        $this->db->or_like('nomor_ruangan', $search);
        $this->db->group_end();
    }

    return $this->db->count_all_results('master_posisi_barang');
}

    /* ===============================
       GET LOKASI (UNTUK DROPDOWN)
    =============================== */
    public function get_lokasi()
    {
        return $this->db
                    ->order_by('lokasi', 'ASC')
                    ->get($this->table_lokasi)
                    ->result();
    }

    /* ===============================
       INSERT DATA
    =============================== */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /* ===============================
       GET BY ID (EDIT)
    =============================== */
    public function get_by_id($id)
    {
        return $this->db
                    ->where('id', $id)
                    ->get($this->table)
                    ->row();
    }

    /* ===============================
       UPDATE DATA
    =============================== */
    public function update($id, $data)
    {
        return $this->db
                    ->where('id', $id)
                    ->update($this->table, $data);
    }

    /* ===============================
       DELETE DATA
    =============================== */
    public function delete($id)
    {
        return $this->db
                    ->where('id', $id)
                    ->delete($this->table);
    }

    public function getData($limit = null, $offset = 0)
{
    if ($limit !== null) {
        $this->db->limit($limit, $offset);
    }

    return $this->db->get('nama_tabel')->result();
}
}