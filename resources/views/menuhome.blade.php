@extends('layouts.app')

@section('nav-top')
  @include('layouts.nav-top', ['active'=>0])
  {{-- {{ Breadcrumbs::render('cabinet.index') }} --}}
  
@endsection

@section('content')
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-7 ">
        <div class="card border-top-primary ">
            <div class="card-body ">
                <div class="form-row ">
                <div class=" row py-1 ">
                <div class=" m-1">
                <a href="{{url('dashboard')}}" class="btn-home btn-menu btn-sq-lg btn-dashboard ">
                <img class="mr-1" src="{{ asset("image/01.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  แดชบอร์ด
                </a>
                </div>

                <div class=" m-1">
                <a href="{{route('document.index')}}" class="btn-home btn-menu btn-sq-lg btn-inbox  ">
                <img class="mr-1" src="{{ asset("image/02.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  เอกสาร
                </a>
                </div>

                <div class=" m-1">
                <a href="{{route('document.create')}}" class="btn-home btn-menu btn-sq-lg btn-create "> 
                <img class="mr-1" src="{{ asset("image/03.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  สร้างเอกสาร
                </a>
                </div>

                <div class=" m-1">
                {{-- @if( Auth::user()->role_id == 1 ) --}}
                <a href="{{route('cabinet.index')}}" class="btn-home btn-menu btn-sq-lg btn-cabinet  ">
                <img class="mr-1" src="{{ asset("image/04.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  ตู้เอกสาร
                </a>
                {{-- @endif --}}
                </div>

                <div class=" m-1">
                @if (auth()->user()->role_id == 1 )
                <a href="{{route('officer.index')}}" class="btn-home btn-menu btn-sq-lg btn-manage ">
                <img class="mr-1" src="{{ asset("image/05.png")}}" alt="" srcset="" width="60" height="70" ><br/>
                  จัดการบุคลากร
                </a>
                @endif
                </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="container col text-center py-3">
      <div class="pt-3">
     <label style="font-size: 20px; color:forestgreen; font-weight:bold"> <i class="far fa-user"></i>&nbsp; กำลังออนไลน์
		      <div class="col-12 pt-3">
			        <div class="card border-top-secondary">
				        <div class="card-body" style="min-width: 320px">
					        <div class="row mb-2">
						        <div class="col-12 p-2 text-center">
                      <label style="font-size: 20px; color: dodgerblue; font-weight:bold;">สถิติการใช้งาน </label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ผู้ใช้งานทั้งหมด : {!! $users !!} คน</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">เอกสารทั้งหมด : {!! $documents_count !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ดำเนินการแล้วเสร็จ :  {!! $documents_status3 !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">อยู่ระหว่างดำเนินการ : {!! $documents_status2 !!} ฉบับ</label></br>
                      <!-- <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ไม่อนุมัติ :  {!! $documents_status4 !!} ฉบับ</label></br> -->
                      <!-- <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">แบบร่าง :  {!! $documents_status1 !!} ฉบับ</label></br> -->
                    
  </div>
</div> 
@endsection 


@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.css">
    <link rel="stylesheet" href="{{ asset("css/home.css") }}">

@endpush
