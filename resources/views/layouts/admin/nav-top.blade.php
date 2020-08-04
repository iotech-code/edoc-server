<div class="nav-wrapper">
  <div class="container">
      <div class="row mt-3 pb-3">
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
                  {{\Auth::guard('seller')->user()->full_name}}
                </span> 
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <form id="formLogout" method="POST" action="{{ url('/back-office/logout') }}" style="cursor: pointer">
                  @csrf
                  {{-- <button class="dropdown-item" href="#">ออกจากระบบ</button> --}}
                </form>
                <a class="dropdown-item" href="#" onclick="document.getElementById('formLogout').submit()">ออกจากระบบ</a>
              </div>
              
            </div>
          </div>
        </div>
     
  </div>    
</div>