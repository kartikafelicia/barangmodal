/* =====================================
   GLOBAL MASTER OPTION (UNTUK FILTER)
===================================== */
let MASTER_OPTIONS = null;
let deleteKodeUnik = null;
let deleteDetailId = null;


/* =====================================
   INIT SELECT2 PER MODAL
===================================== */
function initSelect2(modalId) {
  $(modalId).find('.kategori, .kode_barang').select2({
    dropdownParent: $(modalId),
    width: '100%'
  });
}


/* =====================================
   DOCUMENT READY
===================================== */
$(document).ready(function() {

  // Simpan semua option asli SEKALI SAJA
  MASTER_OPTIONS = $('#modalPengadaan .kode_barang:first').html();

  // Init select2 untuk semua modal
  initSelect2('#modalPengadaan');
  initSelect2('#modalHibah');
  initSelect2('#modalInstansi');

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

  // reset isi dropdown barang
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

  // refresh select2
  kodeBarang.trigger('change.select2');

});


/* =====================================
   TAMBAH BARANG
===================================== */
$(document).on('click', '.tambah-barang', function() {

  let modal = $(this).closest('.modal');
  let wrapper = modal.find('.barang-wrapper');
  let item = wrapper.find('.barang-item:first').clone();

  // Hapus select2 lama dari clone
  item.find('.select2').remove();
  item.find('select').removeClass('select2-hidden-accessible');

  // Reset value
  item.find('input').val('');
  item.find('select').val('');

  wrapper.append(item);

  // Init select2 ulang HANYA di item baru
  item.find('.kategori, .kode_barang').select2({
    dropdownParent: modal,
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
   DETAIL MODAL
===================================== */
function showDetail(kode_unik) {

  fetch(APP_URL + "admin/penerimaan/get_detail/" + kode_unik)
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

  $.post(APP_URL + "admin/penerimaan/update_kondisi", {
    id: $(this).data('id'),
    kondisi: $(this).val()
  });

});


/* =====================================
   HAPUS DETAIL
===================================== */
$(document).on('click', '.btn-hapus-detail', function(){
  deleteDetailId = $(this).data('id');
  $('#modalDeleteDetail').modal('show');
});

$('#confirmDeleteDetail').on('click', function(){

  if(deleteDetailId){
    $.post(APP_URL + 'admin/penerimaan/hapus_detail', {
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
    $.post(APP_URL + 'admin/penerimaan/hapus_semua', {
      kode_unik: deleteKodeUnik
    }, function(){
      location.reload();
    });
  }

});


/* =====================================
   FIX SCROLL MODAL + SELECT2
===================================== */
$(document).on('hidden.bs.modal', function () {
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
});