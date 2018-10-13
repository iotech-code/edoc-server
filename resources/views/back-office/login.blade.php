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
    @stack('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    @stack('css')
</head>
<body>
  <div class="container">
    <div class="row" style="margin-top: 8em">
      <div class="col-lg-8 col-md-12 offset-lg-2">
        @include('errors.validate')

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <h3>System Login</h3>
                <form action="{{route('back-office.login.post')}}" method="post">
                  @csrf
                  <input name="user_id" type="text" class="form-control mt-3" placeholder="User">
                  <input name="password" type="password" class="form-control mt-3" placeholder="Password">
                  <button class="btn btn-primary rounded mt-3">Login</button>
                </form>
              </div>
              <div class="col-8">
                {{-- <div class="image">
                  <img src="https://via.placeholder.com/800x600" alt="">
                </div> --}}
                <div class="text" style="">
                    <h3>Smart e-Document System</h3>
                    <p>ส่วนจัดการระบบ</p>
                </div>
              </div>
            </div>
    
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<style>
.text {
  padding-top: 36px;
  font-weight: bold;
  text-align: center;
  vertical-align: middle;
  color: #fff;
  display: block;
  width: 100%; 
  height:100%;
  position: relative; 
  background-image : url('{{ asset("image/bobg.gif")}}'); 
  background-size: cover
}
</style>
</html>

