@extends('layouts.app')

@section('content')

 <div class="form-container">

    <form action="{{ route('login.postSigin')}}" method="post">
        {{ csrf_field() }}
        <label>
            <h2><b>Вхід</b></h2>
        </label>
                
                @if($errors->has('email'))
                <strong class="login-error-message">{{ $errors->first('email') }}</strong>
                @endif

        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Електронна пошта" autocomplete="email" required>

        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Пароль" autocomplete="password" required>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
                 
        <div class="login-remember">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Запам'ятати мене</label>
        </div>  
                             
        <div class="login-forgot">        
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