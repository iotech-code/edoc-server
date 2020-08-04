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
  // console.log('====================================');
  // console.log(val);
  // console.log('====================================');
  $("#file"+val).remove();
});

$('.date-select').datepicker({
  language: 'th',
  format: 'yyyy-mm-dd',
  // startDate: 'd'
  default: true
});

axios = require('axios');

$.fn.search = function(setting) {
  
  $input = $(this).find('.input-group').find('input');
  $results = $(this).find('.results');

  // console.log($input);
  let url = setting.url ;

  $(document).click(function(e){
    
    if ($(e.target)[0] !== $input[0]) {
      
      $results.removeClass("active")
    }
  });

  $input.on("paste keyup focus", function(e){
    console.log($(this))
    val = $(this).val();
    // console.log(val);
    let query = $(this).val(); ;

    axios.get(url+`?query=${query}`)
    .then(function(response){
      data = response.data.data ;
      // console.log(data.length);
      
      $results.empty();
      $results.addClass("active")
      if (data.length > 0) {
        data.forEach(ele => {
          // console.log(ele);
          $child = $(`<div class="result" data-doc-id="${ele.id}"> ${ele.title} </div>`)
          $results.append($child);

          $child.click(function(e){ 
            $child = $(`<div class="col-12 mb-1">`) ;

            $link = $(`<a href="#">${ele.title}</a>`);
            $deleteBtn = $(`
            <button type="button" class="btn btn-danger btn-sm rounded-circle float-right" >
              <i class="fa fa-times"></i>
            </button>`)
            $value = $(`<input type="hidden" name="refers[]" value="${ele.id}" >`);
            $child.append($link);
            $child.append($value);
            $child.append($deleteBtn);            
            // $a = $(`<a class="rm-tag" href="#" data-refer="${ele.id}" > <i class="fa fa-times"> </i></a>`) ;
            // $tag = $(`<span class="badge badge-info mr-1" >${ele.title}</span>`) ;
            // $value = $(`<input type="hidden" name="refers[]" value="${ele.id}" >`)
            $('input[name="title"]').val(ele.title);
            setting.callback(ele.title);
            $("#referItem").append($child);

            // $tag.append($a);
            // $tag.append($value);
            $deleteBtn.click(function(e){
              e.preventDefault();
              $(this).parent().remove();
            });
            // $("#taged").append($tag);
          });

        });
      } else {
        child = $(`<div class="result" > ไม่พบข้อมูล </div>`)
        $results.append(child);
      }
    })
    .catch(function(error){
      console.error(error);
    })
  })
}
