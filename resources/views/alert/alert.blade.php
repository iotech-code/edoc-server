@if(empty($isAlert) || (!empty($isScript)))

<script>
function showToast() { 
@if(session()->has('success'))
swal("สำเร็จ", "{{ __(session()->get('success')) }}", "success");

// toastr["success"]("{{ __(session()->get('success')) }}", "Success");
@endif
@if(session()->has('error'))
  // toastr["error"]("{{ __(session()->get('error')) }}", "Error");
swal("มีบางอย่างผิดพลาด", "{{ __(session()->get('error')) }}", "error");

@endif
@if(session()->has('warning'))
  // toastr["warning"]("{{ __(session()->get('warning')) }}", "Warning");
swal("แจ้งเตือน", "{{ __(session()->get('error')) }}", "warning");

@endif
}
window.setTimeout(showToast, 1000);
window.lang = {
  'alert': {
    none_selected: "{{ __('alert.none_selected') }}",
  }
}
</script>
@else
@if(session()->has('success'))
<div class="alert alert-success">{{ __(session()->get('success')) }}</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning">{{ __(session()->get('warning')) }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ __(session()->get('error')) }}</div>
@endif
@if(!empty($errors) && $errors->count())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
@endif