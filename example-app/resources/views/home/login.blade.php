@extends('layouts.app')

@section('content')

{{-- <div class="MyContainer">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Увійти') }}</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('login.postSigin') }}">
                        @csrf
                        <div class="row mb-3">
                            
                              @if($errors->has('email'))
                                  <strong>{{ $errors->first('email') }}</strong>
                               @endif

                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Пошта') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запам\'ятати мене') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Увійти') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Забули пароль?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

 <div class="form-container">

    <form action="{{ route('login.postSigin')}}" method="post">
        {{ csrf_field() }}
        <label>
            <h2><b>Вхід</b></h2>
        </label>
                @if($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
                @endif
        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Електронна пошта" autocomplete="email" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror  

        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Пароль" autocomplete="password" required>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="containerA">        
        <a class="no-underline" href="{{ route('forgot.password') }}"><b>Забули пароль?</b></a>
        </div>
        <button type="submit">Увійти</button>
        <br>        
        <label>
            <h5><b>Або увійти через</b></h5>
        </label>

        <div class="social-icons">
            <a href="https://www.facebook.com" class="facebook-icon"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-64.png" alt="Facebook"></a>
            <a href="https://appleid.apple.com/sign-in" class="apple-icon"><img src="https://cdn3.iconfinder.com/data/icons/picons-social/57/56-apple-64.png" alt="Apple"></a>
            <a href="https://accounts.google.com/AccountChooser/signinchooser?service=mail&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&flowName=GlifWebSignIn&flowEntry=AccountChooser" class="google-icon"><img src="https://cdn2.iconfinder.com/data/icons/social-icons-33/128/Google-64.png" alt="Google"></a>
        </div>
<br>
 <label>
    Не маєте профілю? <a href="{{ route('registration.getSigUp') }}"><b>&nbsp;Зареєструватися.</b></a>
</label>
    <br>
        <label class="conditions"> Під час входу чи реєстрації Ви погоджуєтеся з нашими Умови користування. </label>

    </form>
    <div>

@endsection