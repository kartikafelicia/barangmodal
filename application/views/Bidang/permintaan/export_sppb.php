<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body { font-family: Arial; font-size: 10px; }

.text-center { text-align: center; }

table { width: 100%; border-collapse: collapse; }

th, td {
    border: 1px solid black;
    padding: 4px;
}

th { background: #eee; }

.no-border td {
    border: none;
    padding: 2px;
}

.ttd td { border: none; }

.header {
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<!-- HEADER -->
<table class="no-border">
    <tr>
        <!-- LOGO -->
        <td width="15%" class="text-center">
            <img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="60">
        </td>

        <!-- TEXT -->
        <td class="text-center">
            <strong>PEMERINTAH KOTA SURABAYA</strong><br>
            <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong>
        </td>
    </tr>
</table>

<br>

<!-- INFO -->
<table class="no-border">
<tr>
    <td width="150">a. Nomor</td>
    <td width="10">:</td>
    <td><?= $permintaan->nomor_sppb ?? $permintaan->kode_unik ?></td>
</tr>
<tr>
    <td>b. Tanggal</td>
    <td>:</td>
    <td><?= date('d F Y', strtotime($permintaan->tanggal)) ?></td>
</tr>
<tr>
    <td>c. Pihak yang meminta</td>
    <td>:</td>
    <td><?= $permintaan->nama ?></td>
</tr>
</table>

<br>

<!-- TABEL -->
<table>
<thead>
<tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Spesifikasi</th>
    <th colspan="2">Pengajuan Permintaan</th>
    <th>Ket</th>
</tr>
<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Jumlah</th>
    <th>Satuan</th>
    <th></th>
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
    <td>Unit</td>
    <td>Sarpras kebersihan kantor</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<br><br>

<!-- TTD -->
<table class="ttd">
<tr>
    <td></td>
    <td width="250">
        Surabaya, <?= date('d F Y', strtotime($permintaan->tanggal)) ?><br>
        Pejabat Penatausahaan Pengguna Barang,<br><br><br><br>

        <strong>Dr. Kanti Budiarti S.Sos, M.Si</strong><br>
        Pembina Tk.I<br>
        NIP 197202011992012001
    </td>
</tr>
</table>

</body>
</html>