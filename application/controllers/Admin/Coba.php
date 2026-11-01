<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Coba_model');
    }

    public function index()
    {
        $data['coba'] = $this->Coba_model->get_all();

        $this->load->view('admin/coba', $data);
    }
}