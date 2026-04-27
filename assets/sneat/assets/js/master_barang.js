/* =====================================
   PILIH LOKASI
===================================== */
$(function () {

  $('#modalTambah').on('shown.bs.modal', function () {

    let select = $(this).find('.select2');

    if (select.hasClass('select2-hidden-accessible')) {
      select.select2('destroy');
    }

    select.select2({
      width: '100%',
      dropdownParent: $('#modalTambah')
    });

  });

});

/* =====================================
   SEARCH
===================================== */
$(document).ready(function () {

  const input = $("#searchInput");

  if (!input.length) return;

  input.on("keyup", function () {
    let value = $(this).val().toLowerCase();

    $("#tableBarang tr").each(function () {
      let text = $(this).text().toLowerCase();
      $(this).toggle(text.includes(value));
    });
  });

});

/* =====================================
   EDIT DALAM MODAL
===================================== */
$(document).on('click', '.btn-edit', function() {

  let id = $(this).data('id');

  $.get(APP_URL + 'admin/master_barang/get_barang/' + id, function(response) {

    let barang = JSON.parse(response);

    // isi hidden id
    $('#edit_id').val(barang.id);

    // isi semua input berdasarkan name
    $('#modalEdit').find('input, select, textarea').each(function() {

      let name = $(this).attr('name');

      if (barang[name] !== undefined) {
        $(this).val(barang[name]);
      }

    });

    $('#modalEdit').modal('show');

  });

});

/* =====================================
   UPDATE
===================================== */
$(document).ready(function () {

  $('#formEdit').on('submit', function(e) {
    e.preventDefault();

    $.post(APP_URL + 'admin/master_barang/update',
           $(this).serialize(),
           function() {
              location.reload();
           });
  });

});

/* =====================================
   DELETE
===================================== */
let deleteId = null;

$(document).on('click', '.btn-hapus', function() {
  deleteId = $(this).data('id');
  $('#modalDelete').modal('show');
});

$('#confirmDelete').on('click', function() {

  if(deleteId) {
    $.get(APP_URL + 'admin/master_barang/delete/' + deleteId, function() {
      location.reload();
    });
  }

});

$(document).on("click", ".pagination a", function () {
  $("#searchInput").val(""); // reset search biar normal lagi
});