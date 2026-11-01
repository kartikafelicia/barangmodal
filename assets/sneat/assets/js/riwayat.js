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

      let lastLokasi = "-";
      let lastRuangan = "-";
      let lastBulan = "-";
      let lastTahun = "-";

      if (riwayat.length > 0) {

        riwayat.forEach(h => {

          // skip kalau kosong semua
          if (!h.bulan && !h.tahun && !h.lokasi_barang && !h.ruangan && !h.kondisi) {
            return;
          }

          // simpan data terakhir
          if (h.bulan) lastBulan = h.bulan;
          if (h.tahun) lastTahun = h.tahun;
          if (h.lokasi_barang) lastLokasi = h.lokasi_barang;
          if (h.ruangan) lastRuangan = h.ruangan;

          html += `
            <tr>
              <td class="text-center">${no++}</td>
              <td>${lastBulan}</td>
              <td>${lastTahun}</td>
              <td>${lastLokasi}</td>
              <td>${lastRuangan}</td>
              <td class="text-center">${h.kondisi ?? '-'}</td>
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


