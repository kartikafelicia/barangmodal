console.log("MODAL SHOW");

/* =====================================
   SEARCH
===================================== */
$(document).ready(function () {

  $("#searchInput").on("keypress", function (e) {
  if (e.which === 13) { // 13 = ENTER
    e.preventDefault();

    let value = $(this).val();

    let url = new URL(window.location.href);
    url.searchParams.set("search", value);

    window.location.href = url.toString();
  }
});

});

/* =====================================
   PAGINATION
===================================== */
// document.getElementById("limitSelect").addEventListener("change", function() {  
//     let val = this.value;  
//     let url = new URL(window.location.href);  
    
//     if (val === "all") {  
//         url.searchParams.set("limit", "all");  
//     } else {  
//         url.searchParams.set("limit", val);  
//     }  

//     window.location.href = url.toString();  
// });


/* =====================================
   EDIT DALAM MODAL
===================================== */
$(document).on('click', '.btn-edit', function() {

  let id = $(this).data('id');
  let lokasi = $(this).data('lokasi');
  let ruangan = $(this).data('ruangan');
  let nomor = $(this).data('nomor');

  $('#edit_id').val(id);
  $('#edit_lokasi').val(lokasi);
  $('#edit_ruangan').val(ruangan);
  $('#edit_nomor_ruangan').val(nomor);

  // Tutup semua modal yang mungkin masih aktif dulu
  $('.modal').modal('hide');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();

  // Buka modal edit setelah delay kecil
  setTimeout(function() {
    $('#modalEdit').modal('show');
  }, 300);
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
  console.log("DELETE ID:", deleteId);
  
  // Pastikan bersih dulu
  $('.modal').modal('hide');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
  
  setTimeout(function() {
    $('#modalDelete').modal('show');
  }, 300);
});

$(document).on('click', '#confirmDelete', function() {
  if (deleteId) {
    $.get(APP_URL + 'admin/master_posisi_barang/delete/' + deleteId, function(res) {
      console.log(res);
      $('#modalDelete').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      location.reload();
    });
  }
});