@extends('layouts.app')

@section('nav-top')
	@include('layouts.nav-top', ['active'=>2])
@endsection

@section('content')
<div class="container">
	  {{-- <div class="alert alert-danger alert-dismissible" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Danger!</strong> You should <a href="#" class="alert-link">read this message</a>.
			<ul>
			
				<li> list </li>
			</ul>
	
		</div> --}}

	{{-- <form class="" action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
		@method("PUT") --}}
  	<div class="row">
			<div class="col-md-8 offset-md-2 mb-2">

				<div class="card border-top-primary ">
					{{-- <div class="card-header">
							เอกสารจาก: {{ $document->from }}
					</div> --}}
					<div class="card-body">
						<div class="row">
							<div class="col-8">
								<h5>เอกสารจาก: {{ $document->from }}</h5>
							</div>
							<div class="col-4 text-right">
								<a href="">
									<i class="fa fa-reply"></i>
									ตอบกลับ
								</a>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<label for="">ประเภทของเอกสาร: </label>
								<input type="text" class="form-control" value="{{ $document->type->name }}" disabled>
							</div>
							<div class="form-group col-6">
								<label for="">การตอบลับ: </label>
								<input type="text" class="form-control" value="{{ $document->replyType->name }}" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="">ความคิดเห็นเพิ่มเติม: </label>
						<textarea class="form-control" cols="30" rows="5" disabled>{{ $document->remark }}</textarea>
						</div>
						<div class="form-group">
								<span class="font-weight-bold">
										เอกสารอ้างอิง:
								</span>								

								<ul class="list-group">
										@foreach ($document->references as $item)
										<li class="list-group-item"> <a href="#">{{$item->title}}</a> </li>
										@endforeach
								</ul>
							</div>
						<div class="form-group">
							<span class="font-weight-bold">
								ไฟล์แนบ:
							</span>
							<ul class="list-group">
							@foreach ($document->attachments as $item)
							<li class="list-group-item"> <a href="{{ $item->link}}">{{$item->name}}</a> </li>
							@endforeach
							</ul>

						</div>

						<div class="from-group">
								<div class="row">
										<div class="col-8 offset-2 text-center">
										@if($document->reply_type == 1) 
											<form action="{{ route("document.acknowledge", $document->id) }}" method="post">
												@csrf
												@method("PUT")
												<button class="btn btn-primary mt-3" name="status" value="approve" type="submit">รับทราบ</button>
											</form>
											
										@else
											<button class="btn btn-outline-primary mt-3" name="status" value="unapprove" type="submit">ไม่อนุมัติ</button>
											<button class="btn btn-primary mt-3" name="status" value="approve" type="submit">อนุมัติ</button>
								
										@endif
										</div>
									</div>
						</div>


					</div>


				</div>
			</div>
		</div>
	
	@csrf

  {{-- </form> --}}

</div>

@endsection

@section('script')
<script src="{{asset('js/document/edit.js')}}"></script>
<script src="{{asset('auto-complete/js/bootstrap-typeahead.min.js')}}"></script>
<script>

	function getFolderurl(id) {
		host = "{{ url("") }}";
		uri = host+"/ajax/cabinets/"+id+"/folders" ;
		return uri ;
	}
	$('button.rm-file').click(function(e){
		id = $(this).data("file");
		$ele = $(`<input name="file_delete[]" value="${id}">`);
		$('form').append($ele);
		$(this).parent().parent().remove();
	});
	$('button.rm-refer').click(function(e){
		e.preventDefault();
		$(this).parent().remove();
	});
	$("#cabinetSelect").change(function(){
		id = $(this).val();
		console.log(typeof(id));
		$folderEle = $("#folderSelect") ;
		if(id !== ""){
			axios.get(getFolderurl(id))
			.then(function(res){
				$folderEle.prop("disabled", false);
				$($folderEle).empty();
				res.data.forEach(function(item) {
					$child = $(`<option value="${item.id}">${item.name}</option>`);
					$($folderEle).append($child);
				});
			})
			.catch(function(err){
			});
		} else {
			$folderEle.prop("disabled", true);
			$folderEle.val(null);
		}
	});
	$("#refer").search({
		url: "{{url("document_refer")}}"
	})

</script>
@endsection

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="{{ asset("css/document/create.css") }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{asset("semantic/dist/semantic.css")}}"> --}}

@endpush

@push('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
	{{-- <script src="{{asset("semantic/dist/semantic.min.js")}}"></script> --}}
@endpush