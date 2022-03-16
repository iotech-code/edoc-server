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
                <div class="col-12 text-left mb-3">
              @if ( count($line) == 0 )
                <a href="https://notify-bot.line.me/oauth/authorize?response_type=code&client_id={{env('LINE_CLIENT_ID')}}&redirect_uri={{url('line_callback')}}&scope=notify&state={{env('LINE_SECRET')}}" id="linebutton" class="text-success btn btn-light btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                  width="22" height="22"
                  viewBox="0 0 48 48"
                  style=" fill:#000000;"><path fill="#00c300" d="M12.5,42h23c3.59,0,6.5-2.91,6.5-6.5v-23C42,8.91,39.09,6,35.5,6h-23C8.91,6,6,8.91,6,12.5v23C6,39.09,8.91,42,12.5,42z"></path><path fill="#fff" d="M37.113,22.417c0-5.865-5.88-10.637-13.107-10.637s-13.108,4.772-13.108,10.637c0,5.258,4.663,9.662,10.962,10.495c0.427,0.092,1.008,0.282,1.155,0.646c0.132,0.331,0.086,0.85,0.042,1.185c0,0-0.153,0.925-0.187,1.122c-0.057,0.331-0.263,1.296,1.135,0.707c1.399-0.589,7.548-4.445,10.298-7.611h-0.001C36.203,26.879,37.113,24.764,37.113,22.417z M18.875,25.907h-2.604c-0.379,0-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687c0.379,0,0.687,0.308,0.687,0.687v4.521h1.917c0.379,0,0.687,0.308,0.687,0.687C19.562,25.598,19.254,25.907,18.875,25.907z M21.568,25.219c0,0.379-0.308,0.688-0.687,0.688s-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687s0.687,0.308,0.687,0.687V25.219z M27.838,25.219c0,0.297-0.188,0.559-0.47,0.652c-0.071,0.024-0.145,0.036-0.218,0.036c-0.215,0-0.42-0.103-0.549-0.275l-2.669-3.635v3.222c0,0.379-0.308,0.688-0.688,0.688c-0.379,0-0.688-0.308-0.688-0.688V20.01c0-0.296,0.189-0.558,0.47-0.652c0.071-0.024,0.144-0.035,0.218-0.035c0.214,0,0.42,0.103,0.549,0.275l2.67,3.635V20.01c0-0.379,0.309-0.687,0.688-0.687c0.379,0,0.687,0.308,0.687,0.687V25.219z M32.052,21.927c0.379,0,0.688,0.308,0.688,0.688c0,0.379-0.308,0.687-0.688,0.687h-1.917v1.23h1.917c0.379,0,0.688,0.308,0.688,0.687c0,0.379-0.309,0.688-0.688,0.688h-2.604c-0.378,0-0.687-0.308-0.687-0.688v-2.603c0-0.001,0-0.001,0-0.001c0,0,0-0.001,0-0.001v-2.601c0-0.001,0-0.001,0-0.002c0-0.379,0.308-0.687,0.687-0.687h2.604c0.379,0,0.688,0.308,0.688,0.687s-0.308,0.687-0.688,0.687h-1.917v1.23H32.052z"></path></svg> 
                  รับการแจ้งเตือนผ่าน LINE
                </a>
                <p class="text-secondary mt-3">LINE Notify คือ บริการที่ใช้สำหรับรับการแจ้งเตือนจากบัญชีทางการที่ให้บริการโดย LINE ที่ชื่อ "LINE Notify" เมื่อเชื่อมต่อเว็บเซอร์วิชต่างๆ </p>
              @else
                <h5>
                  <span class="badge badge-light">
                    <i class="fa fa-bell"></i> คุณจะได้รับการแจ้งเตือนไปยัง LINE
                  </span>
                  <a href="{{url('line_unset')}}" class="badge badge-secondary">
                    <i class="fa fa-times"></i> ยกเลิก
                  </a>
                </h5>
                <p class="text-secondary">หลังเสร็จสิ้นการเชื่อมต่อกับเว็บเซอร์วิสแล้ว คุณจะได้รับการแจ้งเตือนจากบัญชีทางการ "LINE Notify" ซึ่งให้บริการโดย LINE
คุณสามารถเชื่อมต่อกับบริการที่หลากหลาย และรับการแจ้งเตือนทางกลุ่มได้ด้วย อย่าลืมเพิ่มบัญชี Line Notify เป็นเพื่อนนะ <a target="_blank" href="https://help2.line.me/line_notify/web/pc?lang=th&contentId=20003054">ดูเพิ่มเติม</a></p>
              @endif
              </div>
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

                <div class=" m-1">
                <a href="{{url('editor')}}" class="btn-home btn-menu btn-sq-lg btn-onlinedoc">
                  <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="70" height="70"><path fill="#90CAF9" d="M40 45L8 45 8 3 30 3 40 13z"/><path fill="#E1F5FE" d="M38.5 14L29 14 29 4.5z"/><path fill="#1976D2" d="M16 21H33V23H16zM16 25H29V27H16zM16 29H33V31H16zM16 33H29V35H16z"/></svg>
                  <p>เอกสารออนไลน์</p>
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
						        <div class="col-12 pl-5">
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
