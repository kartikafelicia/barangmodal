<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body { font-family: Arial; font-size: 11px; }

.text-center { text-align: center; }

table { width: 100%; border-collapse: collapse; }

th, td {
    border: 1px solid black;
    padding: 5px;
}

.no-border td {
    border: none;
    padding: 2px;
}

.ttd td { border: none; }

.header td { border: none; }

hr { border: 1px solid black; }
</style>
</head>

<body>

<!-- HEADER -->
<table class="header">
<tr>
    <td width="15%" class="text-center">
        <img src="<?= FCPATH.'assets/sneat/assets/img/logo_dinas.png' ?>" width="70">
    </td>
    <td class="text-center">
        <strong>PEMERINTAH KOTA SURABAYA</strong><br>
        <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong><br>
        Jalan Pagesangan II Nomor 56 Surabaya 60233 Surabaya<br>
        Telp. (031) 8282328 Fax. (031) 8282328
    </td>
</tr>
</table>

<hr>

<br>

<!-- JUDUL -->
<div class="text-center">
    <strong>BERITA ACARA SERAH TERIMA (BAST)</strong><br>
    <strong>PENYALURAN BARANG PERSEDIAAN</strong><br>
    Nomor: <?= $permintaan->nomor_bast ?? $permintaan->kode_unik ?>
</div>

<br>

<!-- ISI -->
<p>
Pada hari ini <?= date('l, d F Y', strtotime($permintaan->tanggal)) ?> bertempat di Surabaya,
yang bertanda tangan di bawah ini:
</p>

<p>
I. Nama : Ratna Sari <br>
NIP : 197507262008012006 <br>
Pangkat/Gol : Penata Muda/III-a <br>
Dalam hal ini bertindak sebagai Pengurus Barang Pengguna, selanjutnya sebagai <b>PIHAK PERTAMA</b>.
</p>

<p>
II. Nama : Dr. Kanti Budiarti S.Sos, M.Si <br>
NIP : 197202011992012001 <br>
Pangkat/Gol : Pembina Tingkat IV/b <br>
Dalam hal ini bertindak sebagai penerima BMD berupa barang persediaan, selanjutnya sebagai <b>PIHAK KEDUA</b>.
</p>

<p>
PIHAK PERTAMA telah melakukan serah terima kepada PIHAK KEDUA berupa barang persediaan
berdasarkan SPPB tanggal <?= date('d F Y', strtotime($permintaan->tanggal)) ?> dengan rincian:
</p>

<!-- TABEL -->
<table>
<thead>
<tr style="text-align:center; font-weight:bold;">
    <th width="5%">No</th>
    <th width="20%">Kode Barang</th>
    <th width="30%">Nama Barang</th>
    <th width="15%">Spesifikasi</th>
    <th width="10%">Jumlah</th>
    <th width="10%">Satuan</th>
    <th width="10%">Ket</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td width="5%" align="center"><?= $no++ ?></td>
    <td width="20%"><?= $d->kode_barang ?></td>
    <td width="30%"><?= $d->nama_barang ?></td>
    <td width="15%">-</td>
    <td width="10%" align="center"><?= $d->jumlah_persetujuan ?? $d->jumlah ?></td>
    <td width="10%" align="center">Buah</td>
    <td width="10%"><?= $d->keterangan ?? '-' ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<br>

<p>
Berita acara serah terima ini dibuat sebagai bukti pengeluaran barang persediaan.
</p>

<br><br>

<!-- TTD -->
<table class="ttd">
<tr>
    <td class="text-center">
        PIHAK KEDUA<br><br><br><br>
        <u>Dr. Kanti Budiarti S.Sos, M.Si</u><br>
        Pembina Tingkat IV/b<br>
        NIP 197202011992012001
    </td>

    <td class="text-center">
        PIHAK PERTAMA<br><br><br><br>
        <u>Ratna Sari</u><br>
        Penata Muda/III-a<br>
        NIP 197507262008012006
    </td>
</tr>
</table>

</body>
</html>