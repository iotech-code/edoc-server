@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top', ['active'=>2])
@endsection

@section('content')
<div class="container">
	  {{-- <div class="alert alert-danger alert-dismissible" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Danger!</strong> You should <a href="#" class="alert-link">read this message</a>.
			<ul>
			
				<li> list </li>
			</ul>
	
		</div> --}}
  <h3>
    รายละเอียดเอกสาร
  </h3>
  <form class="" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="card border-top-primary mb-5">
      <div class="card-body">
          <div class="form-row">
            <div class="form-group col-3">
                <label for="">ตู้จัดเก็บเอกสาร</label>
                <select class="form-control" name="cabinet_id" id="exampleFormControlSelect1">
									@foreach (App\Models\Cabinet::all() as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
						</div>
            <div class="form-group col">
                <label for="">จาก</label>
                <input type="text" name="from" class="form-control" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
                <label for="">เลขที่</label>
                <input type="text" name="code" class="form-control">
            </div>
            <div class="form-group col">
                <label for="">วันที่</label>
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                    <input type="text" name="date" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
            <div class="form-group col">
                <label for="">อ้างถึง</label>
                <input type="text" name="refer" class="form-control">
            </div>
          </div>
          {{-- <div class="form-row"> --}}

          <div class="form-row">
            <div class="form-group col">
              <label for="">เรื่อง *</label>
              <input type="text" name="title" required class="form-control">
            </div>

          </div>
          {{-- </div> --}}
          {{-- <div class="form-row"> --}}
            <div class="form-row">
              <div class="col">
                <label for="">คำสำคัญ</label>
              </div>
            </div>
            <div class="form-row">

              <div class="form-group col">
                  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
              </div>
              <div class="form-group col">
                  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
              </div>
              <div class="form-group col">
                  <input type="text" name="keywords[]" class="form-control" placeholder="คำสำคัญ">
              </div>
            </div>
          {{-- </div>      --}}
          <div class="form-row">
            <div class="form-group col">
                <label for="">เลขที่รับ</label>
                <input type="text" name="receive_code" class="form-control">
            </div>
            <div class="form-group col">
                <label for="">วันที่รับ</label>
                <div class="input-group ">
                    <div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-calendar"></i>
												</span>
                    </div>
                    <input name="receive_date" type="text" class="form-control date-select" placeholder="" autocomplete="off" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
            <div class="form-group col">
                <label for="">ที่เก็บต้นฉบับ</label>
                <input type="text" name="receive_achives" class="form-control">
            </div>
          </div>     

      </div>

    </div>
  </div>
  <h3>ไฟล์แนบ</h3>
  <div class="row">
    <div class="card border-top-primary">
      <div class="card-body" style="min-width: 320px">
          <div class="row mb-2">
            <div class="col-12">
							<div id="fileGroup">
								<div class="row mb-3" id="file1">
									<div class="col" >
										<input type="file" name="files[]">
										<button type="button" class="btn btn-danger btn-sm rounded-circle btn-remove-file" data-file="1">
											<i class="fa fa-times"></i>
										</button>
									</div>
								</div>
							</div>
            </div>   

          </div>
          <div class="row">
            <div class="col-12">
              <button id="addFile" type="button" class="btn btn-success rounded-circle">
								<i class="fa fa-plus"></i>
							</button>
            </div>   
          </div>
      </div>
    </div>
  </div>
  @csrf
  <button class="btn btn-primary mx-auto" style="display:block" type="submit">ตกลง</button>
  </form>

</div>

@endsection

@section('script')
	<script src="{{asset('js/document/create.js')}}"></script>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
@endpush