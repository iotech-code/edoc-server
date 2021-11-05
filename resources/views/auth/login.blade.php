@extends('layouts.app')

@section('content')
<div class="container" >

    <div class="row justify-content-center " style="margin-top: 100px">
        <!-- <div class="col-md-8"> -->
        <div class="card p-3 mb-3 ">
                <div class="card-login p-3">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-5 col-md-0 col-sm-0">
                            <img class="book-stack" src="{{asset('image/login-pic.png')}}" alt="">
                        </div> -->
                        <div class="col-lg-15 text-center" >
                                <h2 class="color-primary-login">Smart</h2>
                                <h3 class="color-primary-login">e-Document System</h3>
                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    @csrf
            
                                    <div class="form-group row" style="margin-top: 20px">
                                        {{-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}
                                        <label for="user_id" class="col-12 col-form-label text-md-left">เลขบัตรประชาชน</label>
            
                                        <div class="col-12">
                                            <input placeholder="กรอกรหัสบัตรประชาชน" id="user_id" type="text" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ old('user_id') }}" required autofocus>
            
                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
                                        <label for="password" class="col-12 col-form-label text-md-left">รหัสผ่าน</label>
            
                                        <div class="col-12">
                                            <input placeholder="รหัสผ่าน" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{-- {{ __('Remember Me') }} --}}
                                                    จดจำผู้ใช้
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('auth.Login') }}
                                                {{-- เข้าสู่ระบบ                                     --}}
                                            </button>
            
                                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a> --}}
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('.ui.search').({
        source: content
    });
    var content = [
  { title: 'Andorra' },
  { title: 'United Arab Emirates' },
  { title: 'Afghanistan' },
  { title: 'Antigua' },
  { title: 'Anguilla' },
  { title: 'Albania' },
  { title: 'Armenia' },
  { title: 'Netherlands Antilles' },
  { title: 'Angola' },
  { title: 'Argentina' },
  { title: 'American Samoa' },
  { title: 'Austria' },
  { title: 'Australia' },
  { title: 'Aruba' },
  { title: 'Aland Islands' },
  { title: 'Azerbaijan' },
  { title: 'Bosnia' },
  { title: 'Barbados' },
  { title: 'Bangladesh' },
  { title: 'Belgium' },
  { title: 'Burkina Faso' },
  { title: 'Bulgaria' },
  { title: 'Bahrain' },
  { title: 'Burundi' }
  // etc
];
</script>
@endpush

@push('js')
    <script src="{{asset('js/login.js')}}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">    
@endpush