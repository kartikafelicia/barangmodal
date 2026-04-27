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
<tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Spesifikasi</th>
    <th>Jumlah</th>
    <th>Satuan</th>
    <th>Ket</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d->kode_barang ?></td>
    <td><?= $d->nama_barang ?></td>
    <td>-</td>
    <td><?= $d->jumlah ?></td>
    <td>Buah</td>
    <td><?= $d->keterangan ?? '-' ?></td>
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