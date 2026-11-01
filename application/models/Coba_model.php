<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_model extends CI_Model {

    private $table = 'coba';

    public function get_all()
    {
        return $this->db
            ->get($this->table)
            ->result();
    }
}