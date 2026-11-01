let templateBarang = null;
let currentLokasiId = null;
let currentLokasiNama = null;

document.addEventListener("DOMContentLoaded", function () {
    templateBarang = document.querySelector(".barang-item").outerHTML;
});

/* =====================================
   MODAL DATA PERMINTAAN
===================================== */

window.openPermintaan = function (id_lokasi, nama_lokasi) {
    currentLokasiId = id_lokasi;
    currentLokasiNama = nama_lokasi;

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
                            <td class="text-center" style="min-width:80px;">
    <button class="btn btn-sm btn-danger hapus-item">Hapus</button>
</td>

                            </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>`;
            }

            document.getElementById("permintaanBody").innerHTML = html;
            document.getElementById("permintaanBaru").innerHTML = "";

            new bootstrap.Modal(document.getElementById("permintaanModal")).show();
        })
        .catch(() => {
            alert("Gagal load data");
        });
};

/* =====================================
   MODAL FORM
===================================== */

window.bukaForm = function (id, nama_lokasi) {
    document.getElementById("form_id").value        = id;
    document.getElementById("form_id_lokasi").value = id;      // ini yang dikirim ke controller
    document.getElementById("form_nama_lokasi").value = nama_lokasi;

    // reset isi form
    document.querySelectorAll("#modalForm input:not([type=hidden])").forEach(i => i.value = "");
    document.querySelectorAll("#modalForm select").forEach(s => s.selectedIndex = 0);

    new bootstrap.Modal(document.getElementById("modalForm")).show();
};

/* =====================================
   AUTO-FILL MERK & TAHUN SAAT PILIH BARANG
===================================== */

document.addEventListener("change", function (e) {
    if (e.target.classList.contains("pilih-barang")) {
        let selected = e.target.selectedOptions[0];
        let parent = e.target.closest(".barang-item");

        parent.querySelector(".merk").value = selected.dataset.merkType || "";
        parent.querySelector(".tahun").value = selected.dataset.tahun || "";
    }
});

/* =====================================
   TAMBAH BARIS BARANG
===================================== */

document.addEventListener("click", function (e) {
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

/* =====================================
   HAPUS BARIS BARANG
===================================== */

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("hapus-barang")) {
        let items = document.querySelectorAll(".barang-item");
        if (items.length > 1) {
            e.target.closest(".barang-item").remove();
        }
    }
});

/* =====================================
   SIMPAN FORM KIR
===================================== */

document.getElementById("formKIR").addEventListener("submit", function (e) {
    e.preventDefault();

    let valid = true;
    document.querySelectorAll(".barang-item").forEach(item => {
        if (!item.querySelector(".pilih-barang").value) valid = false;
    });

    if (!valid) {
        alert("Masih ada barang yang belum dipilih!");
        return;
    }

    let formData = new FormData(this);
console.log("id_lokasi:", formData.get("id_lokasi"));
console.log("kode_barang:", formData.getAll("kode_barang[]"));
    fetch(APP_URL + "admin/kir/simpan", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(res => {
            if (res.status !== "success") {
                alert("Gagal simpan: " + (res.msg || ""));
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById("modalForm")).hide();

            // Data sudah dimerge di controller, cukup reload modal permintaan
            openPermintaan(currentLokasiId, currentLokasiNama);
        })
        .catch(() => {
            alert("Gagal simpan");
        });
});

/* =====================================
   SIMPAN MODAL PERMINTAAN
===================================== */
// ambil token dari cookie CI
function getCsrfToken() {
    let name = "csrf_cookie_name="; // ganti sesuai $config['csrf_cookie_name']
    let cookies = document.cookie.split(';');
    for (let c of cookies) {
        c = c.trim();
        if (c.startsWith(name)) return c.substring(name.length);
    }
    return "";
}

document.querySelector("#permintaanModal .btn-primary").addEventListener("click", function () {
    let items = [];

    document.querySelectorAll("#permintaanBody tr").forEach(row => {
        let checkbox = row.querySelector(".pilih-item");
        
        // Skip kalau tidak ada checkbox atau tidak dicentang
        if (!checkbox || !checkbox.checked) return;

        // Ambil semua td dalam row ini
        let cells = row.querySelectorAll("td");
        
        // cells[0]=checkbox, [1]=no, [2]=kode, [3]=nama, [4]=jumlah
        items.push({
            kode_barang: cells[2].innerText.trim(),
            nama_barang: cells[3].innerText.trim(),
            jumlah:      parseInt(cells[4].innerText.trim()) || 0
        });
    });

    console.log("Items yang akan dikirim:", items); // debug

    if (items.length === 0) {
        alert("Pilih minimal satu barang!");
        return;
    }

    fetch(APP_URL + "admin/kir/simpan_permintaan", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            id_lokasi:   currentLokasiId,
            nama_lokasi: currentLokasiNama,
            items:       items
        })
    })

    .then(res => res.text())
    .then(text => {
      console.log("RAW RESPONSE:", text);
      let res = JSON.parse(text);

      if (res.status !== "success") {
          alert("Gagal: " + (res.msg || ""));
          return;
      }

        bootstrap.Modal.getInstance(document.getElementById("permintaanModal")).hide();
        window.open(APP_URL + "admin/kir/export_kir/" + res.id_permintaan, "_blank");
    })
  .catch(() => alert("Gagal simpan permintaan"));
});

/* =====================================
   EXPORT KIR
===================================== */
function lihatDokumenTerakhir(id_lokasi, nama_lokasi) {
    // ambil id permintaan terakhir untuk lokasi ini
    fetch(APP_URL + "admin/kir/get_permintaan_terakhir/" + id_lokasi)
        .then(res => res.json())
        .then(data => {
            if (!data.id_permintaan) {
                alert("Belum ada permintaan untuk lokasi ini");
                return;
            }
            window.open(APP_URL + "admin/kir/export_kir/" + data.id_permintaan, "_blank");
        });
}

/* =====================================
   HAPUS
===================================== */
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("hapus-item")) {
        let row = e.target.closest("tr");
        let kode = row.children[2].innerText;

        fetch(APP_URL + "admin/kir/hapus_kir_item", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id_lokasi=" + currentLokasiId + "&kode_barang=" + kode
        })
        .then(res => res.json())
        .then(res => {
            if (res.status === "success") {
                row.remove();
            }
        });
    }
});