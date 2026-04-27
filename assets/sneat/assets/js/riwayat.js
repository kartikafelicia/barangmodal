let currentBarangId = null;

function loadDetailBarang(id) {
  
  currentBarangId = id;

  fetch(APP_URL + "admin/riwayat/get_detail_barang/" + id)
    .then(res => res.json())
    .then(res => {

      let barang = res.barang;
      let riwayat = res.riwayat;

      // isi data atas
      document.getElementById("d_nama").value = barang.nama_barang ?? '';
      document.getElementById("d_kode").value = barang.kode_barang ?? '';
      document.getElementById("d_register").value = barang.no_register ?? '';

      let html = "";
      let no = 1;

      if (riwayat.length > 0) {
        riwayat.forEach(h => {
          html += `
            <tr>
              <td class="text-center">${no++}</td>
              <td>${h.bulan ?? '-'}</td>
              <td>${h.tahun ?? '-'}</td>
              <td>${h.lokasi_barang ?? '-'}</td>
              <td>${h.ruangan ?? '-'}</td>
              <td>${h.kondisi ?? '-'}</td>
            </tr>
          `;
        });
      } else {
        html = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
      }

      document.getElementById("detailBody").innerHTML = html;

      new bootstrap.Modal(document.getElementById('modalBarang')).show();
    });
}

function exportRiwayat() {
  if (!currentBarangId) {
    alert("Data belum dipilih");
    return;
  }

  window.open(APP_URL + "admin/riwayat/export_riwayat/" + currentBarangId, '_blank');
}


