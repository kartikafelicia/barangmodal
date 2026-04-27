<h3 style="text-align:center;">Data Master Posisi Barang</h3>

<table border="1" cellpadding="4" cellspacing="0" width="100%" style="border-collapse:collapse; font-size:10px;">
<thead>
<tr style="background-color:#d9d9d9; text-align:center; font-weight:bold;">
    <th width="10%">No</th>
    <th width="30%">Lokasi</th>
    <th width="30%">Ruangan</th>
    <th width="30%">Nomor Ruangan</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($posisi_barang as $p): ?>

<tr>
    <td style="text-align:center;"><?= $no++ ?></td>
    <td><?= $p->lokasi ?></td>
    <td><?= $p->ruangan ?></td>
    <td style="text-align:center;"><?= $p->nomor_ruangan ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>