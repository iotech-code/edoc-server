@extends('layouts.app')

@section('nav-top')
    @include('layouts.nav-top', ['active'=>0])
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col">
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
        <div class="col">
          <h2>แผนภูมิ ปริมาณแยกตามตู้</h2>
          <canvas id="chart1" ></canvas>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
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
                <tr>
                    <td width="360">{{$item->title}}</td>
                    <td>{{$item->status_text}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          
        </div>
        <div class="col">
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
            '#b64b10',
                '#829712',
                '#07ca46',
                '#07ca46',
                '#d922ea',
                '#ff79aa',
                '#271794',
                '#ae23f0',
                '#a50030',
                '#fa97ce',
                '#f05800',
                '#fa7b4d',
                '#1e3fff',
                '#da8f00'
              // 'rgba(153, 102, 255, 0.2)',
              // 'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            '#b64b10',
                '#829712',
                '#07ca46',
                '#07ca46',
                '#d922ea',
                '#ff79aa',
                '#271794',
                '#ae23f0',
                '#a50030',
                '#fa97ce',
                '#f05800',
                '#fa7b4d',
                '#1e3fff',
                '#da8f00'
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
            backgroundColor: [
                '#b64b10',
                '#829712',
                '#07ca46',
                '#07ca46',
                '#d922ea',
                '#ff79aa',
                '#271794',
                '#ae23f0',
                '#a50030',
                '#fa97ce',
                '#f05800',
                '#fa7b4d',
                '#1e3fff',
                '#da8f00'
                

                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
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