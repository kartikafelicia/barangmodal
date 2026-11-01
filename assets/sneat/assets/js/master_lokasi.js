console.log("APP_URL:", APP_URL);
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
  let lokasi = $(this).data('lokasi');

  $('#edit_id').val(id);
  $('#edit_lokasi').val(lokasi);

  $('#modalEdit').modal('show');
});

/* =====================================
   UPDATE
===================================== */
$(document).on('submit', '#formEditLokasi', function(e){
  e.preventDefault();

  $.post(APP_URL + 'admin/master_lokasi/update',
    $(this).serialize(),
    function(res){
      console.log("RES:", res); // debug
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
    $.get(APP_URL + 'admin/master_lokasi/delete/' + deleteIdLokasi,
      function(){
        location.reload();
      }
    );
  }

});