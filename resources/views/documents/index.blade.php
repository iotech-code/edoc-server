@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top')
@endsection

@section('content')
<div class="container">
  <form method="get" action="{{ route("document.index")}}" >
    <div class="row mt-2">
      <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">ค้นหาจากคำ</label>
            <div class="form-inline">
            <input type="text"  name="search[title]" 
              value="{{ $title }}"
              class="form-control mr-3" placeholder="">
            </div>
        </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="exampleInputEmail1">ค้นหาจากวันที่เอกสาร</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                          <i class="fa fa-calendar"></i>
                      </span>
                        {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                <i class="fa fa-calendar"></i>
                        </button> --}}
                    </div>
                    <input autocomplete="off" type="text" class="form-control date-select" placeholder="" name="search[date_start]" value="{{$date_start}}">
                </div>
            </div>
        </div>
        <div class="col">
          <label for="exampleInputEmail1">ถึง</label>
          <div class="form-group">
              <div class="input-group ">
                  <div class="input-group-prepend">
                      {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                          <i class="fa fa-calendar"></i>                        
                      </button> --}}
                      <span class="input-group-text" id="basic-addon1">
                          <i class="fa fa-calendar"></i>
                      </span>
                  </div>
                <input autocomplete="off" type="text" class="form-control date-select" placeholder="" name="search[date_end]" value="{{ $date_end }}">
                </div>

          </div>
        </div>
        <div class="col">
          <label style="color:white" for="">s</label>
          <div class="form-group ">
              <button type="submit" class="btn edoc-btn-primary">
                  เริ่มค้นหา
              </button>
          </div>
        </div>
    </div>
  </form>

  <div class="card mt-4">
      <div class="card-body p-0 border-top-primary">
            <table class="table ">
                    <thead>
                        <tr class="">
                            <th class="color-secondary">สถานะ</th>
                            <th class="color-secondary">ตู้จัดเก็บเอกสาร</th>
                            <th class="color-secondary">เลขที่เอกสาร</th>
                            <th class="color-secondary">ชื่อเอกสาร</th>
                            <th class="color-secondary">ที่มาเอกสาร</th>
                            <th class="color-secondary">วันที่เอกสาร</th>
                            <th class=	"color-secondary">จัดการเอกสาร</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($documents as $document)
                           <tr>
                             <td> {!!$document->render_status !!}</td>
                             <td> {{ $document->cabinet->name }} </td>
                             <td> {{ $document->code }} </td>
                             <td> {{ $document->title }} </td>
                             <td> {{ $document->from }} </td>
                             <td> {{ $document->date }} </td>
                             <td>
															 @if ($user->assignmentAlert($document->id)->count() )
																	 <button class="btn btn-danger">มีการแจ้งเตือน</button>
															 @else
																	 
																@if ( $document->status == 1)
																	<a class="text-secondary edoc-link-form icon-link assign" href="#" 
																		data-toggle="modal"
																		data-target="#examModal" 
																		data-doc-type="{{$document->type->name}}"
																		data-doc-id="{{$document->id}}"
																		data-url="{{route("document.assign", $document->id)}}">
																			{{-- <form action="{{ route('document.update', $document->id) }}" method="post">
																					<input type="hidden" name="action" value="update_status">
																					<input type="hidden" name="status_value" value="2">
																					@method("PUT")
																					@csrf
																			</form> --}}
																			<i class="fa fa-external-link"></i>
																	</a>  											
																@endif
																@if ( $document->status == 1 )

																<a class="text-secondary icon-link" href="{{ route('document.edit', $document->id) }}">
																		<i class="fa fa-edit"></i>
																</a>
																@endif
																@if ($document->status == 1)
																	<a class="text-secondary edoc-link-form icon-link btn-delete" href="#">
																			<i class="fa fa-trash"></i>
																			<form action="{{ route('document.update', $document->id) }}" method="post">
																					@method("DELETE")
																					@csrf
																			</form>
																	</a>
																@endif
															 @endif
                            </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
      </div>
  </div>
  <div class="row mt-3" style="color: #515151; font-weight: bold">
      <div class="col">
        สถานะ: 
        <span class="status-circle status-grey"></span> ยังไม่มีการตรวจสอบ
        <span class="status-circle status-yellow"></span> กำลังดำเนินการ
        <span class="status-circle status-red"></span> ไม่อนุมัติ
        <span class="status-circle status-green"></span> อนุมัติ
      </div>
      <div class="col">
        {{ $documents->links() }}
      </div>
	</div>
	
</div>
	{{-- <div id="examModal" class="modal" role="dialog" style="display:block"> --}}
<div id="examModal" class="modal" role="dialog" >
		<div class="modal-dialog" role="document">
				<form id="approveForm" action="" method="post" >

				<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">ส่งเอกสาร</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">
							@csrf
							@method("PUT")
							<div class="form-group">
								<label for="">ถึง: </label>
								{{-- <input type="text" class="form-control"> --}}
								<div class="input-search-group" id="nameSearch">
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
								<div id="tagged"></div>
							</div>
							<div class="row">
								<div class="col-6">
										<div class="form-group">
												<label for="">หัวจดหมาย: </label>
												<input type="text" class="form-control" name="heading">
											</div>
								</div>
								<div class="col-6">
										<div class="form-group">
												<label for="">ประเภทเอกสาร: </label>
												<input type="text" class="form-control" id="modalDoctypeInput" disabled>
											</div>
								</div>

							</div>
							<div class="form-group">
									<label for="">การตอบกลับ: </label>
									{{-- <input type="text" class="form-control"> --}}
									<select name="reply_type" id="" class="form-control">
										@foreach (App\Models\DocumentReplyType::all() as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									</select>
							</div>
							<div class="form-group">
									<label for="">ความเห็นเพิ่มเติม: </label>
									<textarea class="form-control" name="remark" id="" cols="30" rows="5"></textarea>
							</div>
							<input type="hidden" name="document_id">
				</div>
				<div class="modal-footer float-left">
					<button type="submit" class="btn btn-primary">ส่งเอกสาร</button>
					<button type="button" class="btn btn-secondary text-left" data-dismiss="modal">ปิด</button>
				</div>
				</div>
		</form>
	</div>
</div>

@endsection

@section('script')
<script src="{{asset('js/document/index.js')}}"></script>
<script>
	$(`a.btn-delete`).click(function(e){
		e.preventDefault();
		$(this).find('form').submit();
	});
	$("#nameSearch").search({
		url: "{{ route("ajax.search_user")}}"
	});
	$('a.assign').click(function(e){
		e.preventDefault();
		url = $(this).data("url");
		type = $(this).data("doc-type");
		id = $(this).data("doc-id");

		$("#approveForm").attr("action", url);
		$("#approveForm").find(`input[name="document_id"]`).attr("value", id);		
		$("#modalDoctypeInput").attr("value", type);
	})
</script>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="{{ asset("css/document/create.css") }}">

@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
@endpush