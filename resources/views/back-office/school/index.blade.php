@extends('layouts.app')

@section('nav-top')
  @include('layouts.admin.nav-top')
  {{-- {{ Breadcrumbs::render('school.index') }} --}}
  
@endsection

@section('content')
<div class="container">
	@isset($errors)
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $key => $error)
							<li>{{ __("$error") }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	@endisset
  <div class="row text-right mb-3">
    <div class="col-8 offset-2">
      {{-- <a href="{{route('back-office.school.create')}}" class="btn edoc-btn-primary "> --}}
      <a href="#" class="btn edoc-btn-primary" data-toggle="modal" data-target="#createForm">
        <i class="fa fa-plus"></i>
        สร้างโรงเรียน
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-8 offset-2">
      <div class="card">
        <div class="card-body p-0 border-top-primary">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="">รหัสโรงเรียน</th>
                <th class="">ชื่อโรงเรียน</th>
                {{-- <th>จัดการ</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($schools as $school)
              <tr class="">
                <td> {{ $school->code}} </td>
                <td class="">
                  {{$school->name}} 
                </td>
                {{-- <td class=""></td> --}}
              </tr>
                  
              @endforeach
            </tbody>
          </table>
        </div>
  
      </div>

    </div>
  </div>
  <div class="row mt-3" style="color: #515151; font-weight: bold">
    <div class="col-8 offset-2">
      {{ $schools->links() }}
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createForm" tabindex="-1" role="dialog" aria-labelledby="createFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createFormLabel">สร้างโรงเรียนใหม่</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('back-office.school.store') }}" method="POST">
          @csrf
          <div class="modal-body"> 
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">รหัสโรงเรียน</label>
              <input type="text" class="form-control" id="" name="code">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">key</label>
              <input type="text" class="form-control" id="" name="key">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">ชื่อโรงเรียน</label>
              <input type="text" class="form-control" id="recipient-name" name="name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@include('alert.alert')

@endsection 

@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush