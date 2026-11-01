console.log("APP_URL:", APP_URL);
let deleteIdKategori = null;

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
  let kategori = $(this).data('kategori');

  $('#edit_id').val(id);
  $('#edit_kategori').val(kategori);

  $('#modalEdit').modal('show');
});

/* =====================================
   UPDATE
===================================== */
$(document).on('submit', '#formEditKategori', function(e){
  e.preventDefault();

  $.post(APP_URL + 'admin/master_kategori/update',
    $(this).serialize(),
    function(res){
      console.log("RES:", res); // 🔥 debug
      location.reload();
    }
  );
});

/* =====================================
   DELETED
===================================== */
$(document).on('click', '.btn-hapus', function(){
  deleteIdKategori = $(this).data('id');
  $('#modalDelete').modal('show');
});

/* CONFIRM DELETE */
$('#confirmDeleteKategori').on('click', function(){

  if(deleteIdKategori){
    $.get(APP_URL + 'admin/master_kategori/delete/' + deleteIdKategori,
      function(){
        location.reload();
      }
    );
  }

});