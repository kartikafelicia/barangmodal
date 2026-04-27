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

    $keyword = $this->input->get('search') ?? '';

    $config['base_url']   = site_url('admin/riwayat/index');
    $config['total_rows'] = $this->Riwayat_model->count_barang($keyword);
    $config['per_page']   = 10;
    $config['uri_segment'] = 4;

    $config['suffix'] = '?search=' . urlencode($keyword);
    $config['first_url'] = $config['base_url'] . $config['suffix'];

    $this->pagination->initialize($config);

    $page = $this->uri->segment(4);
    if (!ctype_digit((string)$page)) $page = 0;

    $data['barang'] = $this->Riwayat_model->get_barang_paginated(
        $config['per_page'],
        $page,
        $keyword
    );

    $data['links'] = $this->pagination->create_links();
    $data['keyword'] = $keyword;

    $this->load->view('admin/riwayat', $data);
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

    public function export_riwayat($id)
{
    $this->load->library('pdf');

    // 🔥 ambil data barang
    $barang = $this->Riwayat_model->get_barang_by_id($id);

    if (!$barang) {
        show_error('Data tidak ditemukan');
    }

    // 🔥 ambil riwayat
    $riwayat = $this->Riwayat_model->get_riwayat($id);

    $data = [
        'barang'  => $barang,
        'riwayat' => $riwayat
    ];

    // 🔥 load view jadi HTML
    $html = $this->load->view('admin/export_riwayat', $data, true);

    // 🔥 TCPDF (SAMA KAYAK PUNYA KAMU)
    $pdf = new Pdf('L','mm','A4'); // 🔥 buat dulu
    
    $pdf->SetMargins(10,10,10);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();
    $pdf->SetFont('times','',11);
    $pdf->setCellHeightRatio(1.5);

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Output('Riwayat_Barang.pdf','I');
}

}