<table border="1">
<thead>
<tr>
<th>No</th>
<th>Kategori</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($kategori as $k): ?>

<tr>
<td><?= $no++ ?></td>
<td><?= $k->kategori ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>