<table border="1">
<thead>
<tr>
<th>No</th>
<th>Nomor Lokasi</th>
<th>Lokasi</th>
<th>Unit</th>
<th>Kode Barang</th>
<th>Kode Neraca</th>
<th>No Register</th>
<th>Nama Barang</th>
<th>Merk/Type</th>
<th>Ukuran CC</th>
<th>Bahan</th>
<th>Tahun</th>
<th>Kondisi B</th>
<th>Kondisi KB</th>
<th>Kondisi RB</th>
<th>Rangka Seri</th>
<th>Nomor Mesin</th>
<th>Nomor Nopol</th>
<th>Nomor BPKB</th>
<th>Asal Usul Pemda</th>
<th>Asal Usul Unit</th>
<th>Jumlah</th>
<th>Satuan</th>
<th>Harga</th>
<th>Sisa Umur</th>
<th>Beban Rp</th>
<th>Akumulasi Susut Rp</th>
<th>Keterangan</th>
<th>Kategori</th>
<th>Sub Kategori</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($barang as $b): ?>

<tr>
<td><?= $no++ ?></td>
<td><?= $b->nomor_lokasi ?></td>
<td><?= $b->lokasi ?></td>
<td><?= $b->unit ?></td>
<td><?= $b->kode_barang ?></td>
<td><?= $b->kode_neraca ?></td>
<td><?= $b->no_register ?></td>
<td><?= $b->nama_barang ?></td>
<td><?= $b->merk_type ?></td>
<td><?= $b->ukuran_cc ?></td>
<td><?= $b->bahan ?></td>
<td><?= $b->tahun_pengadaan ?></td>
<td><?= $b->kondisi_B ?></td>
<td><?= $b->kondisi_KB ?></td>
<td><?= $b->kondisi_RB ?></td>
<td><?= $b->rangka_seri ?></td>
<td><?= $b->nomor_mesin ?></td>
<td><?= $b->nomor_nopol ?></td>
<td><?= $b->nomor_bpkb ?></td>
<td><?= $b->asal_usul_pemda ?></td>
<td><?= $b->asal_usul_unit ?></td>
<td><?= $b->jumlah ?></td>
<td><?= $b->satuan ?></td>
<td><?= $b->harga ?></td>
<td><?= $b->sisa_umur ?></td>
<td><?= $b->beban_rp ?></td>
<td><?= $b->akumulasi_susut_rp ?></td>
<td><?= $b->keterangan ?></td>
<td><?= $b->kategori ?></td>
<td><?= $b->sub_kategori ?></td>
</tr>

<?php endforeach ?>

</tbody>
</table>