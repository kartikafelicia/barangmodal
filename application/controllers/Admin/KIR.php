
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KIR extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KIR_model');
    }

    public function index()
    {
        $data['kir']    = $this->KIR_model->get_all();
        $data['lokasi'] = $this->KIR_model->get_lokasi();
        $data['barang'] = $this->KIR_model->get_barang();

        $this->load->view('admin/kir', $data);
    }
    
    public function get_barang_by_lokasi($id_lokasi)
{
    $lokasi = $this->db->where('id', $id_lokasi)->get('master_lokasi')->row();

    if (!$lokasi) {
        echo json_encode([]);
        return;
    }

    // 🔹 DATA PERMINTAAN TERAKHIR
    $permintaan = $this->db
        ->where('lokasi_tujuan', $lokasi->lokasi)
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('permintaan_barang')
        ->row();

    $data_lama = [];

    if ($permintaan) {
        $data_lama = $this->db
            ->select('d.kode_barang, m.nama_barang, d.jumlah')
            ->from('detail_permintaan d')
            ->join('master_barang_modal m', 'm.kode_barang = d.kode_barang', 'left')
            ->where('d.kode_unik', $permintaan->kode_unik)
            ->get()
            ->result_array();
    }

    // 🔹 DATA KIR
    $data_baru = $this->db
        ->select('k.kode_barang, m.nama_barang, k.jumlah')
        ->from('kir k')
        ->join('master_barang_modal m', 'm.kode_barang = k.kode_barang', 'left')
        ->where('k.id_lokasi', $id_lokasi)
        ->get()
        ->result_array();

    // 🔥 MERGE FINAL (SATU TEMPAT SAJA)
    $merged = [];

    foreach (array_merge($data_lama, $data_baru) as $item) {
        $kode = $item['kode_barang'];

        if (!isset($merged[$kode])) {
            $merged[$kode] = [
                'kode_barang' => $kode,
                'nama_barang' => $item['nama_barang'],
                'jumlah' => 0
            ];
        }

        $merged[$kode]['jumlah'] += (int)$item['jumlah'];
    }

    echo json_encode(array_values($merged));
}

public function simpan()
{
    header('Content-Type: application/json');

    $id_lokasi   = $this->input->post('id_lokasi');
    $kode_barang = $this->input->post('kode_barang');
    $jumlah      = $this->input->post('jumlah');
    $keterangan  = $this->input->post('keterangan');

    if (!$id_lokasi || empty($kode_barang)) {
        echo json_encode([
            'status' => 'error',
            'msg' => 'DATA KOSONG'
        ]);
        return;
    }

    // 🔥 debug isi data
    if (!is_array($kode_barang)) {
        echo json_encode(['msg' => 'kode_barang bukan array']);
        return;
    }

    $this->db->where('id_lokasi', $id_lokasi)->delete('kir');

    foreach ($kode_barang as $i => $kb) {

        if (!$kb) continue; // 🔥 skip kosong

        $this->db->insert('kir', [
            'id_lokasi'    => $id_lokasi,
            'kode_barang'  => $kb,
            'jumlah'       => isset($jumlah[$i]) ? $jumlah[$i] : 0,
            'keterangan'   => isset($keterangan[$i]) ? $keterangan[$i] : null
        ]);
    }

    echo json_encode([
        'status' => 'success'
    ]);
}

public function get_detail($id)
{
    try {

        $data = $this->db
            ->select('k.kode_barang, k.jumlah, k.keterangan, m.nama_barang')
            ->from('kir k')
            ->join('master_barang_modal m', 'm.kode_barang = k.kode_barang', 'left')
            ->where('k.id_lokasi', $id)
            ->get()
            ->result();

        echo json_encode($data);

    } catch (Exception $e) {
        echo json_encode([
            'error' => $e->getMessage()
        ]);
    }
}

}