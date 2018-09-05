@extends('layouts.app')

@section('nav-top')
  @include('layouts.nav-top', ['active'=>3])
  {{ Breadcrumbs::render('folder.create', $cabinet) }}

  {{-- @include('layouts.breadcrumb', [$items => $breadcrumbs]) --}}
@endsection

@section('content')
  <div class="container">
    <div class="text-right mb-3">
      <div class="col-8 offset-2">
        <a href="{{route('cabinet.folder.create', $cabinet->id)}}" class="btn edoc-btn-primary ">
          <i class="fa fa-plus"></i>
          สร้างแฟ้มใหม่
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body p-0 border-top-primary">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="w-75">ตู้เอกสาร</th>
                  <th>จัดการ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($folders as $folder)
                <tr class="">
                  <td class="">
                    <div>
                      <div >
                        <span>

                          {{$folder->name}} 
                        </span>
                        (
                          @if($folder->documents->count())
                            <a href=" {{ route("document.index") }}">
                              {{ "มีเอกสาร ".$folder->documents->count()." ฉบับ"}}
                            </a>
                          @else 
                            <span style="color:dimgray">ไม่มีเอกสาร</span>
                          @endif

                        )
                      </div>
                    </div>
                    <div >
                      <div class="mb-2 mt-2" > <b>คำอธิบาย:</b></div>
                      <div class="" >{{$folder->description}}</div>
                    </div>
                  </td>
                  <td class="">
                      {{-- <a class="text-secondary icon-link" href="{{ route('cabinet.folder.edit', $folder->id) }}">
                          <i class="fa fa-address-book"></i>
                      </a> --}}
                      <a class="text-secondary icon-link" href="{{ route('cabinet.folder.edit', $folder->id) }}">
                          <i class="fa fa-edit"></i>
                      </a>
    
                  </td>
                </tr>
                    
                @endforeach
              </tbody>
            </table>
          </div>
    
        </div>

      </div>
    </div>
  </div>
@endsection 

@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush