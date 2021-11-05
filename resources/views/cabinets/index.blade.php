@extends('layouts.app')

@section('nav-top')
  @include('layouts.nav-top', ['active'=>3])
  {{-- {{ Breadcrumbs::render('cabinet.index') }} --}}
  
@endsection

@section('content')
  <div class="container">
 
    @if (auth()->user()->role_id == 1)
        
    <div class="text-right mb-3">
      <div class="col-12 ">    
        <a href="{{route('cabinet.create')}}" class="btn edoc-btn-primary ">
          <i class="fa fa-plus"></i>
          สร้างตู้ใหม่
        </a>

      </div>
    </div>
    @endif
    <div class="row">
    <img class="ml-3 mr-2 text-left" src="{{ asset("image/cabinet.png")}}" alt="" srcset="" width="30px" height="30px">&nbsp;
	    <label style="font-size: 20px; font-weight:bold; color:forestgreen"> ตู้เอกสาร </label>
      <div class="col-12 mt-2">
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
                @foreach ($cabinets as $cabinet)
                <tr class="">
                  <td class="">
                    <div>
                      <div >
                        <span>

                          {{$cabinet->name}} 
                        </span>
                        @if( auth()->user()->cabinetPermissions->where("id", $cabinet->id)->count() )
          

                        @endif
                        @if( auth()->user()->role_id == 1 ) 
                        (
                        <a href=" {{ route("cabinet.folder.index", $cabinet->id) }}">
                          {{ $cabinet->folders->count()." แฟ้ม"}}
                        </a>
                        )
                        @elseif( auth()->user()->cabinetPermissions->where("id", $cabinet->id)->count() )
                        (
                        <a href=" {{ route("cabinet.folder.index", $cabinet->id) }}">
                          {{ $cabinet->folders->count()." แฟ้ม"}}
                        </a>
                        )
                        @endif

                      </div>
                    </div>
                    <div >
                      <div class="mb-2 mt-2" > <b>คำอธิบาย:</b></div>
                      <div class="" >{{$cabinet->description}}</div>
                    </div>
                  </td>
                  <td class="">
                      @if( auth()->user()->role_id == 1 ) 
                      <!-- <a href="{{ url('index') }}"><img class="mr-1" src="{{ asset("image/icon-logo2.png")}}" alt="" srcset="" ></a> -->
                      <a class="text-secondary icon-link" href="{{ route('cabinet.permission.index', $cabinet->id) }}">
                      <img class="mr-1" src="{{ asset("image/cabinet-add.png")}}" alt="" srcset="" >
                      </a>
                      <a class="text-secondary icon-link" href="{{ route('cabinet.edit', $cabinet->id) }}">
                      <img class="mr-1" src="{{ asset("image/cabinet-edit.png")}}" alt="" srcset="" >
                      </a>
                      <a href="{{route('cabinet.folder.create', $cabinet->id)}}" class="text-secondary icon-link">
                      <img class="mr-1" src="{{ asset("image/cabinet-doc.png")}}" alt="" srcset="" >
                      </a>
                      <a class="text-secondary icon-link" href="{{ route('cabinet.destroy', $cabinet->id) }}" onclick="if(confirm('Are you sure?')==false) return false">
                      <img class="mr-1" src="{{ asset("image/cabinet-delete.png")}}" alt="" srcset="" >
                        </a>
                      @elseif( auth()->user()->cabinetPermissions->where("id", $cabinet->id)->count() )
                      {{-- <a class="text-secondary icon-link" href="{{ route('cabinet.edit', $cabinet->id) }}">
                      <img class="mr-1" src="{{ asset("image/cabinet-edit.png")}}" alt="" srcset="" >
                      </a> --}}
                      <a href="{{route('cabinet.folder.create', $cabinet->id)}}" class="text-secondary icon-link">
                      <img class="mr-1" src="{{ asset("image/cabinet-doc.png")}}" alt="" srcset="" >
                          
                        </a>
                      @endif
                      
    
                  </td>
                </tr>
                    
                @endforeach
              </tbody>
            </table>
          </div>
    
        </div>

      </div>
    </div>
    <div class="row mt-3" style="color: #515151; font-weight: bold">
      <div class="col-8 offset-2">
        {{ $cabinets->links() }}
      </div>
    </div>
  </div>

  @include('alert.alert')
@endsection 


@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.css">
    <link rel="stylesheet" href="{{ asset("css/document/index.css") }}">

@endpush
