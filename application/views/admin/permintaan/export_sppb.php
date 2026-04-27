<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
body{
    font-family: times;
    font-size:11px;
}

table{
    border-collapse: collapse;
}

/* HEADER */
.header td{
    border:none;
}

/* TANPA BORDER */
.no-border td{
    border:none;
    padding:2px;
}

.center{
    text-align:center;
}

.right{
    text-align:right;
}
</style>

</head>
<body>

<!-- ================= HEADER ================= -->
<table width="100%" class="header">
<tr>

<td width="15%" class="center">
<img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="60">
</td>

<td width="85%" class="center">
<b>PEMERINTAH KOTA SURABAYA</b><br>
<b>DINAS KETAHANAN PANGAN DAN PERTANIAN</b><br>
Jalan Pagesangan II Nomor 56 Surabaya 60233 Surabaya<br>
Telp. (031) 8282328 Fax. (031) 8282328
</td>

</tr>
</table>

<br>

<!-- ================= JUDUL ================= -->
<div class="center">
<b>SURAT PERSETUJUAN PENGELUARAN BARANG (SPPB)</b><br>
Nomor: <?= $permintaan->nomor_sppb ?? $permintaan->kode_unik ?>
</div>

<br>

<!-- ================= INFO ================= -->
<table width="60%">

<tr>
<td width="40%">Pihak Yang Meminta</td>
<td width="5%">:</td>
<td><?= $permintaan->nama ?></td>
</tr>

<tr>
<td>Tanggal</td>
<td>:</td>
<td><?= date('d F Y', strtotime($permintaan->tanggal)) ?></td>
</tr>

</table>

<br><br>

<!-- ================= PARAGRAF ================= -->
<p style="text-align:justify">
Berdasarkan permintaan yang diajukan, disetujui pengeluaran barang persediaan
untuk keperluan operasional dengan rincian sebagai berikut:
</p>

<br>

<!-- ================= TABEL ================= -->
<table width="100%" cellpadding="4" cellspacing="0" border="1">

<tr style="text-align:center; font-weight:bold;">
    <th width="5%" rowspan="2">No</th>
    <th width="20%" rowspan="2">Kode Barang</th>
    <th width="30%" rowspan="2">Nama Barang</th>
    <th width="14%" rowspan="2">Spesifikasi</th>
    <th width="16%" colspan="2">Pengajuan Permintaan</th>
    <th width="15%" rowspan="2">Ket</th>
</tr>
<tr>
    <th width="8%">Jumlah</th>
    <th width="8%">Satuan</th>
</tr>

<tbody>
<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td width="5%" align="center"><?= $no++ ?></td>
    <td width="20%"><?= $d->kode_barang ?></td>
    <td width="30%"><?= $d->nama_barang ?></td>
    <td width="14%">-</td>
    <td width="8%" align="center"><?= $d->jumlah_persetujuan ?: $d->jumlah ?></td>
    <td width="8%" align="center">Unit</td>
    <td width="15%">Sarpras kebersihan kantor</td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

<br><br>

<!-- ================= PENUTUP ================= -->
Demikian disampaikan untuk dipergunakan sebagaimana mestinya.

<br><br><br>

<!-- ================= TTD ================= -->
<table width="100%" class="no-border">

<tr>

<td width="60%"></td>

<td width="40%" class="center">

Surabaya, <?= date('d F Y', strtotime($permintaan->tanggal)) ?><br>
Pejabat Penatausahaan Pengguna Barang,<br><br><br><br>

<b>Dr. Kanti Budiarti, S.Sos., M.Si</b><br>
Pembina Tk.I<br>
NIP 197202011992012001

</td>

</tr>

</table>

</body>
</html>