<div class="nav-wrapper">
    <div class="container">
        <div class="row mt-3">
            <div class="col">
              <div class="logo">
                <img class="mr-1" src="https://picsum.photos/30/30" alt="" srcset="">
                <span>
                  Smart e-Document System
                </span>
              </div>
            </div>
            <div class="col">
              <div class="dropdown float-right ">
                <button class="btn btn-primary dropdown-toggle border-primary bg-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="color-primary">
                      สวัสดี อธิกร บดินทรา
                  </span> 
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">ออกจากระบบ</a>
                </div>
              </div>
            </div>
          </div>
        <ul class="nav justify-content-center">
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
                <a class="edoc-nav-link  @if(isset($active) && $active==3) active @endif"  href="">
                    ตู้เอกสาร
                  </a>
            </li>
            <li>
                <a  class="edoc-nav-link  @if(isset($active) && $active==4) active @endif"  href="">
                    ข้อมูลส่วนตัว
                </a>
            </li>
          </ul>
    </div>    
</div>
