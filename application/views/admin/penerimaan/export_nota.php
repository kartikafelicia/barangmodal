<!DOCTYPE html>
<html>
<head>
    <title>Nota Penerimaan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11px;
            margin: 10px;
        }

        .text-center {
            text-align: center;
        }

        .judul {
            font-weight: bold;
            font-size: 13px;
        }

        .subjudul {
            font-weight: bold;
            margin-top: 5px;
        }

        .content {
            margin-top: 10px;
            line-height: 1.3;
            text-align: justify;
        }

        table {
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid black;
            padding: 3px;
        }

        .ttd {
            margin-top: 30px;
            width: 100%;
        }

        .ttd td {
            text-align: center;
            vertical-align: top;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<table width="100%">
<tr>
    <td width="15%" class="text-center">
        <img src="<?= base_url('assets/sneat/assets/img/logo_dinas.png') ?>" width="60">
    </td>
    <td class="text-center">
        <div class="judul">PEMERINTAH KOTA SURABAYA</div>
        <div class="judul">DINAS KETAHANAN PANGAN DAN PERTANIAN</div>
        <div>Jalan Pagesangan II Nomor 56 Surabaya 60233</div>
        <div>Telp. (031) 8282328</div>
    </td>
</tr>
</table>

<hr style="border:1px solid black; margin:5px 0;">

<!-- JUDUL -->
<div class="text-center">
    <div class="judul">BERITA ACARA SERAH TERIMA (BAST)</div>
    <div class="judul">BMD</div>

    <?php
    $jenis = [
        'pengadaan' => 'PENGADAAN',
        'hibah' => 'HIBAH / CSR',
        'instansi' => 'INSTANSI LAIN'
    ];
    ?>

    <div class="subjudul">
        JENIS: <?= $jenis[$penerimaan->jenis_penerimaan] ?? '-' ?>
    </div>

    <div class="subjudul">
        NOMOR: <?= $penerimaan->kode_unik ?>
    </div>
</div>

<!-- ISI -->
<div class="content">

    <p>
        Pada hari ini tanggal 
        <b><?= date('d-m-Y', strtotime($penerimaan->tanggal)) ?></b>, 
        bertempat di Surabaya, yang bertanda tangan di bawah ini:
    </p>

    <p>
        <b>PIHAK PERTAMA</b><br>
        Nama : <?= $penerimaan->nama_penyedia ?><br>
        Jabatan : Penyedia Barang
    </p>

    <p>
        <b>PIHAK KEDUA</b><br>
        Nama : ___________________________<br>
        Jabatan : Pengelola Barang
    </p>

    <p>
        PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA barang dengan rincian sebagai berikut:
    </p>

    <!-- TABLE -->
    <table width="100%">
        <thead>
            <tr class="text-center">
                <th width="5%">No</th>
                <th>Nama Barang</th>
                <th width="15%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($detail as $d): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $d->nama_barang ?></td>
                <td class="text-center"><?= $d->jumlah ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>

</div>

<!-- TTD -->
<table class="ttd">
<tr>
    <td>
        PIHAK KEDUA<br><br><br><br>
        ___________________________
    </td>
    <td>
        PIHAK PERTAMA<br><br><br><br>
        <?= $penerimaan->nama_penyedia ?>
    </td>
</tr>
</table>

</body>
</html>