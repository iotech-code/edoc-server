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

$('.date-select').datepicker({
  language: 'th'
});

axios = require("axios");

$.fn.tet = function() {
  // this.css( "color", "green" );
  $(this).click(function(){
    alert();
  });
};
$.fn.addtag = function(text) {
  a = `<a class="rm-tag" href="#" data-refer-id="${text}"> <i class="fa fa-times"> </i></a>`;
  html = `
    <span class="badge badge-info" id="refer${text}"> 
      ${text}
      ${a}
    </span>
  `;
  $(this).append(html);
}
// axios("get");
// function addRefer(ele, text) {
//   html = `
//   <span class="badge badge-info"> ${text} </span>
//   `;
//   $(ele).append(html);
// }
// require('semantic-ui-search');