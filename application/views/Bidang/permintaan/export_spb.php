<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .text-center { text-align: center; }
        .mt-2 { margin-top: 10px; }
        .mt-3 { margin-top: 20px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            vertical-align: middle;
        }

        th {
            background-color: #f0f0f0;
        }

        .no-border td {
            border: none;
            padding: 2px;
        }

        .ttd {
            width: 100%;
            margin-top: 40px;
        }

        .ttd td {
            border: none;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<table class="no-border">
    <tr>
        <td width="15%" class="text-center">
            <img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="60">
        </td>

        <td class="text-center">
            <strong>PEMERINTAH KOTA SURABAYA</strong><br>
            <strong>DINAS KETAHANAN PANGAN DAN PERTANIAN</strong>
        </td>
    </tr>
</table>

<!-- INFORMASI -->
<table class="no-border mt-3">
    <tr>
        <td width="200">a. Nomor</td>
        <td width="10">:</td>
        <td><?= $permintaan->nomor_spb ?? '-' ?></td>
    </tr>
    <tr>
        <td>b. Tanggal</td>
        <td>:</td>
        <td>
            <?= !empty($permintaan->tanggal) 
                ? date('d F Y', strtotime($permintaan->tanggal)) 
                : '-' ?>
        </td>
    </tr>
    <tr>
        <td>c. Pihak yang meminta</td>
        <td>:</td>
        <td><?= $permintaan->pihak ?? '-' ?></td>
    </tr>
</table>

<!-- TABEL -->
<table class="mt-3">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kode Barang</th>
            <th rowspan="2">Nama Barang</th>
            <th rowspan="2">NUSP</th>
            <th rowspan="2">Spesifikasi</th>
            <th colspan="2">jumlah</th>
            <th colspan="2">satuan</th>
            <th rowspan="2">Keperluan</th>
            <th rowspan="2">Keterangan</th>
        </tr>
    </thead>

    <tbody>
        <?php if(!empty($detail)): ?>
            <?php $no = 1; foreach($detail as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->kode_barang ?? '-' ?></td>
                <td><?= $d->nama_barang ?? '-' ?></td>
                <td><?= $d->nusp ?? '-' ?></td>
                <td><?= $d->spesifikasi ?? '-' ?></td>
                <td><?= $d->jumlah ?? 0 ?></td>
                <td><?= $d->satuan ?? 'Unit' ?></td>
                <td><?= $d->keperluan ?? '-' ?></td>
                <td><?= $d->keterangan ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="13" class="text-center">Data tidak tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- TTD -->
<table class="ttd">
    <tr>
        <td></td>
        <td width="250">
            Surabaya, 
            <?= !empty($permintaan->tanggal) 
                ? date('d F Y', strtotime($permintaan->tanggal)) 
                : '-' ?><br>

            Pengurus Barang Pengguna,<br><br><br><br>

            <strong><?= $permintaan->nama_petugas ?? '-' ?></strong><br>
            NIP <?= $permintaan->nip ?? '-' ?>
        </td>
    </tr>
</table>

</body>
</html>