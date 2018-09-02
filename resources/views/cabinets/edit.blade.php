@extends('layouts.app')
@section('nav-top')
  @include('layouts.nav-top', ['active'=>3])
  {{ Breadcrumbs::render('cabinet.edit') }}

@endsection
@section('content')
  <div class="container">
    <form action="{{ route('cabinet.edit', $cabinet->id)}}" method="post">
      @csrf
      @method("PUT")
        <div class="row">
          <div class="col-md-7 offset-2">
              <h3 class="text-center">แก้ไขตู้เอกสาร</h3>
            <div class="card border-top-primary">
              
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-6">
                    <label for="">ชื่อตู้เอกสาร</label><span class="red-star"></span>
                  <input type="text" class="form-control" value="{{ $cabinet->name}}">
                  </div>
                  <div class="col-6">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="">คำอธิบาย ตู้เอกสาร</label>
                  <textarea name="" id="" cols="30" rows="5" class="form-control">{{$cabinet->description}}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-7 offset-2 ">

            <div class="button-group text-center">
              <a class="btn edoc-btn-primary inverse">ย้อนกลับ</a>
              <button class="btn edoc-btn-primary">สร้าง</button>
  
            </div>
          </div>
        </div>
    </form>

  </div>
@endsection