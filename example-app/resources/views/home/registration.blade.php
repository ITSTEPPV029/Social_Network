@extends('layouts.app')

@section('content')

<div class="form-container">

    <form action="{{ route('registration.postSigUp')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label>
            <h2><b>Створити акаунт</b></h2>
        </label>
        <div class="social-icons">
            <a href="https://www.facebook.com" class="facebook-icon"><img src="https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-64.png" alt="Facebook"></a>
            <a href="https://appleid.apple.com/sign-in" class="apple-icon"><img src="https://cdn3.iconfinder.com/data/icons/picons-social/57/56-apple-64.png" alt="Apple"></a>
            <a href="https://accounts.google.com/AccountChooser/signinchooser?service=mail&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&flowName=GlifWebSignIn&flowEntry=AccountChooser" class="google-icon"><img src="https://cdn2.iconfinder.com/data/icons/social-icons-33/128/Google-64.png" alt="Google"></a>
        </div>
        <label>
            <h2><b>Або</b></h2>
        </label>

        <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Ім’я" autofocus autocomplete="first_name" required>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Прізвище" autocomplete="last_name" required>
        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

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
        
        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation" name="password_confirmation" placeholder="Підтвердження паролю" required>
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label class="conditions"> Під час входу чи реєстрації Ви погоджуєтеся з нашими Умови користування. </label>

        <button type="submit">Зареєструватись</button>
        <label>
            <h4><b>Або</b></h4>
        </label>
<a href="{{ route('login.getSigin') }}" class="button-link">Увійти</a>


    </form>
    <div>

        @endsection