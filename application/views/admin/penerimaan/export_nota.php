<!DOCTYPE html>
<html>
<head>
    <title>Nota Penerimaan</title>
    <style>

    body{
        font-family: times;
        font-size:11px;
    }

    table{
        border-collapse: collapse;
    }

    th, td{
        border:none;
        padding:4px;
    }

    .header td{
        border:none;
    }

    .table-barang {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    margin-top: 10px;

    border: 1px solid black; /* garis luar */
}


/* 🔥 GARIS FULL GRID */
.table-barang th,
.table-barang td {
    border: 1px solid black;
    padding: 5px;
}

.table-barang thead th {
    border: 1px solid black;
    text-align: center;
    font-weight: bold;
}
.table-barang tbody td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-top: none;
    border-bottom: none;
    padding: 5px;
}
.center {
    text-align: center;
}

    </style>
</head>
<body>

<!-- HEADER -->
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

<!-- JUDUL -->
<div class="center">
    <b>NOTA PENERIMAAN BARANG</b><br>
    Nomor: <?= $penerimaan->kode_unik ?>
</div>

<br><br>

<!-- ISI -->
<p style="text-align:justify">
Pada hari ini tanggal 
<b><?= date('d-m-Y', strtotime($penerimaan->tanggal)) ?></b>, 
bertempat di Surabaya, yang bertanda tangan di bawah ini:
</p>

<br>

<!-- PIHAK -->
<p>
<b>PIHAK PERTAMA</b><br>
Nama : <?= $penerimaan->nama_penyedia ?><br>
Jabatan : Penyedia Barang
</p>

<br>

<p>
<b>PIHAK KEDUA</b><br>
Nama : ___________________________<br>
Jabatan : Pengelola Barang
</p>

<br>

<p style="text-align:justify">
PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA barang dengan rincian sebagai berikut:
</p>

<br>

<!-- TABEL BARANG -->
<table class="table-barang">

<tr>
    <th style="width:5%">No</th>
    <th style="width:70%">Nama Barang/Item</th>
    <th style="width:25%">Jumlah</th>
</tr>

<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td class="center"><?= $no++ ?></td>
    <td><?= $d->nama_barang ?></td>
    <td class="center"><?= $d->jumlah ?></td>
</tr>
<?php endforeach; ?>

</table>

<br><br>

<p>
Demikian berita acara penerimaan ini dibuat untuk dipergunakan sebagaimana mestinya.
</p>

<br><br><br>

<!-- TTD -->
<table width="100%">

<tr>

<td width="50%" class="center">
PIHAK KEDUA<br><br><br><br>
___________________________
</td>

<td width="50%" class="center">
PIHAK PERTAMA<br><br><br><br>
<?= $penerimaan->nama_penyedia ?>
</td>

</tr>

</table>

</body>
</html>