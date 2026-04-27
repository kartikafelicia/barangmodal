<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_barang_model');
        $this->load->helper('url');
    }

    public function index()
{
    $this->load->library('pagination');

    $config['base_url']   = site_url('master_barang/index');
    $config['total_rows'] = $this->Master_barang_model->count_all();
    $config['per_page']   = 10;
    $config['uri_segment'] = 3;

    // WAJIB TAMBAH INI 👇
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

    $page = $this->uri->segment(3);

    // FIX NULL ERROR
    if (!ctype_digit((string) $page)) {
        $page = 0;
    }

    $data['barang'] = $this->Master_barang_model->get_paginated(
        $config['per_page'],
        $page
    );

    $data['links'] = $this->pagination->create_links();

   $data['lokasi'] = $this->db
    ->select('lokasi')
    ->distinct()
    ->order_by('lokasi', 'ASC')
    ->get('master_lokasi')
    ->result();

    $data['kategori'] = $this->Master_barang_model->get_all_kategori();

    $this->load->view('bidang/master_barang/master_barang', $data);}

    public function tambah()
    {
        $lokasi = $this->input->post('lokasi', true);

        $data = [
            'lokasi'             => $lokasi_data ? $lokasi_data->lokasi : null,            'unit'               => $this->input->post('unit', true),
            'kode_barang'        => $this->input->post('kode_barang', true),
            'kode_neraca'        => $this->input->post('kode_neraca', true),
            'no_register'        => $this->input->post('no_register', true),
            'nama_barang'        => $this->input->post('nama_barang', true),
            'merk_type'          => $this->input->post('merk_type', true),
            'ukuran_cc'          => $this->input->post('ukuran_cc', true),
            'bahan'              => $this->input->post('bahan', true),
            'tahun_pengadaan'    => $this->input->post('tahun_pengadaan', true),

            // ⚠ kalau di database kamu pakai kondisi_B, kondisi_KB, kondisi_RB
            'kondisi_B'          => $this->input->post('kondisi_B', true),
            'kondisi_KB'         => $this->input->post('kondisi_KB', true),
            'kondisi_RB'         => $this->input->post('kondisi_RB', true),

            'rangka_seri'        => $this->input->post('rangka_seri', true),
            'nomor_mesin'        => $this->input->post('nomor_mesin', true),
            'nomor_nopol'        => $this->input->post('nomor_nopol', true),
            'nomor_bpkb'         => $this->input->post('nomor_bpkb', true),
            'asal_usul_pemda'    => $this->input->post('asal_usul_pemda', true),
            'asal_usul_unit'     => $this->input->post('asal_usul_unit', true),
            'jumlah'             => $this->input->post('jumlah', true),
            'satuan'             => $this->input->post('satuan', true),
            'harga'              => $this->input->post('harga', true),
            'kategori'           => $this->input->post('kategori', true),
            'sisa_umur'          => $this->input->post('sisa_umur', true),
            'beban_rp'           => $this->input->post('beban_rp', true),
            'akumulasi_susut_rp' => $this->input->post('akumulasi_susut_rp', true),
            'keterangan'         => $this->input->post('keterangan', true),
            'sub_kategori'       => $this->input->post('sub_kategori', true),
        ];

        $this->Master_barang_model->insert_barang($data);

        redirect('master_barang');
    }

   public function export_excel()
{
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_barang.xls");

    $data['barang'] = $this->db->get('master_barang_modal')->result();

    $this->load->view('bidang/master_barang/export_excel', $data);
}

public function export_pdf()
{
    ini_set('memory_limit','1024M');
    set_time_limit(0);

    $this->load->library('pdf');

    $this->db->limit(2000);

    $data['barang'] = $this->db
        ->get('master_barang_modal')
        ->result();

    $html = $this->load->view('bidang/master_barang/export_pdf', $data, true);

   $pdf = new Pdf('P','mm','A3'); // Portrait
    $pdf->SetMargins(5,5,5);
    $pdf->SetFont('helvetica','',5);

    $pdf->AddPage();
    $pdf->writeHTML($html,true,false,true,false,'');

    $pdf->Output('data_barang.pdf','I');
}

    public function get_barang($id)
{
    $data = $this->db
        ->where('id', $id)
        ->get('master_barang_modal')
        ->row();

    echo json_encode($data);
}

public function update()
{
    $id = $this->input->post('id');

    $lokasi = $this->input->post('lokasi', true);

    $data = [
        'lokasi'             => $lokasi_data ? $lokasi_data->lokasi : null,
        'unit'               => $this->input->post('unit', true),
        'kode_barang'        => $this->input->post('kode_barang', true),
        'kode_neraca'        => $this->input->post('kode_neraca', true),
        'no_register'        => $this->input->post('no_register', true),
        'nama_barang'        => $this->input->post('nama_barang', true),
        'merk_type'          => $this->input->post('merk_type', true),
        'ukuran_cc'          => $this->input->post('ukuran_cc', true),
        'bahan'              => $this->input->post('bahan', true),
        'tahun_pengadaan'    => $this->input->post('tahun_pengadaan', true),
        'kondisi_B'          => $this->input->post('kondisi_B', true),
        'kondisi_KB'         => $this->input->post('kondisi_KB', true),
        'kondisi_RB'         => $this->input->post('kondisi_RB', true),
        'rangka_seri'        => $this->input->post('rangka_seri', true),
        'nomor_mesin'        => $this->input->post('nomor_mesin', true),
        'nomor_nopol'        => $this->input->post('nomor_nopol', true),
        'nomor_bpkb'         => $this->input->post('nomor_bpkb', true),
        'asal_usul_pemda'    => $this->input->post('asal_usul_pemda', true),
        'asal_usul_unit'     => $this->input->post('asal_usul_unit', true),
        'jumlah'             => $this->input->post('jumlah', true),
        'satuan'             => $this->input->post('satuan', true),
        'harga'              => $this->input->post('harga', true),
        'kategori'           => $this->input->post('kategori', true),
        'sisa_umur'          => $this->input->post('sisa_umur', true),
        'beban_rp'           => $this->input->post('beban_rp', true),
        'akumulasi_susut_rp' => $this->input->post('akumulasi_susut_rp', true),
        'keterangan'         => $this->input->post('keterangan', true),
        'sub_kategori'       => $this->input->post('sub_kategori', true),
    ];

    $this->db->where('id', $id);
    $this->db->update('master_barang_modal', $data);

    echo json_encode(['status' => 'success']);
}

public function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('master_barang_modal');

    echo json_encode(['status' => 'deleted']);
}
}

