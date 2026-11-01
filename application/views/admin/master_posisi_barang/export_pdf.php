<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
body {
    font-family: Arial;
    font-size: 11px;
    margin: 30px;
}

/* HEADER */
.header td {
    border: none;
    vertical-align: middle;
}

.text-center {
    text-align: center;
}

/* GARIS */
.line-top {
    border-top: 1px solid black;
    margin-bottom: 3px;
}

.line-bottom {
    border-top: 3px solid black;
    margin-bottom: 15px;
}

/* JUDUL */
.judul {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 20px;
}

/* DESKRIPSI */
.deskripsi {
    margin-bottom: 15px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 6px;
}

th {
    text-align: center;
    background-color: #f2f2f2;
}

/* WRAPPER */
.table-wrapper {
    margin: 10px 20px;
}

/* FOOTER */
.footer {
    margin-top: 30px;
}
</style>

</head>

<body>

<!-- HEADER -->
<table class="header">
<tr>
    <td width="12%" class="text-center">
        <img src="<?= FCPATH.'assets/sneat/assets/img/logo_dinas.png' ?>" width="60">
    </td>
    <td width="88%" class="text-center" style="padding-right:40px;">
        <strong>PEMERINTAH KOTA SURABAYA</strong><br>
        <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong><br>
        Jalan Pagesangan II Nomor 56 Surabaya 60233<br>
        Telp. (031) 8282328
    </td>
</tr>
</table>

<div class="line-top"></div>
<!-- JUDUL -->
<div class="judul">
    <strong style="border-bottom:1px solid black; padding-bottom:3px;">
        DATA MASTER POSISI BARANG
    </strong>
</div>

<!-- DESKRIPSI -->
<div class="deskripsi">
    Berikut adalah daftar posisi barang yang tercatat dalam sistem:
</div>

<!-- TABEL -->
<div class="table-wrapper">
<table>
<thead>
<tr>
    <th width="8%" align="center">No</th>
    <th width="30%" align="center">Lokasi</th>
    <th width="32%" align="center">Ruangan</th>
    <th width="30%" align="center">Nomor Ruangan</th>
</tr>
</thead>

<tbody>
<?php $no = 1; foreach($posisi_barang as $p): ?>
<tr>
    <td width="8%" align="center"><?= $no++ ?></td>
    <td width="30%" style="padding-left:6px;"><?= $p->lokasi ?></td>
    <td width="32%" style="padding-left:6px;"><?= $p->ruangan ?></td>
    <td width="30%" align="center"><?= $p->nomor_ruangan ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</body>
</html>