<style>

body{
    font-family: times;
    font-size:11px;
}

table{
    border-collapse: collapse;
}

th, td{
    border:1px solid black;
    padding:4px;
}

.header td{
    border:1px solid black;
}

.no-border td{
    border:none;
}

.center{
    text-align:center;
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
Dalam rangka Operasional Kebersihan Sarana Prasarana Kantor pada pelaksanaan tugas
kedinasan diajukan permintaan pengeluaran barang persediaan dengan rincian sebagai berikut:
</p>

<br>

<!-- TABEL BARANG -->

<table width="100%">

<tr class="center">

<th width="5%">No</th>
<th width="40%">Nama Barang/Item</th>
<th width="10%">Jumlah</th>
<th width="10%">Satuan</th>
<th width="20%">Keperluan</th>
<th width="15%">Keterangan</th>

</tr>

<?php $no=1; foreach($detail as $d): ?>

<tr>

<td class="center"><?= $no++ ?></td>
<td><?= $d->nama_barang ?></td>
<td class="center"><?= $d->jumlah ?></td>
<td class="center"><?= $d->satuan ?? '-' ?></td>
<td><?= $d->keperluan ?></td>
<td><?= $d->keterangan ?></td>

</tr>

<?php endforeach ?>

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