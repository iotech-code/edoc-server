
$.fn.nameSearch = function(setting) {
  
    $input = $(this).find('.input-group-name').find('input');
    $results = $(this).find('.results');
  
    // console.log($input);
    let url = setting.url ;
  
    $(document).click(function(e){
      
      if ($(e.target)[0] !== $input[0]) {
        
        $results.removeClass("active")
      }
    });
  
    $input.on("paste keyup focus", function(e){
      val = $(this).val();
      console.log(val);
      let query = $(this).val(); ;
  
      axios.get(url+`?search=${query}`)
      .then(function(response){
        data = response.data.data ;
        console.log(data.length);
        
        $results.empty();
        $results.addClass("active")
        if (data.length > 0) {
          data.forEach(ele => {
            // console.log(ele);
            $child = $(`<div class="result" data-doc-id="${ele.id}"> ${ele.full_name} </div>`)
            $results.append($child);
            $child.click(function(e){ 
              // $child = $(`<div class="col-12 mb-1">`) ;
              $link = $(`<a href="">${ele.full_name}</a>`);
              // $deleteBtn = $(`
              // <button type="button" class="btn btn-danger btn-sm rounded-circle float-right" >
              //   <i class="fa fa-times"></i>
              // </button>`)
              // $child.append($link);
              // $child.append($value);
              // $child.append($deleteBtn);            
              $deleteBtn = $(`<a class="rm-tag" href="#" data-refer="${ele.id}" > <i class="fa fa-times"> </i></a>`) ;
              $value = $(`<input type="hidden" name="users[]" value="${ele.id}" >`);
              $tag = $(`<span class="badge badge-info mr-1" > ${ele.full_name}</span>`) ;
              
              $('input[name="title"]').val(ele.full_name);
              // $("#referItem").append($child);
              $tag.append($deleteBtn);
              $tag.append($value);
              $deleteBtn.click(function(e){
                e.preventDefault();
                $(this).parent().remove();
              });
              $("#tagged").append($tag);
            });
  
          });
        } else {
          child = $(`<div class="result" > ไม่พบข้อมูล </div>`)
          $results.append(child);
        }
      })
      .catch(function(error){
        console.log(error);
      })
    })
  }