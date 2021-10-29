@php
  $unreadDocuments = auth()->user()->unreadDocuments ;
@endphp

<div class="nav-wrapper">
    <div class="container">
        <div class="row mt-3">
            <div class="col">
              <div class="logo">
                <img class="mr-1" src="{{ asset("image/icon-logo.png")}}" alt="" srcset="">
                {{-- <span>
                  Smart e-Document System
                </span> --}}
              </div>
            </div>
            <div class="col">

              <div class="dropdown float-right">

                {{-- <button class="btn btn-primary dropdown-toggle border-primary bg-white ml-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                  
                {{-- </button> --}}

                <button class="btn btn-primary dropdown-toggle border-primary bg-white ml-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="color-primary">
                      {{-- สวัสดี อธิกร บดินทรา --}}
                    {{\Auth::user()->full_name}}
                  </span> 
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                  <form id="formLogout" method="POST" action="{{route("logout")}}" style="cursor: pointer">
                    @csrf
                    {{-- <button class="dropdown-item" href="#">ออกจากระบบ</button> --}}
                  </form>
                  <a class="dropdown-item" href="{{ route("user.profile") }}"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลส่วนตัว</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#feedbackForm""><i class="fas fa-comment-alt"></i>&nbsp;&nbsp;&nbsp;ข้อเสนอแนะ</a>
                  <a class="dropdown-item" href="#" onclick="document.getElementById('formLogout').submit()"><i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;&nbsp;ออกจากระบบ</a>
                </div>
                
              </div>
              <div class="dropdown float-right mt-2">
                <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <i class="fas fa-bell text-secondary" style="font-size:1.5em;"></i>
                  @if ($unreadDocuments->count() > 0)
                  <div class="badge badge-danger rounded" style="position:absolute;bottom:-0.25rem;right:-0.45rem;font-size:0.8em">
                    {{ $unreadDocuments->count() }}
                  </div>
                  @endif
                </a>
                @if ($unreadDocuments->count() > 0)
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($unreadDocuments as $item)
                      <a class="dropdown-item" href="{{ route('document.show', $item->id) }}">{{$item->title}}</a>
                    @endforeach
                  </div>
                @endif

  
              </div>
            </div>
          </div>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a alt="Dashboard" class="edoc-nav-link @if(isset($active) && $active==0) active @endif"  href="{{ url('dashboard') }}">
                <i class="fas fa-chart-line"></i>&nbsp; 
                  แดชบอร์ด
                </a>        
            </li>
            <li class="nav-item">
                <a alt="ค้นหาเอกสาร" class="edoc-nav-link @if(!isset($active) || $active==1) active @endif"  href="{{ route('document.index') }}">
                <i class="fas fa-envelope"></i>&nbsp;
                  เอกสาร
                </a>        
            </li>
            <li class="nav-item">
                <a alt="เพิ่มเอกสาร" class="edoc-nav-link  @if(isset($active) && $active==2) active @endif"  href="{{ route('document.create') }}">
                <i class="fas fa-paper-plane"></i>&nbsp; 
                เพิ่มเอกสาร
                  </a>
            </li>
            {{-- @if( Auth::user()->role_id == 1 ) --}}
            <li class="nav-item">
                <a class="edoc-nav-link  @if(isset($active) && $active==3) active @endif"  href="{{route("cabinet.index")}}">
                <i class="fas fa-archive"></i>&nbsp;
                  ตู้เอกสาร
                </a>
            </li>
            {{-- @endif --}}
            {{-- <li>
                <a  class="edoc-nav-link  @if(isset($active) && $active==4) active @endif"  href="{{route("user.profile")}}">
                    ข้อมูลส่วนตัว
                </a>
            </li> --}}
            @if (auth()->user()->role_id == 1 )
              <li>
                  <a  class="edoc-nav-link  @if(isset($active) && $active==5) active @endif"  href="{{route("officer.index")}}">
                  <i class="fas fa-user-cog"></i>&nbsp;
                      จัดการบุคลากร
                  </a>
              </li>
            @endif
          </ul>
    </div>    
</div>