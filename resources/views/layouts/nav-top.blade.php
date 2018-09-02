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
              <div class="dropdown float-right ">
                <button class="btn btn-primary dropdown-toggle border-primary bg-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="color-primary">
                      {{-- สวัสดี อธิกร บดินทรา --}}
                    {{\Auth::user()->full_name}}
                  </span> 
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <form method="POST" action="{{route("logout")}}">
                    @csrf
                    <button class="dropdown-item" href="#">ออกจากระบบ</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a alt="Dashboard" class="edoc-nav-link @if(isset($active) && $active==0) active @endif"  href="{{ route('document.index') }}">
                  แดชบอร์ด
                </a>        
            </li>
            <li class="nav-item">
                <a alt="ค้นหาเอกสาร" class="edoc-nav-link @if(!isset($active) || $active==1) active @endif"  href="{{ route('document.index') }}">
                  ค้นหาเอกสาร
                </a>        
            </li>
            <li class="nav-item">
                <a alt="เพิ่มเอกสาร" class="edoc-nav-link  @if(isset($active) && $active==2) active @endif"  href="{{ route('document.create') }}">
                    เพิ่มเอกสาร
                  </a>
            </li>
            <li class="nav-item">
                <a class="edoc-nav-link  @if(isset($active) && $active==3) active @endif"  href="{{route("cabinet.index")}}">
                  ตู้เอกสาร
                </a>
            </li>
            <li>
                <a  class="edoc-nav-link  @if(isset($active) && $active==4) active @endif"  href="{{route("user.profile")}}">
                    ข้อมูลส่วนตัว
                </a>
            </li>
          </ul>
    </div>    
</div>