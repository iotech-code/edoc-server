@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top')
@endsection

@section('content')
<div class="container">
  <form >
    <div class="row">
      <div class="col">
        <div class="form-group">
            <label for="exampleInputEmail1">ค้นหาจากคำ</label>
            <div class="form-inline">
              <input type="email" class="form-control mr-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
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
                    <input autocomplete="off" type="text" class="form-control date-select" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
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
                  <input autocomplete="off" type="text" class="form-control date-select" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              </div>

          </div>
        </div>
        <div class="col">
          <label style="color:white" for="">s</label>
          <div class="form-group ">
              <button type="submit" class="btn btn-primary">
                  เริ่มค้นหา
              </button>
          </div>
        </div>
    </div>
  </form>

  <div class="card">
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
                            <th class="color-secondary">จัดการเอกสาร</th>
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
                                 @if ($document->status == 1)
                                    <a class="text-secondary edoc-link-form icon-link" href="#">
                                        <form action="{{ route('document.update', $document->id) }}" method="post">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="status_value" value="2">
                                            @method("PUT")
                                            @csrf
                                        </form>
                                        <i class="fa fa-external-link"></i>
                                    </a>  
                                 @endif
            
            
                                <a class="text-secondary icon-link" href="{{ route('document.edit', $document->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="text-secondary edoc-link-form icon-link" href="#">
                                    <i class="fa fa-trash"></i>
                                    <form action="{{ route('document.update', $document->id) }}" method="post">
                                        @method("DELETE")
                                        @csrf
                                    </form>
                                </a>
                            </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
      </div>
  </div>
  
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link " href="#">ก่อนหน้า</a></li>
            <li class="page-item active"><a class="page-link " href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
        </ul>
    </nav> --}}
    {{ $documents->links() }}
</div>
@endsection

@section('script')
    <script src="{{asset('js/document/index.js')}}"></script>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
@endpush