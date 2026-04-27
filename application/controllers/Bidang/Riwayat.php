<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Riwayat_model');
    }

    // 🔥 halaman utama
    public function index()
{
    $this->load->library('pagination');

    $config['base_url']   = site_url('bidang/riwayat/index');
    $config['total_rows'] = $this->Riwayat_model->count_barang();
    $config['per_page']   = 10;
    $config['uri_segment'] = 4;
    

    // 🔥 STYLE (biar sama kayak kamu)
    $config['use_page_numbers'] = FALSE;
    $config['reuse_query_string'] = TRUE;

    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['prev_link'] = '<i class="bx bx-chevrons-left"></i>';
    $config['next_link'] = '<i class="bx bx-chevrons-right"></i>';

    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    $page = $this->uri->segment(4);

    if (!ctype_digit((string)$page)) {
        $page = 0;
    }

    // 🔥 ambil data sesuai limit
    $data['barang'] = $this->Riwayat_model->get_barang_paginated(
        $config['per_page'],
        $page
    );

    $data['links'] = $this->pagination->create_links();

    $this->load->view('bidang/riwayat', $data);
}

    // 🔥 AJAX ambil detail + riwayat
    public function get_detail_barang($id)
    {
        // ambil data barang
        $barang = $this->Riwayat_model->get_barang_by_id($id);

        // ambil riwayat
        $riwayat = $this->Riwayat_model->get_riwayat($id);

        // kalau barang tidak ada
        if (!$barang) {
            echo json_encode([
                'status' => 'error',
                'msg' => 'Barang tidak ditemukan'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'barang' => $barang,
            'riwayat' => $riwayat
        ]);
    }

}