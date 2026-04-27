<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('upload');
    }

    public function index()
{
    $data['barang'] = $this->db
        ->get('master_barang_modal')
        ->result();

    $data['lokasi'] = $this->db
        ->get('master_lokasi')
        ->result();

    $data['permintaan'] = $this->db
        ->order_by('id', 'DESC')
        ->get('permintaan_barang')
        ->result();

    $this->load->view('bidang/permintaan/permintaan', $data);
}

    public function simpan()
{
    $kode_barang   = $this->input->post('kode_barang');
    $jumlah        = $this->input->post('jumlah');
    $tanggal       = $this->input->post('tanggal');
    $nama = $this->input->post('nama');
    $lokasi_asal   = $this->input->post('lokasi_asal');
    $lokasi_tujuan = $this->input->post('lokasi_tujuan');

    $dokumen = '';

    // Upload dokumen
    if (!empty($_FILES['dokumen']['name'])) {

        if (!is_dir('./uploads/dokumen_permintaan')) {
            mkdir('./uploads/dokumen_permintaan', 0777, true);
        }

        $config['upload_path'] = FCPATH . 'uploads/dokumen_permintaan/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('dokumen')) {
            $dokumen = $this->upload->data('file_name');
        }
    }

    // 🔥 BUAT KODE_UNIK SEKALI SAJA
    do {
        $kode_unik = 'REQ' . strtoupper(bin2hex(random_bytes(5)));
        $cek = $this->db
            ->get_where('permintaan_barang', ['kode_unik' => $kode_unik])
            ->row();
    } while ($cek);
    

    // ======================
    // INSERT HEADER
    // ======================
    $this->db->insert('permintaan_barang', [
        'kode_unik'     => $kode_unik,
        'tanggal'       => $tanggal,
        'nama' => $nama,
        'lokasi_asal'   => $lokasi_asal,
        'lokasi_tujuan' => $lokasi_tujuan,
        'dokumen'       => $dokumen,
        // 'status_permintaan' => 'pengajuan'
    ]);

    // ======================
    // INSERT DETAIL
    // ======================
    for ($i = 0; $i < count($kode_barang); $i++) {

        $barang = $this->db->get_where(
            'master_barang_modal',
            ['no_register' => $kode_barang[$i]]
        )->row();

        if ($barang) {

            $this->db->insert('detail_permintaan', [
                'kode_unik'   => $kode_unik,
                'kode_barang' => $barang->kode_barang,
                'no_register' => $barang->no_register,
                'nama_barang' => $barang->nama_barang,
                'jumlah'      => $jumlah[$i],
            ]);
        }
    }

    redirect('bidang/permintaan');
}

public function get_detail($kode_unik = null)
{
    header('Content-Type: application/json');

    if (!$kode_unik) {
        echo json_encode([]);
        return;
    }

    $data = $this->db
        ->where('kode_unik', $kode_unik)
        ->get('detail_permintaan')
        ->result_array();

    echo json_encode($data);
}


public function update_kondisi()
{
    $id = $this->input->post('id');
    $kondisi = $this->input->post('kondisi');

    $this->db->where('id', $id);
    $this->db->update('detail_permintaan', ['kondisi' => $kondisi]);

    echo json_encode(['status' => 'success']);
}

public function hapus_detail()
{
    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->delete('detail_permintaan');

    echo json_encode(['status' => 'deleted']);
}

public function hapus_semua()
{
    $kode_unik = $this->input->post('kode_unik');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('detail_permintaan');

    $this->db->where('kode_unik', $kode_unik);
    $this->db->delete('permintaan_barang');

    echo json_encode(['status'=>'deleted']);
}

public function cetak_nota($kode_unik)
{
    $this->load->library('pdf');

    // 🔥 ambil data header
    $permintaan = $this->db
        ->get_where('permintaan_barang', ['kode_unik' => $kode_unik])
        ->row();

    if (!$permintaan) {
        show_error('Data tidak ditemukan');
    }

    // 🔥 ambil detail
    $detail = $this->db
        ->get_where('detail_permintaan', ['kode_unik' => $kode_unik])
        ->result();

    $data = [
        'permintaan' => $permintaan,
        'detail'     => $detail
    ];

    // 🔥 load view jadi HTML
    $html = $this->load->view('bidang/permintaan/export_nota', $data, true);

    // 🔥 generate PDF
    $pdf = new Pdf('P','mm','A4');
    $pdf->SetMargins(10,10,10);
    $pdf->AddPage();
    $pdf->SetFont('times','',11);
    $pdf->writeHTML($html,true,false,true,false,'');

    // 🔥 tampilkan (I = preview, D = download langsung)
    $pdf->Output('Nota_Permintaan.pdf','I');
}

}
