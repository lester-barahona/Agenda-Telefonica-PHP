$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
 

$(document).ready((e)=>{
    $("#add-phone").click((e)=>{
      $('#container-phones').append(`<div class="form-row">
      <div class="col-10">
          <input type="number" name="phones[]" class="form-control mb-3" value="" required>
      </div>
      <div class="col-2">
      <button type="button" class="btn btn-danger btn-delete-phone"><i class="fas fa-trash-alt"></i></button>  
      </div>
   </div>`);  
    });

    $("#add-email").click((e)=>{
      $('#container-emails').append(` <div class="form-row">
      <div class="col-10">
      <input type="email" class="form-control mb-3" name="emails[]" value="" required>
      </div>
      <div class="col-2">
      <button type="button" class="btn btn-danger btn-delete-email"><i class="fas fa-trash-alt"></i></button>
      </div>
   </div>`);
    });
});


$(document).on('click', '.btn-delete-phone', function(e){
$(this).parent().parent().remove();
});

$(document).on('click', '.btn-delete-email', function(e){
$(this).parent().parent().remove();
});


