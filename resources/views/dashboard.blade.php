@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top', ['active'=>0])
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <h2>ปริมาณแยกตามตู้</h2>

            <table>
                <thead>
                    <tr>
                        <th width="360">ตูเอกสาร</th>
                        <th>จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($local_cabinets_object as $item)
                        <tr>
                          <td>{{$item->name}}</td>
                          <td>{{ $item->documents_count }} ฉบับ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
          <h2>แผนภูมิ ปริมาณแยกตามตู้</h2>
          <canvas id="chart1" ></canvas>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h2>เอกสารล่าสุด</h2>
            <table>
              <thead>
                <tr>
                  <th>ชื่อเอกสาร</th>
                  <th>สถานะเอกสาร</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($documents as $item)
                <tr class="mb-1">
                    <td width="360">{{$item->title}}</td>
                    <td>{{$item->status_text}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h2>แผนภูมิ ปริมาณแยกตามประเภท</h2>

            <canvas id="chart2" ></canvas>

        </div>
      </div>
    </div>
<style>
canvas {
  /* width: 300px !important;
  height: 300px !important; */
}
</style>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

@endpush

@section('script')
<script>
    // chart1 = document.getElementById("chart1")

    data1= {
        // labels: ["วิชาการ", "การเงิน", "ธุรการ", "ปกครอง"],
        labels: {!! $local_cabinets->pluck(['name']) !!},
        datasets: [{
          label: '# ปริมาณเอกสาร แยกตามตู้',
        //   data: [12, 19, 3, 5],
        data: {!! $local_cabinets_count !!},
          backgroundColor: [
            '#0f6dab', //สีน้ำเงิน
                '#70a253', //สีเขียวเข้ม
                '#08e9f7', //สีฟ้า
                '#fbeb58', //สีทอง
                '#760d80', //สีม่วง
                '#ff79aa', //สีชมพูอ่อน
                '#1d2873', //สีกรม
                '#2e6361', //สีเขียวแก่
                '#9cffb7', //สีเขียวอ่อน
                '#fb58c4', //สีชมพู
                '#fb58c4', //สีส้ม
                '#636cf5', //สีม่วงเข้ม
                '#816ed9', //สีม่วงอ่อน
                '#c460a0' //สีน้ำตาลทอง
          ],
          //backgroundColor: ["#0f6dab","#12977c","#874a14","#0f6dab","#0f6dab"],
          borderColor: [
                '#0f6dab', //สีน้ำเงิน
                '#70a253', //สีเขียวเข้ม
                '#08e9f7', //สีฟ้า
                '#fbeb58', //สีทอง
                '#760d80', //สีม่วง
                '#ff79aa', //สีชมพูอ่อน
                '#1d2873', //สีกรม
                '#2e6361', //สีเขียวแก่
                '#9cffb7', //สีเขียวอ่อน
                '#fb58c4', //สีชมพู
                '#fb58c4', //สีส้ม
                '#636cf5', //สีม่วงเข้ม
                '#816ed9', //สีม่วงอ่อน
                '#c460a0' //สีน้ำตาลทอง
              // 'rgba(153, 102, 255, 1)',
              // 'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
    },
    data2= {
        // labels: ["วิชาการ", "การเงิน", "ธุรการ", "ปกครอง"],
        labels: {!! $document_type_list !!},
        datasets: [{
            label: '# ปริมาณเอกสาร แยกตามตู้',
        //   data: [12, 19, 3, 5],
            data: {!! $document_type_count !!},
            backgroundColor: ["#78a8fb", "#acdfef", "#72d3bd", "#f86a74", "#edadc4", "#ae98c9", "#c7b9f8", "#a6e47d", "#ffeb96", "#e8bf98", "#ac9e9b", "#fcbb84","#bfbfbf"],
            //   borderColor: [
        //       'rgba(255,99,132,1)',
        //       'rgba(54, 162, 235, 1)',
        //       'rgba(255, 206, 86, 1)',
        //       'rgba(75, 192, 192, 1)',
        //       // 'rgba(153, 102, 255, 1)',
        //       // 'rgba(255, 159, 64, 1)'
        //   ],
          borderWidth: 1
      }]
    },
    options1= {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }

    options2= {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    var chart1 = new Chart("chart1", {
          type: 'bar',
          data: data1,
          options: options1
      });
    var chart2 = new Chart("chart2", {
        type: 'pie',
        data: data2,
        // options: options1
    });
</script>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.css">
    <link rel="stylesheet" href="{{ asset("css/document/index.css") }}">

@endpush