<style>

body{
    font-family: times;
    font-size:11px;
}

table{
    border-collapse: collapse;
}

/* ❌ HAPUS SEMUA BORDER DEFAULT */
th, td{
    border:none;
    padding:4px;
}

/* HEADER TANPA GARIS */
.header td{
    border:none;
}

.table-barang {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    margin-top: 10px;

    border-top: 1px solid black;
    border-bottom: 1px solid black;
}

/* HEADER */
.table-barang thead th {
    border-bottom: 1px solid black;
    text-align: center;
    font-weight: bold;
    padding: 4px;
}

/* ISI */
.table-barang td {
    padding: 4px;
    vertical-align: top;
    word-wrap: break-word;
}

/* 🔥 GARIS HALUS ANTAR ROW */
.table-barang tbody tr {
    border-bottom: 0.3px solid #999;
}

.table-barang tbody tr:last-child {
    border-bottom: none;
}

.center {
    text-align: center;
}

.right{
    text-align:right;
}

</style>


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

<div class="center">
<b>NOTA PERMINTAAN BARANG</b><br>
Nomor: <?= $permintaan->nomor_nota ?>
</div>

<br>

<!-- DATA PEMINTA -->
<table width="60%">

<tr>
<td width="40%">Kepada</td>
<td width="5%">:</td>
<td>Yth. Sdr. Pengurus Barang</td>
</tr>

<tr>
<td>Pihak Yang Meminta</td>
<td>:</td>
<td><?= $permintaan->nama ?></td>
</tr>

</table>

<br><br>

<p style="text-align:justify">
Dalam rangka Operasional Kebersihan Sarana Prasarana Kantor pada pelaksanaan tugas kedinasan
Sekretariat yang berasal dari hasil pengadaan barang pada sub kegiatan Penyediaan Jasa Pelayanan
Umum Kantor diajukan permintaan pengeluaran barang persediaan, dengan rincian sebagai berikut:
</p>

<br>

<!-- TABEL BARANG -->

<table width="100%" cellpadding="4" cellspacing="0" border="1">

<tr style="text-align:center; font-weight:bold;">
    <th width="30">No</th>
    <th width="200">Nama Barang/Item</th>
    <th width="60">Jumlah</th>
    <th width="60">Satuan</th>
    <th width="110">Keperluan</th>
    <th width="80">Keterangan</th>
</tr>

<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td align="center"><?= $no++ ?></td>
    <td><?= $d->nama_barang ?></td>
    <td align="center"><?= $d->jumlah ?></td>
    <td align="center"><?= $d->satuan ?? '-' ?></td>
    <td><?= $d->keperluan ?></td>
    <td><?= $d->keterangan ?></td>
</tr>
<?php endforeach; ?>

</table>

<br><br>

Demikian disampaikan untuk diproses lebih lanjut.

<br><br><br>

<!-- TTD -->

<table width="100%" class="no-border">

<tr>

<td width="60%"></td>

<td width="40%" class="center">

Surabaya, <?= date('d F Y') ?><br>
Sekretaris,

<br><br><br>

<b>Dr. Kanti Budiarti, S.Sos., M.Si</b><br>
Pembina TK I<br>
NIP 197202011992012001

</td>

</tr>

</table>