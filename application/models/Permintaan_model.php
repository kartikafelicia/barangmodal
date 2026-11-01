<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_model extends CI_Model {

    /* =====================================
       GET DATA UTAMA
    ===================================== */
    public function get_all_permintaan()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get('permintaan_barang')
            ->result();
    }

    public function get_barang()
    {
        return $this->db->get('master_barang_modal')->result();
    }

    public function get_lokasi()
    {
        return $this->db->get('master_lokasi')->result();
    }

    /* =====================================
       DETAIL PERMINTAAN
    ===================================== */
    public function get_detail($kode_unik)
    {
        return $this->db
            ->where('kode_unik', $kode_unik)
            ->get('detail_permintaan')
            ->result_array();
    }

    public function update_kondisi($id, $kondisi)
    {
        return $this->db
            ->where('id', $id)
            ->update('detail_permintaan', ['kondisi' => $kondisi]);
    }

    public function hapus_detail($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete('detail_permintaan');
    }

    /* =====================================
       GET HEADER PERMINTAAN
    ===================================== */
    public function get_permintaan($kode_unik)
    {
        return $this->db
            ->where('kode_unik', $kode_unik)
            ->get('permintaan_barang')
            ->row();
    }

    /* =====================================
       GET DETAIL + JOIN BARANG
    ===================================== */
    public function get_detail_join_barang($kode_unik)
    {
        return $this->db
            ->select('d.*, m.nama_barang')
            ->from('detail_permintaan d')
            ->join(
                '(SELECT kode_barang, MAX(nama_barang) as nama_barang 
                  FROM master_barang_modal 
                  GROUP BY kode_barang) m',
                'm.kode_barang = d.kode_barang',
                'left'
            )
            ->where('d.kode_unik', $kode_unik)
            ->get()
            ->result();
    }

    /* =====================================
       SIMPAN SPB
    ===================================== */
    public function simpan_spb($kode_unik, $data_header, $id, $jumlah_setuju)
    {
        // update header
        $this->db->where('kode_unik', $kode_unik)
                 ->update('permintaan_barang', $data_header);

        // update detail
        foreach ($id as $i => $val) {
            $this->db->where('id', $val)
                     ->update('detail_permintaan', [
                         'jumlah_persetujuan' => $jumlah_setuju[$i]
                     ]);
        }

        return true;
    }

    /* =====================================
       SIMPAN SPPB
    ===================================== */
    public function simpan_sppb($kode_unik, $data_header, $id, $jumlah, $ket)
    {
        $this->db->where('kode_unik', $kode_unik)
                 ->update('permintaan_barang', $data_header);

        foreach ($id as $i => $val) {
            $this->db->where('id', $val)
                     ->update('detail_permintaan', [
                         'jumlah_persetujuan' => $jumlah[$i],
                         'keterangan'         => $ket[$i]
                     ]);
        }

        return true;
    }

    /* =====================================
       SIMPAN BAST
    ===================================== */
    public function simpan_bast($kode_unik, $data_header, $id, $ket)
    {
        $this->db->where('kode_unik', $kode_unik)
                 ->update('permintaan_barang', $data_header);

        foreach ($id as $i => $val) {
            $this->db->where('id', $val)
                     ->update('detail_permintaan', [
                         'keterangan' => $ket[$i]
                     ]);
        }

        return true;
    }

    /* =====================================
       HAPUS SEMUA
    ===================================== */
    public function hapus_semua($kode_unik)
    {
        $this->db->where('kode_unik', $kode_unik)
                 ->delete('detail_permintaan');

        $this->db->where('kode_unik', $kode_unik)
                 ->delete('permintaan_barang');

        return true;
    }
}