<table border="1">
<thead>
<tr>
<th>No</th>
<th>Nomor Lokasi</th>
<th>Lokasi</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($lokasi as $b): ?>

<tr>
<td><?= $no++ ?></td>
<td><?= $b->nomor_lokasi ?></td>
<td><?= $b->lokasi ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>