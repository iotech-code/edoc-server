@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top')
@endsection

@section('content')
<div class="container-fluid " style="padding: 0">
  {{-- <div class="row"> --}}
    <form method="get" action="{{ route("document.index")}}" >
      <div class="w-75" style="margin: auto">
        <input type="text" class="w-100">
      </div>
    {{-- </form> --}}

  </div>
  <div class="row table-tab">
    <div class="col t-all item active">
        {{-- <span class="mdi mdi-inbox"></span> --}}
        <i class="fas fa-inbox"></i>
        <span class="header">
          ทั้งหมด
        
        </span>
    </div>
    <div class="col t-inbox item active">
      <i class="fas fa-envelope-open-text"></i>
      {{-- <span class="mdi mdi-inbox-arrow-down"></span> --}}
      <span class="header">
        เอกสารขาเข้า
          
      </span>

    </div>
    <div class="col t-sentbox item active">
      <i class="fas fa-envelope"></i>
      {{-- <span class="mdi mdi-inbox-arrow-up"></span> --}}
      <span class="header">
        เอกสารขาออก
          
      </span>
    </div>
    <div class="col item t-cabinet active">
        <i class="fas fa-archive active"></i>
        <span class="header">
          ตู้เอกสาร
        </span>
    </div>
    <div class="col item ">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              สถานนะ
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#"><span class="status-circle status-blue mr-1"></span> ทั้งหมด</a>
              <a class="dropdown-item" href="#"><span class="status-circle status-grey mr-1"></span> ฉบับร่าง</a>
              <a class="dropdown-item" href="#"> <span class="status-circle status-yellow mr-1"></span> ดำเนินการ</a>
              <a class="dropdown-item" href="#"><span class="status-circle status-red mr-1"></span> ไม่อนุมัติ</a>
              <a href="#" class="dropdown-item"><span class="status-circle status-green mr-1"></span>สำเร็จ</a>
            </div>
          </div>

    </div>
  </div>
  <div class="">
      <div class="card-body p-0 ">
            <table class="table ">
                    <thead>
                        <tr class="">
                            <th class="color-secondary" width="100">สถานะ</th>
                            <th class="color-secondary" width="100">ตู้จัดเก็บเอกสาร</th>
                            <th class="color-secondary" width="100">เลขที่เอกสาร</th>
                            <th class="color-secondary">ชื่อเอกสาร</th>
                            <th class="color-secondary" width="100">ที่มาเอกสาร</th>
                            <th class="color-secondary" width="100">วันที่เอกสาร</th>
                            <th class="color-secondary" width="100">จัดการเอกสาร</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($documents as $document)
                           <tr>
                             <td> {!!$document->render_status !!}</td>
                             <td> {{ $document->cabinet->name }} </td>

                             <td> {{ $document->code }} </td>
                             <td> {{ $document->title }} </td>
                             <td> {{ $document->sendToCabinet->name }} </td>

                             {{-- <td></td> --}}
                             <td> {{ $document->be_date }} </td>
                             <td>
                               @if ($user->assignmentAlert($document->id)->count() )
                                    <a 
                                    class="btn btn-danger"
                                    href="{{ route("document.show", $document->id) }}">
                                        มีการแจ้งเตือน
                                    </a>
                                   {{-- <button class="btn btn-danger"
                                   data-toggle="modal"
                                   data-target="#alertModal" 
                                   >มีการแจ้งเตือน</button> --}}
															 @else
																	 
																@if ( $document->status == 1 && $document->user_id == $user->id )
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
																@if ( $document->status == 1 && $document->user_id == $user->id)
                                  <a class="text-secondary icon-link" href="{{ route('document.edit', $document->id) }}">
                                      <i class="fa fa-edit"></i>
                                  </a>
																@endif
																@if ($document->status == 1 && $document->user_id == $user->id)
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
      @if( !is_array($documents ))
      <div class="col">
        {{ $documents->links() }}
      </div>
      @endif
	</div>
	
</div>
	{{-- <div id="examModal" class="modal" role="dialog" style="display:block"> --}}
<div id="examModal" class="modal" role="dialog" >
		<div class="modal-dialog" role="document">
      <form id="approveForm" action="" method="post" >
				<div class="modal-content border-top-primary">
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
                  <input class="form-control" type="text" placeholder="ค้นหารายชื่อ">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="fa fa-search"></i>
                    </span>
                  </div>
                </div>
                <div class="results">

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
                <textarea class="form-control" name="remark" id="" cols="30" rows="5" placeholder="ใช้บันทึก เตือนความจำ หรืออธิบายเนื้อหาของเอกสารโดยย่อ เป็นต้น"></textarea>
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

<div id="alertModal" class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-top-primary">
      <div class="modal-header">
        เอกสารจาก: 
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-6">
            <label for="">ประเภทเอกสาร</label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group col-6">
              <label for="">การตอบกลับ</label>
              <input type="text" class="form-control">
            </div>
        </div>
        <div class="form-group">
          <label for="">ความคิดเห็น</label>
          <textarea name="remark" id="" cols="30" rows="10"></textarea>
        </div>
      </div>
    </div>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.css">
    <link rel="stylesheet" href="{{ asset("css/document/index.css") }}">

@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
@endpush