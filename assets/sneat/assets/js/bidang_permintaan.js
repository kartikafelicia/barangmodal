/* =====================================
   GLOBAL MASTER OPTION (UNTUK FILTER)
===================================== */
let MASTER_OPTIONS = null;


/* =====================================
   INIT SELECT2 (HALAMAN BIASA, BUKAN MODAL)
===================================== */
function initSelect2() {
  $('.kategori, .kode_barang').select2({
    width: '100%'
  });
}


/* =====================================
   DOCUMENT READY
===================================== */
$(document).ready(function() {

  // Simpan semua option asli SEKALI SAJA
  MASTER_OPTIONS = $('.kode_barang:first').html();

  // Init select2
  initSelect2();

});


/* =====================================
   FILTER BARANG BERDASARKAN KATEGORI
===================================== */
$(document).on('change', '.kategori', function () {

  let selected = ($(this).val() || '')
                  .toString()
                  .trim()
                  .toLowerCase();

  let parent = $(this).closest('.barang-item');
  let kodeBarang = parent.find('.kode_barang');

  kodeBarang.empty();
  kodeBarang.append('<option value="">-- Pilih Barang --</option>');

  let allOptions = $(MASTER_OPTIONS);

  allOptions.each(function () {

    let kategoriOption = ($(this).data('kategori') || '')
                          .toString()
                          .trim()
                          .toLowerCase();

    if (kategoriOption === selected) {
      kodeBarang.append($(this).clone());
    }

  });

  kodeBarang.trigger('change');

});


/* =====================================
   TAMBAH BARANG
===================================== */
$(document).on('click', '.tambah-barang', function() {

  let wrapper = $('.barang-wrapper');
  let item = wrapper.find('.barang-item:first').clone();

  // Destroy select2 di clone
  item.find('.select2').remove();
  item.find('select').removeClass('select2-hidden-accessible');

  // Reset value
  item.find('input').val('');
  item.find('select').val('');

  wrapper.append(item);

  // Init ulang select2 hanya di item baru
  item.find('.kategori, .kode_barang').select2({
    width: '100%'
  });

});


/* =====================================
   HAPUS BARANG FORM
===================================== */
$(document).on('click', '.hapus-barang', function() {

  let item = $(this).closest('.barang-item');
  let wrapper = item.closest('.barang-wrapper');

  if (wrapper.find('.barang-item').length > 1) {

    item.find('.kategori, .kode_barang').select2('destroy');
    item.remove();

  } else {
    alert("Minimal satu barang harus ada.");
  }

});


/* =====================================
   DETAIL MODAL (PERMINTAAN)
===================================== */
function showDetail(kode_unik) {

  fetch(APP_URL + "bidang/permintaan/get_detail/" + kode_unik)
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

  $.post(APP_URL + "permintaan/update_kondisi", {
    id: $(this).data('id'),
    kondisi: $(this).val()
  });

});

/* =====================================
   HAPUS DETAIL (PERMINTAAN)
===================================== */
$(document).on('click', '.btn-hapus-detail', function() {

  let id = $(this).data('id');

  if(confirm("Yakin ingin menghapus data ini?")) {

    $.post(APP_URL + "permintaan/hapus_detail", { id: id }, function() {
      location.reload();
    });

  }

});


/* =====================================
   HAPUS SEMUA (TABEL LUAR)
===================================== */
$(document).on('click', '.btn-hapus-semua', function() {

  let kode = $(this).data('kode');

  if(confirm("Yakin mau hapus semua data ini?")) {

    $.post(APP_URL + "permintaan/hapus_semua", { kode_unik: kode }, function() {
      location.reload();
    });

  }

  

});