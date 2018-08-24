var member = 1;

$('#addFile').click(function(){
  member++

  let html = ` 
    <div class="row mb-3" id="file${member}">
      <div class="col">
        <input type="file" name="files[]"> 
        <button type="button" class="btn btn-danger btn-sm rounded-circle btn-remove-file" data-file="${member}">
          <i class="fa fa-times"></i>
        </button>
      </div>
    </div>
    `;
  $('#fileGroup').append(html);
});
$(document).on('click','.btn-remove-file',function(){ 
  // console.log("tete");
  val = $(this).data('file');
  console.log('====================================');
  console.log(val);
  console.log('====================================');
  $("#file"+val).remove();
});

