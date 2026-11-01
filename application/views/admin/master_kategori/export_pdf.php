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

/* CENTER */
.text-center { text-align: center; }

/* HEADER */
.header td {
    border: none;
    vertical-align: middle;
}

/* GARIS ATAS */
.line-top {
    border-top: 1px solid black;
    margin-bottom: 3px;
}

/* GARIS BAWAH */
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

/* BIAR TABEL GA TERLALU MELEBAR */
.table-wrapper {
    margin-top: 10px;
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
    <strong>REKAP KATEGORI BARANG</strong>
</div>

<!-- DESKRIPSI -->
<div class="deskripsi">
    Berikut adalah daftar kategori barang yang tercatat dalam sistem:
</div>

<!-- TABEL -->
<div class="table-wrapper">
<table>
<thead>
<tr>
    <th width="8%" align="center">No</th>
    <th width="92%" align="center">Kategori</th>
</tr>
</thead>

<tbody>
<?php $no = 1; foreach($kategori as $k): ?>
<tr>
    <td width="8%" align="center"><?= $no++ ?></td>
    <td width="92%" style="padding-left:6px;"><?= $k->kategori ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<!-- FOOTER -->
<div class="footer">
    Dokumen ini dibuat sebagai rekap data kategori barang.
</div>

</body>
</html>