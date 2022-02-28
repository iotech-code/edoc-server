@php
  $unreadDocuments = auth()->user()->unreadDocuments ;
@endphp

<div class="nav-wrapper">
    <div class="container py-3">
        <div class="row ">
            <div class="col">
              <div class="logo">
                <a href="{{ url('index') }}"><img class="mr-1" src="{{ asset("image/icon-logo2.png")}}" alt="" srcset="" ></a>
                {{-- <span>
                  Smart e-Document System
                </span> --}}
              </div>
            </div>
            <div class="col text-center ">

              <div class="dropdown float-right">
              
                {{-- <button class="btn btn-primary dropdown-toggle border-primary bg-white ml-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                  
                {{-- </button> --}}

                <a class=" dropdown-toggle bg-white " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="color-primary ">
                  <img class="mr-1" src="https://www.gravatar.com/avatar/{{ md5(\Auth::user()->email) }}" alt="" srcset="" width="35px" height="35px" >

                      {{-- สวัสดี อธิกร บดินทรา --}}
                    {{\Auth::user()->full_name}} 
                  </span> 
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                  <form id="formLogout" method="POST" action="{{route("logout")}}" style="cursor: pointer">
                    @csrf
                    {{-- <button class="dropdown-item" href="#">ออกจากระบบ</button> --}}
                  </form>
                  <a class="dropdown-item" href="{{ route("user.profile") }}"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลส่วนตัว</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#feedbackForm""><i class="fas fa-comment-alt"></i>&nbsp;&nbsp;&nbsp;ข้อเสนอแนะ</a>
                  <a class="dropdown-item" href="#" onclick="document.getElementById('formLogout').submit()"><i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;&nbsp;ออกจากระบบ</a>
                </div>
                
              </div>
              <div class="dropdown float-right mr-3">
                <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <i class="far fa-bell text-secondary fa-2x " ></i>
                  @if ($unreadDocuments->count() > 0)
                  <div class="badge badge-danger rounded " style="position:absolute;bottom:-0.25rem;right:-0.45rem;font-size:0.8em">
                    {{ $unreadDocuments->count() }}
                  </div>
                  @endif
                </a>
                @if ($unreadDocuments->count() > 0)
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    @foreach ($unreadDocuments as $item)
                      <a class="dropdown-item" href="{{ route('document.show', $item->id) }}">{{$item->title}}</a>
                    @endforeach
                  </div>
                @endif
                </div>  
            </div>
        </div>
    </div>    
</div>
