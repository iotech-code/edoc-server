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
	@isset($errors)
		@include('errors.validate', $errors->all())
			
	@endisset

	<form id="createForm" class="" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
  <div class="row">
	<div class="col-md-7 mb-2">
		<h3>
		รายละเอียดเอกสาร
		</h3>
		<div class="card border-top-primary ">
	
		  <div class="card-body">
			  	
			  <div class="form-row">
					
					<div class="form-group col">
						<label for="">เรื่อง <span class="red-star"></span></label>
						<input value="{{ old('title') }}" type="text" name="title" required class="form-control">
					</div>
	
				</div>
				<div class="form-row">
					<div class="form-group col">
							<label for="">เอกสารอ้างอิง</label>
							<div class="input-search-group" id="refer">
								<div class="input-group">
									<input class="form-control" type="text" placeholder="ค้นหาเอกสารอ้างอิง">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="fa fa-search"></i>
										</span>
									</div>
								</div>
								<div class="results">
	
								</div>
							</div>
							<div id="taged">
	
							</div>
	
						</div>
					<div class="form-group col">
						<label for="">ประเภทเอกสาร<span class="red-star"></span></label>
						<select class="form-control" name="type_id" required>
								<option value="">เลือกประเภทเอกสาร</option> 

								@foreach (App\Models\DocumentType::all() as $item)
										<option value="{{$item->id}}"
												@if (old('type_id') == $item->id)
													selected
												@endif
											>{{$item->name}}</option>
								@endforeach
						</select>
					</div>
				</div>
			  <div class="form-row">
					<div class="form-group col">
						<label for="">ตู้เอกสารต้นทาง<span class="red-star"></span></label>
							<select id="cabinetSelect" class="form-control" name="cabinet_id" >
								<option value="">เลือกตู้เอกสารต้นทาง</option> 
								
								@foreach ( $user->cabinetPermissions as $cabinet) 
										<option value="{{$cabinet->id}}"
												@if (old('cabinet_id') == $cabinet->id)
														selected
												@endif
											>{{$cabinet->name}}</option>
								@endforeach
						</select>
					</div>
					<div class="form-group col">
						<label for="">เลขที่เอกสาร<span class="red-star"></span></label>
						<input type="text" name="code" class="form-control" value="{{old('code')}}">
					</div>
					<div class="form-group col">
						<label for="">ลงวันที่<span class="red-star"></span></label>
						<div class="input-group ">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
							<input value="{{ old('date')}}" type="text" name="date" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1" required>
						</div>
					</div>

			  </div>
			  <div class="form-row">
					<div class="form-group col">
						<label for="">เลขแฟ้มต้นทาง<span class="red-star"></span></label>
						<select id="folderSelect" class="form-control" name="folder_id" disabled required>
							<option value="">เลือกแฟ้มเก็บเอกสาร</option> 
						</select>					
					</div>
					<div class="form-group col">
						<label for="">ตู้เอกสารปลายทาง<span class="red-star"></span></label>
						<select  class="form-control" name="send_to_cabinet_id" required>
							<option value="">เลือกตู้เอกสารปลายทาง</option> 
							@foreach ($user->getLocalCabinets()->get() as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
			  <div class="form-row">
					<div class="form-group col">
						<label for="">เลขที่รับ</label>
						<input type="text" name="receive_code" class="form-control">
					</div>
					<div class="form-group col">
						<label for="">วันที่รับ<span class="red-star"></span></label>
						<div class="input-group ">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
							<input value="{{ old('receive_date')}}" name="receive_date" type="text" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
						</div>
					</div>
					<div class="form-group col">
						<label for="">คำค้น</label>
						<input type="text" name="keywords" class="form-control">
					</div>
			  </div>     
	
		  </div>
	
		</div>

	</div>
	<div class="col-md-5 row">
		<div class="col-12">
			<h3>ไฟล์แนบ</h3>
			<div class="card border-top-primary">
				<div class="card-body" style="min-width: 320px">
					<div class="row mb-2">
						<div class="col-12">
						<div id="fileGroup">
							<div class="row mb-3" id="file1">
								<div class="col" >
									<input type="file" name="files[]">
									<button type="button" class="btn btn-danger btn-sm rounded-circle btn-remove-file" data-file="1">
										<i class="fa fa-times"></i>
									</button>
								</div>
							</div>
						</div>
						</div>   
			
					</div>
					<div class="row">
						<div class="col-12">
						<button id="addFile" type="button" class="btn btn-success  btn-sm">
							<i class="fa fa-plus"></i>
							<span>
								เพิ่มไฟล์
							</span>
						</button>
						</div>   
					</div>
				</div>
				</div>

		</div>
			<div class="col-12" >
					<h3>รายการเอกสารอ้างอิง</h3>
					<div class="card border-top-primary">
						<div class="card-body" style="min-width: 320px">
							<div class="row mb-2" id="referItem">
								@if(old('refers'))
									@foreach( old('refers') as $id )
										<div class="col-12 mb-1"><a href="#">{{ App\Models\Document::find($id)->title }}</a>
											<input type="hidden" name="refers[]" value="{{$id}}">
											<button type="button" class="btn btn-danger btn-sm rounded-circle float-right">
												<i class="fa fa-times"></i>
											</button>
										</div>
									@endforeach
								@endif

								
							</div>
						</div>
						</div>
				</div>
		</div>
	
  </div>

	@csrf
	<div class="text-center">
		{{-- <a class="btn btn-secondary mx-auto mt-3"  href="{{ route('document.index') }}">หน้าแรก</a> --}}
		<button class="btn btn-outline-primary mx-auto mt-3" style="" type="submit" name="save">บันทึก</button>
		<button id="sendBtn" class="btn btn-primary mx-auto mt-3" style="" type="button"
			data-toggle="modal"
			data-target="#submitModal" >ส่ง</button>

	</div>

	<div id="submitModal" class="modal" role="dialog" >
			<div class="modal-dialog" role="document">
				{{-- <form id="approveForm" action="" method="post" > --}}
					<div class="modal-content border-top-primary">
						<div class="modal-header">
								<h5 class="modal-title">ส่งเอกสาร</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">ถึง: </label>
								{{-- <input type="text" class="form-control"> --}}
								{{-- <div class="input-search-group-name" id="nameSearch">
									<div class="input-group">
										<input  class="form-control" type="text" placeholder="ค้นหารายชื่อ">
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="fa fa-search"></i>
											</span>
										</div>
									</div>
									<div class="results">
	
									</div>
								</div> --}}
								<select id="selectReceiver" class="form-control">
									<option value="null"></option>
									@foreach ($users as $user)
										@if(auth()->user()->id != $user->id)
											<option value="{{$user->id}}">{{$user->full_name}}</option>
										@endif
									@endforeach
								</select>
								<div id="tagged"></div>
							</div>
							<div class="row">
								<div class="col-6">
										<div class="form-group">
												<label for="">ชื่อเอกสาร: </label>
												<input type="text" class="form-control" id="titleModal" disabled>
											</div>
								</div>
								<div class="col-6">
										<div class="form-group">
												<label for="">ประเภทเอกสาร: </label>
												<input type="text" class="form-control" id="documentTypeInputModal" disabled>
											</div>
								</div>
	
							</div>
							<div class="form-group">
									<label for="">การตอบกลับ: </label>
									{{-- <input type="text" class="form-control"> --}}
									<select name="reply_type_id" id="" class="form-control">
										@foreach (App\Models\DocumentReplyType::all() as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									</select>
							</div>
							<div id="approveUser" class="form-group">
								<label for="">ผู้อนุมัติเอกสาร</label>
								{{-- <input class="form-control" type="text" name="approve_user" id="" disabled> --}}
								<select name="approved_user_id" id="approve_user" class="form-control" disabled>
									<option value="null"></option>
	
									@foreach ($users as $user)
										<option value="{{$user->id}}">{{$user->full_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
									<label for="">ความเห็นเพิ่มเติม: </label>
									<textarea class="form-control" name="comment" id="" cols="30" rows="5" placeholder="ใช้บันทึก เตือนความจำ หรืออธิบายเนื้อหาของเอกสารโดยย่อ"></textarea>
							</div>
							<input type="hidden" name="document_id">
						</div>
						<div class="modal-footer float-left">
							<button type="button" id="sendButton" class="btn btn-success" data-dismiss="modal" name="send">บันทึกและส่งทันที</button>
							<button type="button" class="btn btn-secondary text-left" data-dismiss="modal">ปิด</button>
						</div>
					</div>
			{{-- </form> --}}
		</div>
		
	</div>
	</form>
</div>


@endsection

@section('script')
<script src="{{asset('js/document/create.js')}}"></script>
{{-- <script src="{{asset('js/nameSearch.js')}}"></script> --}}
{{-- <script src="{{asset('auto-complete/js/bootstrap-typeahead.min.js')}}"></script> --}}
<script>

	function getFolderurl(id) {
		host = "{{ url("") }}";
		uri = host+"/ajax/cabinets/"+id+"/folders" ;
		return uri ;
	}

	$('#sendButton').click(function(){
		form = $("#createForm");
		input = $(`<input name="submit_type" value="send" type="hidden">`);
		form.append(input);
		$('button[type="submit"]').trigger('click');
	});

	$("#selectReceiver").change(function(e){
		// console.log(e);
		value = $(this).val();
		text = $(this).find('option:selected').text();
		if( $(`input[name="send_to_users[]"][value="${value}"]`).length == 0 ){
			$link = $(`<a href="">${text}</a>`);
			$deleteBtn = $(`<a class="rm-tag" href="#" data-refer="${value}" > <i class="fa fa-times"> </i></a>`) ;
			$value = $(`<input type="hidden" name="send_to_users[]" value="${value}" >`);
			$tag = $(`<span class="badge badge-info mr-1" > ${text}</span>`) ;
			
			// $('input[name="send_to_users"]').val(text);
			$tag.append($deleteBtn);
			$tag.append($value);
			$deleteBtn.click(function(e){
				e.preventDefault();
				$(this).parent().remove();
			});
			$("#tagged").append($tag);
		} 
		$(this).find('option:selected').prop('selected', false);

	})

	$('select[name="reply_type_id"]').change(function(e){
		value = $(this).find("option:selected").val();
		console.log(value);

		if (value == 2) {
			$('select[name="approved_user_id"]').prop('disabled', false);
			$('select[name="approved_user_id"]').find('option[value="null"]').remove();

		} else{
			$('select[name="approved_user_id"]').prop('disabled', true);
			$('select[name="approved_user_id"]').prepend(`<option value="null"></option>`);
			$('select[name="approved_user_id"]').find('option:selected').prop('selected', false);

		}
	});

	$('select[name="type_id"]').change(function(){
		value = $(this).find("option:selected").text();
		console.log(value);
		$("#documentTypeInputModal").val(value)
	});
	$('input[name="title"]').change(function(){
		value = $(this).val();
		// console.log(value);
		$("#titleModal").val(value)
	});
	$("#cabinetSelect").change(function(){
		id = $(this).val();
		// console.log(typeof(id));
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
    el: "#refer",

		url: "{{ route("ajax.document_refer")}}",
		callback: function(value){
			// console.log(value);
			$("#titleModal").val(value);
		}
	})

	// $("#nameSearch").nameSearch({
  //   el: "#nameSearch",
	// 	url: "{{ route("ajax.search_user")}}"
	// });

</script>
@endsection

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> --}}

	<link rel="stylesheet" href="{{ asset("css/document/create.css") }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{asset("semantic/dist/semantic.css")}}"> --}}

@endpush

@push('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
	{{-- <script src="{{asset("semantic/dist/semantic.min.js")}}"></script> --}}
@endpush