@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top',['active'=>5])
@endsection

@section('content')
  <div class="container">
    <div class="text-right mb-3">
      <div class="col-8 offset-2">
        <a href="" class="btn btn-primary " data-toggle="modal" data-target="#createModal">
          <i class="fa fa-plus"></i>
          เพิ่มรายชื่อ
        </a>
        <a id="importFile" href="{{route('officer.create' )}}" class="btn btn-primary ">
          <i class="fa fa-plus"></i>
          นำเข้ารายชื่อจากไฟล์
        </a>
        <a id="importFile" href="{{ url('/officer/download/template')}}" class="btn btn-primary ">
          <i class="fa fa-plus"></i>
          ไฟล์ตัวอย่าง
        </a>
        <form action="{{ route("officer.import")}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="file" name="import_file" accept=".csv" id="" style="display:none"/>
        </form>
      </div>
  
    </div>
    <div class="row">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-body p-0 border-top-primary">
            <table class="table table-striped">
              <thead>
                <tr>

                  <th class="">ID</th>
                  <th class="w-75">ชื่อ นามสกุล</th>
                  <th class="w-75">ตำแหน่ง</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($officers as $officer)
                <tr class="">
                  <td class="">
                    {{ $officer->user_id}}
                  </td>
                  <td class="">
                    {{ $officer->full_name}}
                  </td>
                  <td class="">
                      {{ __('role.'.$officer->role->name)}}
                  </td>

                </tr>
                    
                @endforeach
              </tbody>
            </table>
          </div>
    
        </div>

      </div>
    </div>
  </div>

  <div class="modal" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3>

            สร้างชื่อผู้ใช้ใหม่
          </h3>
        </div>
        <div class="modal-body">
          <form action="{{ route("officer.store") }}" method="post">
            @csrf
            <div class="form-group">
              <label for="">เลขบัตรประชาชน</label>
              <input class="form-control" type="text" name="user_id" required>
            </div>

            <div class="form-group">
              <label for="">ชื่อ</label>
              <input class="form-control" type="text" name="first_name" required>
            </div>
          
            <div class="form-group">
              <label for="">นามสกุล</label>
              <input class="form-control" type="text" name="last_name" required>
            </div>
            <input type="hidden" name="school_id" value="{{ Auth::user()->school_id }}">
          
            <div class="form-group">
              <label for="">อีเมล</label>
              <input class="form-control" type="text" name="email" required>
            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button class="btn btn-primary" type="submit">บันทึก</button>
          
          </form>
        </div>
      </div>
    </div>
  </div>  
@endsection 

@section("script")
<script>
$("#importFile").click(function(e){
  e.preventDefault();
  $('input[name="import_file"]').trigger("click");
});

$('input[name="import_file"]').on("change", function(){
  $(this).parent().submit();
});
</script>
@endsection