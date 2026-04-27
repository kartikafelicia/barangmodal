let deleteIdLokasi = null;

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
   EDIT
===================================== */
$(document).on('click', '.btn-edit', function() {

  let id = $(this).data('id');
  let nomor = $(this).data('nomor');
  let lokasi = $(this).data('lokasi');

  $('#edit_id').val(id);
  $('#edit_nomor').val(nomor);
  $('#edit_lokasi').val(lokasi);

  $('#modalEdit').modal('show');
});

/* =====================================
   UPDATE
===================================== */
$('#formEditLokasi').on('submit', function(e){
  e.preventDefault();

  $.post(APP_URL + 'master_lokasi/update',
    $(this).serialize(),
    function(){
      location.reload();
    }
  );
});

/* =====================================
   DELETED
===================================== */
$(document).on('click', '.btn-hapus', function(){
  deleteIdLokasi = $(this).data('id');
  $('#modalDelete').modal('show');
});

/* CONFIRM DELETE */
$('#confirmDeleteLokasi').on('click', function(){

  if(deleteIdLokasi){
    $.get(APP_URL + 'master_lokasi/delete/' + deleteIdLokasi,
      function(){
        location.reload();
      }
    );
  }

});