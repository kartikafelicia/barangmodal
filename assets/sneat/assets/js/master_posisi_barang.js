/* =====================================
   SEARCH
===================================== */
$(document).ready(function () {

  $("#searchInput").on("keyup", function () {
    let value = $(this).val().toLowerCase();

    $("table tbody tr").filter(function () {
      $(this).toggle(
        $(this).text().toLowerCase().indexOf(value) > -1
      );
    });
  });

});


/* =====================================
   EDIT DALAM MODAL
===================================== */
$(document).on('click', '.btn-edit', function() {

  let id = $(this).data('id');

  $.get(APP_URL + 'admin/master_posisi_barang/get_posisi/' + id, function(response) {

    let data = JSON.parse(response);

    $('#edit_id').val(data.id);
    $('#edit_lokasi').val(data.lokasi);
    $('#edit_ruangan').val(data.ruangan);
    $('#edit_nomor_ruangan').val(data.nomor_ruangan);

    $('#modalEdit').modal('show');

  });

});


/* =====================================
   UPDATE
===================================== */
$(document).on('submit', '#formEdit', function(e) {
  e.preventDefault();

  $.post(APP_URL + 'admin/master_posisi_barang/update',
    $(this).serialize(),
    function(res) {
      console.log(res); // 🔥 DEBUG
      location.reload();
    }
  );
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
    $.get(APP_URL + 'admin/master_posisi_barang/delete/' + deleteId, function() {
      location.reload();
    });
  }

});