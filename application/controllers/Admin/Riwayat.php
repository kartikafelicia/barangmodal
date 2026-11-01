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

    // 🔥 LIMIT (INI YANG KAMU MAU)
    $limit = $this->input->get('limit');

    if ($limit == 'all') {
        $config['per_page'] = $config['total_rows'];
    } elseif ($limit) {
        $config['per_page'] = (int)$limit;
    } else {
        $config['per_page'] = 10;
    }

    $config['uri_segment'] = 4;

    // 🔥 BIAR QUERY (search & limit) IKUT
    $config['reuse_query_string'] = TRUE;

    // 🔥 STYLE SAMA MASTER BARANG
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = false;
    $config['last_link'] = false;

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

    // 🔥 OFFSET
    $page = (int) $this->uri->segment(4);
    $page = ($page) ? $page : 0;

    $data['barang'] = $this->Riwayat_model->get_barang_paginated(
        $config['per_page'],
        $page,
        $keyword
    );

    // 🔥 buat nomor urut
    $data['start'] = $page;

    $data['links'] = $this->pagination->create_links();
    $data['keyword'] = $keyword;
    $data['limit'] = $limit;

    $this->load->view('admin/riwayat', $data);
}

    // 🔥 AJAX ambil detail + riwayat
    public function get_detail_barang($id)
    {
        // ambil data barang
        $barang = $this->Riwayat_model->get_barang_by_id($id);

        // ambil riwayat
        $raw = $this->Riwayat_model->get_riwayat($id);

        $riwayat = [];
        $last = null;

        foreach ($raw as $r) {

            // kalau ada data lengkap → simpan sebagai base
            if ($r->bulan || $r->tahun || $r->lokasi_barang || $r->ruangan) {
                $last = $r;
            }

            // kalau cuma kondisi → gabung ke data terakhir
            if ($last) {
                $riwayat[] = (object)[
                    'bulan' => $last->bulan,
                    'tahun' => $last->tahun,
                    'lokasi_barang' => $last->lokasi_barang,
                    'ruangan' => $last->ruangan,
                    'kondisi' => $r->kondisi
                ];
            }
        }
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