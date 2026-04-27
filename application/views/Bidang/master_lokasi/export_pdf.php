<h3 style="text-align:center;">Data Master Lokasi</h3>

<table border="1" cellpadding="4" cellspacing="0" width="100%" style="border-collapse:collapse; font-size:10px;">
<thead>
<tr style="background-color:#d9d9d9; text-align:center; font-weight:bold;">
<th width="10%">No</th>
<th width="25%">Nomor Lokasi</th>
<th width="65%">Lokasi</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($lokasi as $l): ?>

<tr>
<td style="text-align:center;"><?= $no++ ?></td>
<td style="text-align:center;"><?= $l->nomor_lokasi ?></td>
<td><?= $l->lokasi ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>