<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_kategori_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Master Kategori';
        $data['kategori'] = $this->Master_kategori_model->get_all();

        $this->load->view('bidang/master_kategori/master_kategori', $data);
    }

    public function tambah()
    {
        $data = [
            'kategori' => $this->input->post('kategori', true)
        ];

        $this->db->insert('master_kategori', $data);

        redirect('bidang/master_kategori');
    }

    public function export_excel()
{
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_kategori.xls");

    $data['kategori'] = $this->db
        ->order_by('kategori','ASC')
        ->get('master_kategori')
        ->result();

    $this->load->view('bidang/master_kategori/export_excel', $data);
}

public function export_pdf()
{
    ini_set('memory_limit','256M');
    set_time_limit(0);

    $this->load->library('pdf');

    // ambil data kategori langsung dari tabel kategori
    $data['kategori'] = $this->db
        ->order_by('kategori','ASC')
        ->get('master_kategori')
        ->result();

    $html = $this->load->view('bidang/master_kategori/export_pdf', $data, true);

    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('helvetica','',10);

    $pdf->AddPage();
    $pdf->writeHTML($html,true,false,true,false,'');

    $pdf->Output('data_kategori.pdf','I');
}

public function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('master_kategori');
}
}
