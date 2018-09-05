@extends('layouts.app')

@section('nav-top')
	@include('layouts.nav-top', ['active'=>4])
@endsection

@section('content')
    <div class="container">
			@include("errors.validate")
			<h3 class="text-center mt-2 mb-2">
			ข้อมูลส่วนตัว
			</h3>
			<div class="row">
				<div class="col-8 offset-2">
					<form action="" method="post">
						@csrf
						@method("PUT")
						<div class="card border-top-primary">
							<div class="card-body">
									<div class="form-group row">
										<div class="col">
											<label for="">ชื่อ</label>
										<input type="text" class="form-control" name="first_name" value="{{ $user->first_name}}">
										</div>
										<div class="col">
											<label for="">นามสกุล</label>
											<input type="text" class="form-control" name="last_name" value="{{ $user->last_name}}">
										</div>
									</div>
									<div class="form-group">
										<label for="">รหัสผ่านปัจจุบัน</label><input type="password" name="old_password" class="form-control">
									</div>
									<div class="form-group">
										<label for="">รหัสผ่านใหม่</label><input type="password" name="new_password" class="form-control">
									</div>
									<div class="form-group">
										<label for="">ยืนยันรหัสผ่านใหม่</label><input type="password" name="new_password_confirmation" class="form-control">
									</div>
							</div>
						</div>
						<div class=" mt-3 text-center">
							<button class="btn edoc-btn-primary" type="submit">
								บันทึกข้อมูล
							</button>

						</div>
					</form>
				</div>
			</div>
		</div>
@endsection