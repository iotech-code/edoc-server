@extends('layouts.app')
@section('nav-top')
  @include('layouts.nav-top', ['active'=>3])

@endsection
@section('content')
  <div class="container">
    <form action="{{ route('cabinet.folder.update', $folder->id)}}" method="post">
      @csrf
      @method("PUT")
        <div class="row">
          <div class="col-md-7 offset-2">
              <h3 class="text-center">แก้ไขแฟ้ม</h3>
            <div class="card border-top-primary">
              
              <div class="card-body">
                <div class="form-group row">
                    <div class="col-6">
                        <label for="">ชื่อแฟ้ม</label><span class="red-star"></span>
                        <input type="text" class="form-control" name="name" value="{{ $folder->name }}">
                        <small></small>
                    </div>
                    <div class="col-6">
    
                    </div>
    
                </div>
                <div class="form-group">
                    <label for="">คำอธิบาย แฟ้มเอกสาร</label>
                  <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $folder->description }}</textarea>
    
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-7 offset-2 ">

            <div class="button-group text-center">
              <a class="btn edoc-btn-primary inverse">ย้อนกลับ</a>
              <button class="btn edoc-btn-primary">บันทึก</button>
  
            </div>
          </div>
        </div>
    </form>

  </div>
@endsection