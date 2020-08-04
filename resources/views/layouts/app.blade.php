<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart e-dcoumet System') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}
    

    @stack('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    @stack('css')
</head>
<body>
    <div id="app">
        @yield('nav-top')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('script')
    @if ( auth()->check() )
    <div class="modal" tabindex="-1" role="dialog" id="feedbackForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ข้อเสนอแนะ / คำแนะนำ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fededbackMessage">ข้อความ</label>
                    <textarea class="form-control" id="feedbackMessage" name="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnFeedback" onclick="submit()" type="button" class="btn btn-primary">ส่ง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
            </div>
        </div>
    </div>
          
    <script>
        function submit() {
            $("#btnFeedback").prop('disabled', true);
            let data = {
                _token: "{{csrf_token()}}",
                msg: $('#feedbackMessage').val()
                }
            console.log(data);
            $.ajax({
                method: "POST",
                url: "{{url('ajax/feedback')}}", 
                data: data,
                dataType: "json"
            })
            .then(function() {
                // console.log("test");
                $('#feedbackMessage').val("")
                $('#feedbackForm').modal('hide')
                swal("ทำรายการสำเร็จ", "ขอบคุณสำหรับความคิดเห็น", "success");
                
            })
        }
 
    </script>
    @endif
</body>
</html>
