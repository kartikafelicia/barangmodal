<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang_model extends CI_Model {

    protected $table = 'master_barang_modal';
    protected $table_kategori = 'master_kategori';

    public function get_all_barang()
    {
        return $this->db
                    ->order_by('id', 'ASC')
                    ->get($this->table)
                    ->result();
    }

    public function get_all_kategori()
    {
        return $this->db
                    ->order_by('kategori', 'ASC')
                    ->get($this->table_kategori)
                    ->result();
    }

    public function insert_barang($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_paginated($limit, $start)
    {
        return $this->db
                    ->limit($limit, $start)
                    ->order_by('id', 'ASC')
                    ->get($this->table)
                    ->result();
    }
}