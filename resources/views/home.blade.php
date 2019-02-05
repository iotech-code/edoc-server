@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top')
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

<div class="container">
    <div class="row">
        <div class="col">
        <form >
            <div class="form-group">
                <label for="exampleInputEmail1">ค้นหาจากคำ</label>
                <div class="form-inline">
                    <input type="email" class="form-control mr-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    <button class="btn btn-primary">
                        ค้นหา
                    </button>
                </div>
            </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">ค้นหาจากวันที่เอกสาร</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                    {{-- <span class="input-group-text" id="basic-addon1">@</span> --}}
                                    <i class="fa fa-calendar"></i>

                            </button>
                        </div>
                        <input type="text" class="form-control date-select" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                    </div>
                </div>
            </div>
            <div class="col">
            <div class="form-group">
                <label for="exampleInputEmail1">ถึง</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                            <i class="fa fa-calendar"></i>                        
                        </button>
                    </div>
                    <input type="text" class="form-control date-select" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>

            </div>
        </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr class="bg-success">
                <th style="color: #fff">สถานะ</th>
                <th style="color: #fff">ตู้จัดเก็บเอกสาร</th>
                <th style="color: #fff">เลขที่เอกสาร</th>
                <th style="color: #fff">ชื่อเอกสาร</th>
                <th style="color: #fff">ที่มาเอกสาร</th>
                <th style="color: #fff">วันที่เอกสาร</th>
                <th style="color: #fff">จัดการเอกสาร</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>กำลังดำเนิน</td>
                <td>กำลังดำเนิน</td>
                <td>กำลังดำเนิน</td>
                <td>กำลังดำเนิน</td>
                <td>กำลังดำเนิน</td>
                <td>1 มกราคม 2561</td>
                <td>
                    <a href="#">
                        <i class="fa fa-external-link"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link " href="#">ก่อนหน้า</a></li>
            <li class="page-item active"><a class="page-link " href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
        </ul>
    </nav>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.th.min.js"></script>
@endpush
