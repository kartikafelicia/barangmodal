<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_model extends CI_Model {

    private $table = 'penerimaan_barang';

    // ambil data per jenis
    public function get_by_jenis($jenis)
{
    return $this->db
        ->where('jenis_penerimaan', $jenis)
        ->get('penerimaan_barang')
        ->result();
}


    // simpan data
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // ambil satu data (buat edit)
    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    // update
    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    // delete
    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }
}
