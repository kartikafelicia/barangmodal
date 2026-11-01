<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_posisi_barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_posisi_barang_model');
        $this->load->helper('url');
    }

    public function index()
{ 
    $this->load->database();
    $data['lokasi_master'] = $this->Master_posisi_barang_model->get_lokasi();
    $this->load->library('pagination');

    // CONFIG
    $search = $this->input->get('search');
    $config['base_url'] = site_url('admin/master_posisi_barang/index');
    $config['total_rows'] = $this->Master_posisi_barang_model->count_all($search);
    $limit = $this->input->get('limit');
    if ($limit == 'all') {
        $limit = null; // nanti ambil semua
    } else {
        $limit = (int) $limit;
        if ($limit <= 0) $limit = 10;
    }
    if ($limit === null) {
        $config['per_page'] = $config['total_rows'];
    } else {
        $config['per_page'] = $limit;
    }
    $config['uri_segment'] = 4;

    // STYLE (sama kayak master_barang)
    $config['use_page_numbers'] = FALSE;
    $config['reuse_query_string'] = TRUE;
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = false;
    $config['last_link'] = false;

    $config['prev_link'] = '<i class="tf-icon bx bx-chevrons-left"></i>';
    $config['next_link'] = '<i class="tf-icon bx bx-chevrons-right"></i>';

    $config['prev_tag_open'] = '<li class="page-item prev">';
    $config['prev_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li class="page-item next">';
    $config['next_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    // PAGE
    $page = $this->uri->segment(4);
    if (!$page) {
        $page = 0;
    }
    // DATA
    $data['lokasi'] = $this->Master_posisi_barang_model->get_paginated(
        $config['per_page'],
        $page,
        $search
    );

    $data['links'] = $this->pagination->create_links();

    $this->load->view('admin/master_posisi_barang/master_posisi_barang', $data);
}

    public function tambah()
{
    $data = [
        'lokasi' => $this->input->post('lokasi', true),
        'nomor_ruangan' => $this->input->post('nomor_ruangan', true),
        'ruangan' => $this->input->post('ruangan', true),
    ];

    $this->Master_posisi_barang_model->insert($data);
    redirect('admin/master_posisi_barang');
}

    public function export_excel()
{
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_posisi_barang.xls");

    $data['posisi_barang'] = $this->db
        ->order_by('lokasi','ASC')
        ->get('master_posisi_barang')
        ->result();

    $this->load->view('admin/master_posisi_barang/export_excel', $data);
}

public function export_pdf()
{
    ini_set('memory_limit','256M');
    set_time_limit(0);

    $this->load->library('pdf');

    $data['posisi_barang'] = $this->db
        ->order_by('lokasi','ASC')
        ->get('master_posisi_barang')
        ->result();

    $html = $this->load->view('admin/master_posisi_barang/export_pdf', $data, true);

    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('helvetica','',10);

    $pdf->AddPage();
    $pdf->writeHTML($html);

    $pdf->Output('data_posisi_barang.pdf','I');
}

    public function get_posisi($id)
{
    $data = $this->Master_posisi_barang_model->get_by_id($id);

    header('Content-Type: application/json'); // 🔥 WAJIB
    echo json_encode($data);
    exit; // 🔥 TAMBAH INI
}

    public function update()
{
    $id = $this->input->post('id');
    $nomor_ruangan = $this->input->post('nomor_ruangan', true);

    $data = [
        'lokasi' => $this->input->post('lokasi', true),
        'nomor_ruangan' => $nomor_ruangan,
        'ruangan' => $this->input->post('ruangan', true), // 🔥 ambil dari form aja
    ];

    $this->Master_posisi_barang_model->update($id, $data);

    echo json_encode(['status' => 'success']);
}

    public function delete($id)
    {
        $this->Master_posisi_barang_model->delete($id);

        echo json_encode(['status' => 'deleted']);
    }
}