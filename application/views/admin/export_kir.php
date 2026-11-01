<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body {
    font-family: "Times New Roman", serif;
    font-size: 11px;
    margin: 30px;
    color: #000;
}

/* JUDUL */
.judul {
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 10px;
}

/* INFO */
.info {
    margin-bottom: 10px;
}
.info td {
    padding: 2px 4px;
    vertical-align: top;
}
.label { width: 120px; }
.sep { width: 10px; }

/* TABEL */
.table-kir {
    width: 100%;
    border-collapse: collapse;
}

.table-kir th,
.table-kir td {
    border: 1px solid #000;
    padding: 4px;
    font-size: 10px;
}

.table-kir th {
    text-align: center;
    font-weight: bold;
}

/* TTD */
.ttd {
    width: 100%;
    margin-top: 60px;
    text-align: center;
}

.ttd td {
    width: 33%;
    vertical-align: top;
}

.nama {
    margin-top: 60px;
    font-weight: bold;
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="judul">
    KARTU INVENTARISASI RUANGAN
</div>

<div style="height:20px;"></div>

<table class="info">
<tr>
    <td class="label">RUANGAN</td><td class="sep">:</td><td><?= $ruangan ?? '-' ?></td>
</tr>
<tr>
    <td class="label">LOKASI</td><td class="sep">:</td><td><?= $lokasi ?? '-' ?></td>
</tr>
<tr>
    <td class="label">SUB UNIT</td><td class="sep">:</td><td><?= $lokasi ?? '-' ?></td>
</tr>
<tr>
    <td class="label">UNIT</td><td class="sep">:</td><td><?= $lokasi ?? '-' ?></td>
</tr>
<tr>
    <td class="label">KOTA</td><td class="sep">:</td><td>SURABAYA</td>
</tr>
<tr>
    <td class="label">PROVINSI</td><td class="sep">:</td><td>JAWA TIMUR</td>
</tr>
</table>

<div style="height:15px;"></div> 
<table class="table-kir">

<colgroup>
    <col style="width:5%">
    <col style="width:18%">
    <col style="width:20%">
    <col style="width:17%">
    <col style="width:8%">
    <col style="width:14%">
    <col style="width:8%">
    <col style="width:10%">
</colgroup>

<thead>
<tr>
    <th>No</th>
    <th>Nomor Register</th>
    <th>Nama Barang</th>
    <th>Merk / Type</th>
    <th>Tahun</th>
    <th>Kode Barang</th>
    <th>Jumlah</th>
    <th>Kondisi</th>
</tr>
</thead>

<tbody>
<?php $no = 1; foreach ($kir as $k): ?>
<tr>
    <td style="text-align:center"><?= $no++ ?></td>

    <td style="text-align:center; white-space:nowrap;">
        <?= $k->no_register ?? '-' ?>
    </td>

    <td style="text-align:left;">
        <?= htmlspecialchars($k->nama_barang ?? '-') ?>
    </td>

    <td style="text-align:left;">
        <?= htmlspecialchars($k->merk_type ?? '-') ?>
    </td>

    <td style="text-align:center;">
        <?= $k->tahun_pengadaan ?? '-' ?>
    </td>

    <td style="text-align:center; white-space:nowrap;">
        <?= $k->kode_barang ?? '-' ?>
    </td>

    <td style="text-align:center;">
        <?= $k->jumlah ?? 0 ?>
    </td>

    <td style="text-align:center;">
        B
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div style="height:60px;"></div>
<table class="ttd">
<tr>
    <td>
        PENGURUS BARANG<br><br><br><br>
        <b><u>RATNASARI</u></b><br>
        NIP. 197507262008012006<br>
        Penata Muda
    </td>

    <td></td>

    <td>
        PENANGGUNG JAWAB<br><br><br><br>
        <b><u>M. FATCHUL MUIN, SE</u></b><br>
        NIP. 197005262014121002<br>
        Penata Muda / IIIA
    </td>
</tr>

<tr>
    <td colspan="3" style="padding-top:40px;">
        KEPALA UNIT<br><br><br><br>
        <b><u>Ir. ANTIEK SUGIHARTI, M.Si</u></b><br>
        NIP. 196709101996022001<br>
        Pembina Utama Muda / IV c
    </td>
</tr>
</table>

</body>
</html>