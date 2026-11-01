/* =====================================
   RELOAD PAGINATION
===================================== */
// document.getElementById("limitSelect").addEventListener("change", function() {
//     let val = this.value;
//     let url = new URL(window.location.href);

//     url.searchParams.set("limit", val);
//     window.location.href = url.toString();
// });


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
$('#formEdit').on('submit', function(e) {
  e.preventDefault();

  $.ajax({
    url: APP_URL + 'admin/master_barang/update',
    type: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(res) {
      if(res.status === 'success'){
        location.reload();
      } else {
        alert('Update gagal');
      }
    },
    error: function(xhr){
      console.log(xhr.responseText);
      alert('Server error');
    }
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
    $.ajax({
      url: APP_URL + 'admin/master_barang/delete/' + deleteId,
      type: 'GET',
      dataType: 'json',
      success: function(res){
        if(res.status === 'deleted'){
          location.reload();
        } else {
          alert('Gagal hapus');
        }
      },
      error: function(xhr){
        console.log(xhr.responseText);
        alert('Server error');
      }
    });
  }

});

$(document).on("click", ".pagination a", function () {
  $("#searchInput").val(""); // reset search biar normal lagi
});