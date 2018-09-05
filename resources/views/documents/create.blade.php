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

  <form class="" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
  <div class="row">
	<div class="col-md-7 mb-2">
		<h3>
		รายละเอียดเอกสาร
		</h3>
		<div class="card border-top-primary ">
	
		  <div class="card-body">
			  
			  <div class="form-row">
					<div class="form-group col-4">
						<label for="">ตู้จัดเก็บเอกสาร</label>
						<select id="cabinetSelect" class="form-control" name="cabinet_id">
								<option value="">เลือกตู้เอกสาร</option>

								@foreach ($cabinets as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
							</select>
					</div>
					<div class="form-group col-4">
						<label for="">เลขแฟ้ม</label>
						<select id="folderSelect" class="form-control" name="folder_id"  disabled>
								{{-- @foreach (App\Models\Cabinet::first()->folders as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach --}}
						</select>					
					</div>
					<div class="form-group col-4">
						<label for="">ประเภทเอกสาร</label>
						<select class="form-control" name="type_id" >
								@foreach (App\Models\DocumentType::all() as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
						</select>
					</div>
			  </div>
			  <div class="form-row">
					<div class="form-group col">
						<label for="">จาก</label>
						{{-- <input type="text" name="from" class="form-control">
						 --}}
						 <select class="form-control" name="from" >
								@foreach ( $user->local_cabinets as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
						</select>
					</div>

					<div class="form-group col">
						<label for="">เลขที่</label>
						<input type="text" name="code" class="form-control">
					</div>
					<div class="form-group col">
						<label for="">วันที่</label>
						<div class="input-group ">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
							<input type="text" name="date" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
						</div>
					</div>
				</div>
				

			  {{-- <div class="form-row"> --}}
	
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
								{{-- <div class="result">test</div>
								<div class="result">test</div>
								<div class="result">test</div> --}}
							</div>
						</div>
						<div id="taged">
							{{-- <span class="badge badge-info">Info ฟ</span>
							<span class="badge badge-info">Info</span>
							<span class="badge badge-info">Info</span>
							<span class="badge badge-info">Info</span> --}}

						</div>

					</div>
					<div class="form-group col">
						<label for="">เรื่อง <span class="red-star"></span></label>
						<input type="text" name="title" required class="form-control">
					</div>
	
			  </div>
			  {{-- </div> --}}
			  {{-- <div class="form-row"> --}}
				{{-- <div class="form-row">
				  <div class="col">
					<label for="">คำสำคัญ</label>
				  </div>
				</div>
				<div class="form-row">
	
				  <div class="form-group col">
					  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
				  </div>
				  <div class="form-group col">
					  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
				  </div>
				  <div class="form-group col">
					  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
				  </div>
				</div> --}}
			  {{-- </div>      --}}
			  <div class="form-row">

					<div class="form-group col">
						<label for="">คำสำคัญ</label>
						<input type="text" name="keywords" class="form-control">
					</div>
					<div class="form-group col">
						<label for="">เลขที่รับ</label>
						<input type="text" name="receive_code" class="form-control">
					</div>
					<div class="form-group col">
						<label for="">วันที่รับ</label>
						<div class="input-group ">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
							<input name="receive_date" type="text" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
						</div>
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
						<button id="addFile" type="button" class="btn btn-success rounded-circle btn-sm">
											<i class="fa fa-plus"></i>
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
		
					
							</div>
						</div>
						</div>
				</div>
		</div>
	
  </div>

  @csrf
  <button class="btn btn-primary mx-auto mt-3" style="display:block" type="submit">ตกลง</button>
  </form>

</div>

@endsection

@section('script')
<script src="{{asset('js/document/create.js')}}"></script>
<script src="{{asset('auto-complete/js/bootstrap-typeahead.min.js')}}"></script>
<script>

	function getFolderurl(id) {
		host = "{{ url("") }}";
		uri = host+"/ajax/cabinets/"+id+"/folders" ;
		return uri ;
	}
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
		url: "{{ route("ajax.document_refer")}}"
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