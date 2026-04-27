<h3 style="text-align:left;">Rekap Kategori Barang</h3>

<table border="1" cellpadding="4" cellspacing="0" width="100%" style="border-collapse:collapse;">
<thead>
<tr style="background-color:#f2f2f2; font-weight:bold; text-align:center;">
<th width="10%">No</th>
<th width="90%">Kategori</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($kategori as $k): ?>

<tr>
<td style="text-align:center;"><?= $no++ ?></td>
<td><?= $k->kategori ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>