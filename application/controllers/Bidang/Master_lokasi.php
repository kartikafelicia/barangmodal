<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_lokasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_lokasi_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Master Lokasi';
        $data['lokasi'] = $this->Master_lokasi_model->get_all();

        $this->load->view('bidang/master_lokasi/master_lokasi', $data);
    }

    public function tambah()
    {
        $data = [
            'lokasi' => $this->input->post('lokasi', true)

        ];

        $this->db->insert('master_lokasi', $data);

        redirect('bidang/master_lokasi');
    }

    public function export_excel()
{
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_master_lokasi.xls");

    $data['lokasi'] = $this->db
        ->order_by('lokasi','ASC')        
        ->get('master_lokasi')
        ->result();

    $this->load->view('bidang/master_lokasi/export_excel', $data);
}

    public function export_pdf()
{
    ini_set('memory_limit','256M');
    set_time_limit(0);

    $this->load->library('pdf');

    $data['lokasi'] = $this->db
        ->order_by('lokasi','ASC')
        ->get('master_lokasi')
        ->result();

    $html = $this->load->view('bidang/master_lokasi/export_pdf', $data, true);

    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->SetFont('helvetica','',10);

    $pdf->AddPage();
    $pdf->writeHTML($html);

    $pdf->Output('data_lokasi.pdf','I');
}

    public function update()
{
    $id = $this->input->post('id');

    $data = [
        'lokasi' => $this->input->post('lokasi', true),
    ];

    $this->db->where('id', $id);
    $this->db->update('master_lokasi', $data);

    echo json_encode(['status' => 'success']);
}

public function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('master_lokasi');

    echo json_encode(['status' => 'deleted']);
}
}
