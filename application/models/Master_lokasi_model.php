<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_lokasi_model extends CI_Model {

    private $table = 'master_lokasi';

    // ✅ Ambil semua lokasi
    public function get_all()
    {
        return $this->db
                    ->order_by('id','ASC')
                    ->get($this->table)
                    ->result();
    }

    // ✅ Insert lokasi baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // ✅ Optional (buat nanti edit/hapus)
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)
                        ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
}
