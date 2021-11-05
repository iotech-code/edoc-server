@extends('layouts.app')

@section('nav-top')
  @include('layouts.nav-top', ['active'=>7])
  {{-- {{ Breadcrumbs::render('cabinet.index') }} --}}
  
@endsection

@section('content')
  <div class="container">
    <form method="POST" action="{{ route("cabinet.permission.update", $cabinet->id) }}">
      @method("PUT")
      @csrf
    <div class="text-center mb-3">
      <div class="col-12">
        <h3>
          จัดการสิทธิ์ {{$cabinet->name}}
        </h3>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-0 border-top-primary">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ชื่อ - นามสกุล</th>
                  <th class="w-10 text-center">กำหนดสิทธิ์</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr >
                  <td>  
                      {{$user->full_name}}
                    
                  </td>
                  <td class="w-25 text-center">
                    @if (auth()->user()->role_id == 1)
                      <input 
                        value="{{ $user->id }}"
                        name="users[]"
                        @if( $user->cabinetPermissions()->where("cabinet_id", $cabinet->id)->count()  ) checked @endif
                        type="checkbox">
                    {{-- @elseif( $user->cabinetPermissions()->where("cabinet_id", $cabinet->id)->count()  ) --}}
                      {{-- <input type="checkbox" name="users[]" value="{{ $user->id }}" data-user-id="{{ $user->id }}" checked @if ($user->role_id != 1)>  --}}
                    {{-- @else --}}
                    @else
                      <input 
                        @if( $user->cabinetPermissions()->where("cabinet_id", $cabinet->id)->count()  ) checked @endif
                        disabled
                        type="checkbox" name="users[]" value="{{ $user->id }}" data-user-id="{{ $user->id }}">
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
    <div class="row mt-3">
      <div class="col-12 ">

        <div class="button-group text-center">
          <a href="{{ route("cabinet.index", $cabinet->id) }}" class="btn edoc-btn-primary inverse">ย้อนกลับ</a>
          @if (auth()->user()->role_id == 1)
            <button class="btn edoc-btn-primary">บันทึก</button>
          @endif

        </div>
      </div>
    </div>
  </form>

  </div>
@endsection 

@section('script')
<script>
  $('input').change(function(e){
    val = $(this).val();
    console.log(val);
    
  });
</script>
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
