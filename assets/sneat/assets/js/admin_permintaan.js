
let currentKodeUnik = null;

/* =====================================
   SPB
===================================== */
function loadSPB(kode_unik) {
    currentKodeUnik = kode_unik;
    console.log("KLIK SPB:", kode_unik);

    const kodeUnikInput = document.getElementById("kode_unik");
    if (kodeUnikInput) kodeUnikInput.value = kode_unik;

    fetch(APP_URL + "admin/permintaan/get_spb/" + kode_unik)
        .then(res => {
            if (!res.ok) {
                throw new Error(`HTTP ${res.status} - ${res.statusText}`);
            }
            return res.json();
        })
        .then(res => {
            console.log("RESPONSE SPB:", res);

            if (res.error) {
                alert("Error: " + res.error);
                return;
            }

            let p = res.permintaan || {};
            let detail = res.detail || [];
            let isLocked = res.is_locked;

            // isi header dengan aman
            setValue("nomor_spb", p.nomor_spb);
            setValue("tanggal", p.tanggal);
            setValue("pemohon", p.nama || p.pemohon || '-');
            setValue("keperluan", p.keperluan);

            document.getElementById("nomor_spb").readOnly = isLocked;
            document.getElementById("pemohon").readOnly = isLocked;
            document.getElementById("keperluan").readOnly = isLocked;
            
            const btnSimpan = document.getElementById("btnSimpanSPB");
            const btnDownload = document.getElementById("btnDownloadSPB");

            if (isLocked) {
                btnSimpan.style.display = "none";
                btnDownload.style.display = "inline-block";
            } else {
                btnSimpan.style.display = "inline-block";
                btnDownload.style.display = "none";
            }

            renderSPBTable(detail, isLocked);
            let modalEl = document.getElementById('spbModal');
let modal = bootstrap.Modal.getInstance(modalEl);

if (!modal) {
    modal = new bootstrap.Modal(modalEl);
}

modal.show();
        })
        .catch(err => {
            console.error("ERROR SPB:", err);
            alert("Gagal load SPB: " + err.message);
        });
}
// Helper setValue (tetap)
function setValue(id, value) {
    let el = document.getElementById(id);
    if (el) el.value = value ?? '';
}
function renderSPBTable(data, isLocked) {
    const tbody = document.getElementById("spbBody");
    if (!tbody) return;

    if (!Array.isArray(data) || data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="11" class="text-center">Data kosong</td></tr>`;
        return;
    }

    let html = "";
    data.forEach((item, i) => {
        // Default value untuk menghindari undefined
        const kode_barang = item.kode_barang ?? '-';
        const nama_barang = item.nama_barang ?? '-';
        const jumlah = item.jumlah ?? 0;
        const jumlahSetuju = item.jumlah_persetujuan ?? jumlah;
        const satuan = item.satuan ?? 'Unit';
        const id = item.id ?? '';
       
        html += `
<tr>
    <td>${i+1}</td>
    <td>${kode_barang}</td>
    <td>${nama_barang}</td>

    <!-- PENGAJUAN -->
    <td>${jumlah}</td>
    <td>${satuan}</td>

    <!-- SISA -->
    <td>-</td>
    <td>${satuan}</td>

    <!-- DISETUJUI -->
    <td>
        <input type="hidden" name="id[${i}]" value="${id}">

        <input type="number" class="form-control"
            name="jumlah_persetujuan[${i}]"
            value="${jumlahSetuju}"
            ${isLocked ? 'readonly' : ''}>
    </td>

    <td>${satuan}</td>
    <td>-</td>
    <td>-</td>
</tr>
`;
    });
    tbody.innerHTML = html;
}
function simpanSPB() {
    let form = document.getElementById("formSPB");
    let formData = new FormData(form);

    fetch(APP_URL + "admin/permintaan/simpan_spb", {
        method: "POST",
        body: formData
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, body: data })))
    .then(res => {
        if (!res.ok) {
            alert("Error: " + (res.body.message || "Gagal menyimpan SPB"));
            return;
        }
        alert("SPB berhasil disimpan");

        // 🔥 reload modal kayak NOTA
        loadSPB(currentKodeUnik);
    })
    .catch(err => {
        alert("Terjadi kesalahan: " + err.message);
    });
}
function downloadSPB() {
  if (!currentKodeUnik) {
    alert("Kode unik tidak ditemukan!");
    return;
  }

  window.open(
    APP_URL + "admin/permintaan/cetak_spb/" + currentKodeUnik,
    "_blank"
  );
}

/* =====================================
   SPPB
===================================== */
function loadSPPB(kode_unik) {
    currentKodeUnik = kode_unik;

    const kodeUnikInput = document.getElementById("kode_unik_sppb");
    if (kodeUnikInput) kodeUnikInput.value = kode_unik;

    fetch(APP_URL + "admin/permintaan/get_sppb/" + kode_unik)
        .then(res => {
            if (!res.ok) {
                throw new Error(`HTTP ${res.status} - ${res.statusText}`);
            }
            return res.json();
        })
        .then(res => {
            console.log("RESPONSE SPPB:", res);

            if (res.error) {
                alert("Error: " + res.error);
                return;
            }

            let p = res.permintaan || {};
            let detail = res.detail || [];
            let isLocked = res.is_locked; 

            // isi header dengan aman
            setValue("nomor_sppb", p.nomor_sppb);
            setValue("tanggal_sppb", p.tanggal);
            setValue("nama_sppb", p.nama || p.nama || '-');

            document.getElementById("nomor_sppb").readOnly = isLocked;
            document.getElementById("nama_sppb").readOnly = isLocked;

            const btnSimpan = document.getElementById("btnSimpanSPPB");
            const btnDownload = document.getElementById("btnDownloadSPPB");

            if (isLocked) {
                btnSimpan.style.display = "none";
                btnDownload.style.display = "inline-block";
            } else {
                btnSimpan.style.display = "inline-block";
                btnDownload.style.display = "none";
            }

            renderSPPBTable(detail, isLocked);

            let modalEl = document.getElementById('sppbModal');
            let modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) {
                modal = new bootstrap.Modal(modalEl);
            }

            modal.show();
             })
              .catch(err => {
                  console.error("ERROR SPB:", err);
                  alert("Gagal load SPPB: " + err.message);
              });
}
function setValue(id, value) {
    let el = document.getElementById(id);
    if (el) el.value = value ?? '';
}
function renderSPPBTable(data, isLocked) {
    const tbody = document.getElementById("sppbBody");
    if (!tbody) return;

    if (!Array.isArray(data) || data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data kosong</td></tr>`;
        return;
    }

    let html = "";
    data.forEach((item, i) => {
        const kode_barang = item.kode_barang ?? '-';
        const nama_barang = item.nama_barang ?? '-';
        const jumlah = item.jumlah ?? 0;
        const jumlahSetuju = item.jumlah_persetujuan ?? 0;
        const satuan = item.satuan ?? 'Unit';
        const ket = item.keterangan ?? '';
        const id = item.id ?? '';

        html += `
        <tr>
            <td>${kode_barang}</td>
            <td>${nama_barang}</td>

            <!-- PENGAJUAN -->
            <td class="text-center">
                <input type="number" class="form-control text-center" 
                    value="${jumlah}" readonly>
            </td>
            <td class="text-center">
                <input type="text" class="form-control text-center" 
                    value="${satuan}" readonly>
            </td>

            <!-- DISETUJUI -->
            <td>
                <input type="hidden" name="id[${i}]" value="${id}">
                <input type="number" class="form-control text-center"
                    name="jumlah_persetujuan[${i}]"
                    value="${jumlahSetuju}"
                    ${isLocked ? 'readonly' : ''}>
            </td>

            <td>
                <input type="text" class="form-control text-center"
                    value="${satuan}" readonly>
            </td>

            <!-- KETERANGAN -->
            <td>
                <input type="text" class="form-control"
                    name="keterangan[${i}]"
                    value="${ket}"
                    ${isLocked ? 'readonly' : ''}>
            </td>
        </tr>
        `;
    });

    tbody.innerHTML = html;
}
function simpanSPPB() {
    let form = document.getElementById("formSPPB");
    let formData = new FormData(form);

    fetch(APP_URL + "admin/permintaan/simpan_sppb", {
        method: "POST",
        body: formData
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, body: data })))
    .then(res => {
        if (!res.ok) {
            alert("Error: " + (res.body.message || "Gagal menyimpan SPPB"));
            return;
        }
        alert("SPPB berhasil disimpan");

        loadSPPB(currentKodeUnik);
    })
    .catch(err => {
        alert("Terjadi kesalahan: " + err.message);
    });
}
function downloadSPPB() {
  if (!currentKodeUnik) {
    alert("Kode unik tidak ditemukan!");
    return;
  }

  window.open(
    APP_URL + "admin/permintaan/cetak_sppb/" + currentKodeUnik,
    "_blank"
  );
}

/* =====================================
   BAST
===================================== */
function loadBAST(kode_unik) {
    currentKodeUnik = kode_unik;

    const kodeUnikInput = document.getElementById("kode_unik_bast");
    if (kodeUnikInput) kodeUnikInput.value = kode_unik;

    fetch(APP_URL + "admin/permintaan/get_bast/" + kode_unik)
        .then(res => res.json())
        .then(res => {

            let p = res.permintaan || {};
            let detail = res.detail || [];
            let isLocked = res.is_locked;

            // HEADER (SAMA POLA SPPB)
            setValue("nomor_bast", p.nomor_bast);
            setValue("tanggal_bast", p.tanggal);
            setValue("penyerah", p.nama);

            // LOCK
            document.getElementById("nomor_bast").readOnly = isLocked;
            document.getElementById("penyerah").readOnly = isLocked;

            // TOGGLE BUTTON (SAMA PERSIS)
            const btnSimpan = document.getElementById("btnSimpanBAST");
            const btnDownload = document.getElementById("btnDownloadBAST");

            if (isLocked) {
                btnSimpan.style.display = "none";
                btnDownload.style.display = "inline-block";
            } else {
                btnSimpan.style.display = "inline-block";
                btnDownload.style.display = "none";
            }

            renderBASTTable(detail, isLocked);

            let modalEl = document.getElementById('bastModal');
            let modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) modal = new bootstrap.Modal(modalEl);

            modal.show();
        });
}
function renderBASTTable(data, isLocked) {
    const tbody = document.getElementById("bastBody");

    if (!Array.isArray(data) || data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center">Data kosong</td></tr>`;
        return;
    }

    let html = "";

    data.forEach((item, i) => {
        html += `
        <tr>
            <td>${i+1}</td>
            <td>${item.kode_barang}</td>
            <td>${item.nama_barang}</td>

            <td class="text-center">
                ${item.jumlah_persetujuan ?? item.jumlah}
            </td>
            <td class="text-center">${item.satuan}</td>

            <td>
                <input type="hidden" name="id[${i}]" value="${item.id}">
                <input type="text" class="form-control"
                    name="keterangan[${i}]"
                    value="${item.keterangan ?? ''}"
                    ${isLocked ? 'readonly' : ''}>
            </td>
        </tr>
        `;
    });

    tbody.innerHTML = html;
}
function simpanBAST() {
    let form = document.getElementById("formBAST");
    let formData = new FormData(form);

    fetch(APP_URL + "admin/permintaan/simpan_bast", {
        method: "POST",
        body: formData
    })
    .then(res => res.json().then(data => ({ status: res.status, ok: res.ok, body: data })))
    .then(res => {
        if (!res.ok) {
            alert("Error: " + (res.body.message || "Gagal menyimpan BAST"));
            return;
        }
        alert("BAST berhasil disimpan");
        loadBAST(currentKodeUnik);
    })
    .catch(err => {
        alert("Terjadi kesalahan: " + err.message);
    });
}
function downloadBAST() {
  if (!currentKodeUnik) {
    alert("Kode unik tidak ditemukan!");
    return;
  }

  window.open(
    APP_URL + "admin/permintaan/cetak_bast/" + currentKodeUnik,
    "_blank"
  );
}

/* =====================================
   DETAIL MODAL (PERMINTAAN)
===================================== */
function showDetail(kode_unik) {

  fetch(APP_URL + "admin/permintaan/get_detail/" + kode_unik)
    .then(response => response.json())
    .then(data => {

      let html = "";

      if (data.length > 0) {
        data.forEach(item => {
          html += `
            <tr>
                <td>${item.kode_barang ?? '-'}</td>
                <td>${item.no_register ?? '-'}</td>
                <td>${item.nama_barang ?? '-'}</td>
                <td class="text-center">${item.jumlah ?? '-'}</td>
                <td>
                    <select class="form-select form-select-sm kondisi-select" data-id="${item.id}">
                        <option value="B" ${item.kondisi=='B'?'selected':''}>B</option>
                        <option value="KB" ${item.kondisi=='KB'?'selected':''}>KB</option>
                        <option value="RB" ${item.kondisi=='RB'?'selected':''}>RB</option>
                    </select>
                 </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger btn-hapus-detail" data-id="${item.id}">
                    Hapus
                    </button>
                </td>
            </tr>
          `;
        });
      } else {
        html = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
      }

      document.getElementById("detailBody").innerHTML = html;
      new bootstrap.Modal(document.getElementById('detailModal')).show();

    })
    .catch(() => alert("Gagal mengambil data"));
}

/* =====================================
   UPDATE KONDISI
===================================== */
$(document).on('change', '.kondisi-select', function() {

  $.post(APP_URL + "admin/permintaan/update_kondisi", {
    id: $(this).data('id'),
    kondisi: $(this).val()
  });

});

/* =====================================
   HAPUS DETAIL (PERMINTAAN)
===================================== */
$(document).on('click', '.btn-hapus-detail', function(){
  deleteDetailId = $(this).data('id');
  $('#modalDeleteDetail').modal('show');
});

$('#confirmDeleteDetail').on('click', function(){

  if(deleteDetailId){
    $.post(APP_URL + 'admin/permintaan/hapus_detail', {
      id: deleteDetailId
    }, function(){
      location.reload();
    });
  }

});


/* =====================================
   HAPUS SEMUA (TABEL LUAR)
===================================== */
$(document).on('click', '.btn-hapus-semua', function(){
  deleteKodeUnik = $(this).data('kode');
  $('#modalDeleteSemua').modal('show');
});

$('#confirmDeleteSemua').on('click', function(){

  if(deleteKodeUnik){
    $.post(APP_URL + 'admin/permintaan/hapus_semua', {
      kode_unik: deleteKodeUnik
    }, function(){
      location.reload();
    });
  }

});