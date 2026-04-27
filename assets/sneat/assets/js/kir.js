let templateBarang = null;
let currentLokasiId = null;
let currentLokasiNama = null;

document.addEventListener("DOMContentLoaded", function() {
    templateBarang = document.querySelector(".barang-item").outerHTML;
});

/* =====================================
   MODAL dATA PERMINTAAN
===================================== */

let currentKodeUnik = null;
let permintaanSudahDibuka = false;

window.openPermintaan = function(id_lokasi, nama_lokasi, dataBaru = []) {

  currentLokasiId = id_lokasi;
  currentLokasiNama = nama_lokasi;
    console.log("FETCH KE CONTROLLER:", id_lokasi);


  permintaanSudahDibuka = true;
  document.getElementById("modalLokasi").value = nama_lokasi;

  fetch(APP_URL + "admin/kir/get_barang_by_lokasi/" + id_lokasi)
    .then(res => res.json())
    .then(data => {

  let html = "";
  let no = 1;

  if (data.length > 0) {
    data.forEach(item => {
      html += `
        <tr>
          <td class="text-center">
            <input type="checkbox" class="form-check-input pilih-item" checked>
          </td>
          <td class="text-center">${no++}</td>
          <td>${item.kode_barang}</td>
          <td>${item.nama_barang}</td>
          <td class="text-center">${item.jumlah}</td>
        </tr>
      `;
    });
  } else {
    html = `<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>`;
  }

  document.getElementById("permintaanBody").innerHTML = html;
  document.getElementById("permintaanBaru").innerHTML = "";

  new bootstrap.Modal(document.getElementById('permintaanModal')).show();
})

    .catch(() => {
      alert("Gagal load data");
    });
}

/* =====================================
   MODAL FORM
===================================== */
window.bukaForm = function(id, nama_lokasi) {

    document.getElementById("form_id").value = id;
    document.getElementById("form_id_lokasi").value = id;
    document.getElementById("form_nama_lokasi").value = nama_lokasi;

    document.querySelectorAll("#modalForm input").forEach(i => i.value = "");
    document.querySelectorAll("#modalForm select").forEach(s => s.selectedIndex = 0);

    let modal = new bootstrap.Modal(document.getElementById('modalForm'));
    modal.show();
};




document.addEventListener("change", function(e) {
    if (e.target.classList.contains("pilih-barang")) {

        let selected = e.target.selectedOptions[0];
        console.log("DATA SELECTED:", selected); // 🔥 tambahan
        console.log("DATASET:", selected.dataset); 
        
        let parent = e.target.closest(".barang-item");

        parent.querySelector(".merk").value = selected.dataset.merkType || '';
        parent.querySelector(".tahun").value = selected.dataset.tahun || '';

    }
});

document.addEventListener("click", function(e){
    if (e.target.classList.contains("tambah-barang")) {

        let wrapper = document.querySelector(".barang-wrapper");
        let temp = document.createElement("div");
        temp.innerHTML = templateBarang;
        let item = temp.firstElementChild;

        item.querySelectorAll("input").forEach(i => i.value = "");
        item.querySelector("select").selectedIndex = 0;

        wrapper.appendChild(item);
    }
});

document.addEventListener("click", function(e){
    if (e.target.classList.contains("hapus-barang")) {

        let items = document.querySelectorAll(".barang-item");

        if (items.length > 1) {
            e.target.closest(".barang-item").remove();
        }
    }
});

function generateOption(selectedKode) {
    let html = '';

    let temp = document.createElement("div");
    temp.innerHTML = templateBarang;

    temp.querySelectorAll(".pilih-barang option").forEach(opt => {
      
        let selected = opt.value == selectedKode ? 'selected' : '';
        html += `<option value="${opt.value}"
                    data-nama="${opt.dataset.nama}"
                    data-merk-type="${opt.dataset.merkType}" 
                    data-tahun="${opt.dataset.tahun}"
                    ${selected}>
                    ${opt.text}
                </option>`;
    });

    return html;
}


document.getElementById("formKIR").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);
        console.log([...formData.entries()]);

        let valid = true;
document.querySelectorAll(".barang-item").forEach(item => {
  let kode = item.querySelector(".pilih-barang").value;
  if (!kode) valid = false;
});

if (!valid) {
  alert("Masih ada barang kosong!");
  return;
}
    if (!formData.getAll("kode_barang[]").length) {
        alert("Pilih barang dulu!");
        return;
    }

    let dataBaru = {};

    document.querySelectorAll(".barang-item").forEach(item => {
    let selected = item.querySelector(".pilih-barang option:checked");
    let nama = selected?.dataset.nama || '';
    let kode = selected?.value || '';
    let jumlah = parseInt(item.querySelector("input[name='jumlah[]']")?.value || 0);

    if (!kode) return;

    // 🔥 kalau sudah ada → tambah jumlah
    if (dataBaru[kode]) {
      dataBaru[kode].jumlah += jumlah;
      // dataBaru[kode].jumlah = jumlah;
    } else {
      dataBaru[kode] = {
        nama,
        kode,
        jumlah
      };
    }
  });

// ubah object jadi array
dataBaru = Object.values(dataBaru);

fetch(APP_URL + "admin/kir/simpan", {
    method: "POST",
    body: formData
})
.then(res => res.json())
.then(res => {
    // tutup modal form
    bootstrap.Modal.getInstance(document.getElementById('modalForm')).hide();

    // 🔥 reload modal permintaan dari controller
    openPermintaan(currentLokasiId, currentLokasiNama);
  })
  .catch(() => {
      alert("Gagal simpan");
  }); 

})
