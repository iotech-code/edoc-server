@extends('layouts.app')

@section('nav-top')
  @include('layouts.nav-top', ['active'=>0])
  {{-- {{ Breadcrumbs::render('cabinet.index') }} --}}
  
@endsection
@php
  $unreadDocuments = auth()->user()->unreadDocuments ;
@endphp
@section('content')
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-7 ">
        <div class="card border-top-primary ">
            <div class="card-body ">
                <div class="form-row ">
                <!-- <div  class="row table-tab text-center">

                <div class="col t-all item ">
                    {{-- <span class="mdi mdi-inbox"></span> --}}
                    <a href="{{ url('index') }}" class="tab-box" data-tab="all">
                    <img class="" src="{{ asset("image/doc-all.png")}}" alt="" srcset="" >
                      <span class="header">
                        หน้าแรก
                      </span>
                    </a>
                </div>
                <div class="col t-inbox item ">
                  <a href="#" class="tab-box" data-tab="inbox">
                  <img class="" src="{{ asset("image/doc-inbox.png")}}" alt="" srcset="" >
                    {{-- <span class="mdi mdi-inbox-arrow-down"></span> --}}
                    <span class="header" >
                      ทะเบียนเอกสารส่ง
                    </span>
                  </a>
                </div>
                <div class="col t-sentbox item ">
                  <a href="#" class="tab-box" data-tab="sent">
                  <img class="" src="{{ asset("image/doc-outbox.png")}}" alt="" srcset="" >
                    <span class="header"> 
                      ทะเบียนเอกสารรับ
                    </span>
                  </a>
                </div>
             </div> -->
            <div class=" row py-1">
                <div class=" m-1">
                <a href="{{route('document.index')}}" class="btn-home btn-menu btn-sq-lg btn-dashboard ">
                <img class="mr-1" src="{{ asset("image/02.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  เอกสาร
                </a>
                </div>

                @if (auth()->user()->role_id == 1)
                <div class=" m-1">
                <a href="{{route('receive')}}" class="btn-home btn-menu btn-sq-lg btn-receive  ">
                <img class="mr-1" src="{{ asset("image/06.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                ลงทะเบียนรับ
                </a>
                </div>
                @endif

                <div class=" m-1">
                <a href="{{route('document.create')}}" class="btn-home btn-menu btn-sq-lg btn-inbox ">
                <img class="" src="{{ asset("image/03.png")}}" alt="" srcset="" width="70" height="70" >
                  <br/>
                  สร้างเอกสาร
                </a>
                </div>

                {{-- @if( Auth::user()->role_id == 1 ) --}}
                <div class=" m-1">
                <a href="{{route('cabinet.index')}}" class="btn-home btn-menu btn-sq-lg btn-create "> 
                <img class="mr-1" src="{{ asset("image/04.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  ตู้เอกสาร
                </a>
                </div>
                {{-- @endif --}}


                @if (auth()->user()->role_id == 1 )
                <div class=" m-1">
                <a href="{{route('officer.index')}}" class="btn-home btn-menu btn-sq-lg btn-manage ">
                <img class="mr-1" src="{{ asset("image/05.png")}}" alt="" srcset="" width="60" height="70" ><br/>
                  จัดการบุคลากร
                </a>
                </div> 
                @endif

                <div class=" m-1">
                <a href="{{url('dashboard')}}" class="btn-home btn-menu btn-sq-lg btn-cabinet">
                <img class="mr-1" src="{{ asset("image/01.png")}}" alt="" srcset="" width="70" height="70" ><br/>
                  แดชบอร์ด
                </a>
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
                    @if (auth()->user()->role_id == 1 )
                      <label style="font-size: 20px; color: dodgerblue; font-weight:bold;">สถิติการใช้งาน </label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ผู้ใช้งานทั้งหมด : {!! $users !!} คน</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">เอกสารทั้งหมด : {!! $documents_count_admin !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ดำเนินการแล้วเสร็จ :  {!! $documents_status3_admin !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">อยู่ระหว่างดำเนินการ : {!! $documents_status2_admin !!} ฉบับ</label></br>
                      <!-- <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">(ไม่อนุมัติ :  {!! $documents_status4_admin !!} ฉบับ / แบบร่าง :  {!! $documents_status1_admin !!} ฉบับ)</label></br> -->
                      @endif
                      @if (auth()->user()->role_id == 2 )
                      <label style="font-size: 20px; color: dodgerblue; font-weight:bold;">สถิติการใช้งาน </label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ผู้ใช้งานทั้งหมด : {!! $users !!} คน</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">เอกสารทั้งหมด : {!! $documents_count !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">ดำเนินการแล้วเสร็จ :  {!! $documents_status3 !!} ฉบับ</label></br>
                      <label style="font-size: 18px; color:darkslategrey; font-weight:bold;">อยู่ระหว่างดำเนินการ : {!! $documents_status2 !!} ฉบับ</label></br>
                      @endif    
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
    <link rel="stylesheet" href="{{ asset("css/home.css") }}">

@endpush
