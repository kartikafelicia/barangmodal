<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
body {
    font-family: "Times New Roman", serif;
    font-size: 12px;
}

/* HEADER */
.header {
    text-align: center;
    line-height: 1.0;
}

/* JUDUL */
.judul {
    text-align: center;
    margin-top: 9px;
}

/* GARIS (TIPIS & CLEAN) */
.line {
    border-bottom: 1px solid black;
    margin: 8px 0 12px 0;
}

/* INFO */
.info td {
    padding: 2px;
}

/* TABLE */
.table-main {
    width: 100%;
    border-collapse: collapse;
    
}

/* GARIS TABEL (TIPIS) */
.table-main th,
.table-main td {
    border: 0.5px solid black;
    padding: 4px;
}

/* HEADER TABEL */
.table-main th {
    text-align: center;
    font-weight: bold;
}

/* CENTER */
.center {
    text-align: center;
}

/* TTD */
.ttd {
    width: 100%;
}
</style>

</head>
<body>

<!-- HEADER -->
<div class="header">
    <img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="70"><br>
    <strong>PEMERINTAH KOTA SURABAYA</strong><br>
    <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong>
</div>

<!-- JUDUL -->
<div style="text-align:center;">
    <span style="border-bottom:1px solid black; padding-bottom:3px;">
        <strong>SURAT PERMINTAAN BARANG (SPB)</strong>
    </span><br>
    Nomor: <?= $permintaan->nomor_spb ?>
</div>

<!-- INFORMASI -->
<table class="info">
<tr>
    <td colspan="3"><strong>Dasar Permintaan</strong></td>
</tr>
<tr>
    <td width="200">a. Nomor</td>
    <td width="10">:</td>
    <td><?= $permintaan->nomor_spb ?></td>
</tr>
<tr>
    <td>b. Tanggal</td>
    <td>:</td>
    <td><?= date('d F Y', strtotime($permintaan->tanggal)) ?></td>
</tr>
<tr>
    <td>c. Pihak yang meminta</td>
    <td>:</td>
    <td><?= $permintaan->pihak ?></td>
</tr>
</table>

<!-- 🔥 JARAK WAJIB (BIAR GA MEPET) -->
<br><br>

<!-- TABEL -->
<table class="table-main">
<thead>
<tr style="text-align:center; font-weight:bold;">
    <th rowspan="2" width="4%">No</th>
    <th rowspan="2" width="8%">Kode Barang</th>
    <th rowspan="2" width="18%">Nama Barang</th>
    <th rowspan="2" width="5%">NUSP</th>
    <th rowspan="2" width="8%">Spesifikasi</th>

    <th colspan="2" width="14%">Pengajuan Permintaan</th>
    <th colspan="2" width="14%">Informasi Sisa Barang</th>
    <th colspan="2" width="14%">Usulan Pengajuan</th>

    <th rowspan="2" width="9%">Keperluan</th>
    <th rowspan="2" width="6%">Ket</th>
</tr>

<tr style="text-align:center; font-weight:bold;">
    <th width="7%">Jumlah</th>
    <th width="7%">Satuan</th>
    <th width="7%">Jumlah</th>
    <th width="7%">Satuan</th>
    <th width="7%">Jumlah</th>
    <th width="7%">Satuan</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td width="4%" align="center"><?= $no++ ?></td>
    <td width="8%" align="center"><?= $d->kode_barang ?></td>
    <td width="18%"><?= $d->nama_barang ?></td>
    <td width="5%" align="center"><?= $d->nusp ?? '-' ?></td>
    <td width="8%"><?= $d->spesifikasi ?? '-' ?></td>

    <td width="7%" align="center"><?= $d->jumlah ?></td>
    <td width="7%" align="center"><?= $d->satuan ?></td>

    <td width="7%" align="center"><?= $d->stok ?? '-' ?></td>
    <td width="7%" align="center"><?= $d->satuan ?></td>

    <td width="7%" align="center"><?= $d->jumlah_persetujuan ?? $d->jumlah ?></td>
    <td width="7%" align="center"><?= $d->satuan ?></td>

    <td width="9%"><?= $permintaan->keperluan ?? '-' ?></td>
    <td width="6%" align="center"><?= $d->keterangan ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- 🔥 JARAK KE TTD -->
<br><br><br><br>

<!-- TTD (KANAN BAWAH) -->
<table width="100%">
<tr>
<td width="65%"></td>
<td>
    Surabaya, <?= date('d F Y', strtotime($permintaan->tanggal)) ?><br>
    Pengurus Barang Pengguna,<br><br><br><br>

    <strong><?= $permintaan->nama_petugas ?></strong><br>
    NIP <?= $permintaan->nip ?>
</td>
</tr>
</table>

</body>
</html>