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
    margin-top: 8px;
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

/* BORDER TIPIS */
.table-main th,
.table-main td {
    border: 0.5px solid black;
    padding: 4px;
}

/* HEADER TABEL */
.table-main th {
    text-align: center;
    vertical-align: middle; /* biar tengah atas-bawah juga */
    font-weight: bold;
}
.table-main td {
    vertical-align: top;
    line-height: 1.3;
    word-wrap: break-word;
}

/* CENTER */
.center {
    text-align: center;
}
</style>

</head>
<body>

<!-- 🔥 HEADER SAMA KAYAK SPB -->
<div class="header">
    <img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="70"><br>
    <strong>PEMERINTAH KOTA SURABAYA</strong><br>
    <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong>
</div>

<!-- 🔥 JUDUL (DIGANTI RIWAYAT) -->
<div class="judul">
    <span style="border-bottom:1px solid black; padding-bottom:3px;">
        <strong>RIWAYAT BARANG</strong>
    </span><br>
</div>

<!-- 🔥 INFO BARANG -->
<table class="info">
<tr>
    <td width="200">Nama Barang</td>
    <td width="10">:</td>
    <td><?= $barang->nama_barang ?></td>
</tr>
<tr>
    <td>Kode Barang</td>
    <td>:</td>
    <td><?= $barang->kode_barang ?></td>
</tr>
<tr>
    <td>No Register</td>
    <td>:</td>
    <td><?= $barang->no_register ?></td>
</tr>
</table>

<br><br>

<!-- 🔥 TABEL RIWAYAT -->
<table class="table-main">
<thead>
<tr>
    <th width="6%" align="center"><b>No</b></th>
<th width="14%" align="center"><b>Bulan</b></th>
<th width="10%" align="center"><b>Tahun</b></th>
<th width="30%" align="center"><b>Lokasi Barang</b></th>
<th width="30%" align="center"><b>Ruangan</b></th>
<th width="10%" align="center"><b>Kondisi</b></th>
</tr>
</thead>

<tbody>

<?php 
function bulanIndo($b){
    $bulan = [
        1=>'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
    ];
    return $bulan[(int)$b] ?? '-';
}
?>

<?php $no=1; foreach($riwayat as $r): ?>
<?php if(!$r->bulan && !$r->tahun && !$r->lokasi_barang) continue; ?>

<tr>
    <td width="6%" class="center"><?= $no++ ?></td>
    <td width="14%" class="center"><?= bulanIndo($r->bulan) ?></td>
    <td width="10%" class="center"><?= $r->tahun ?></td>
    <td width="30%"><?= $r->lokasi_barang ?></td>
    <td width="30%"><?= $r->ruangan ?></td>
    <td width="10%" class="center"><?= $r->kondisi ?? '-' ?></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

<br><br><br><br>

<table width="100%">
<tr>
<td width="65%"></td>
<td>
    Surabaya, <?= date('d F Y') ?><br>
    Pengurus Barang Pengguna,<br><br><br><br>

    <strong><?= $barang->nama_petugas ?? '-' ?></strong><br>
    NIP <?= $barang->nip ?? '-' ?>
</td>
</tr>
</table>

</body>
</html>