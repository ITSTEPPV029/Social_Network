@extends('layouts.app')

@section('content')

<br /> <br />
<form class="row g-3" action="{{ route('registration.postSigUp')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row mb-3">
        <label for="nick_name" class="col-md-4 col-form-label text-md-end">{{ __('Нікнейм') }}</label>
        <div class="col-md-6">
            <input id="nick_name" type="text" class="form-control @error('nick_name') is-invalid @enderror" name="nick_name" value="{{ old('nick_name') }}" required autocomplete="name" autofocus>
            @error('nick_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
        <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Імя') }}</label>
        <div class="col-md-6">

            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Прізвище') }}</label>
        <div class="col-md-6">

            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Пошта') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Підтвердити пароль') }}</label>

        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Реєстрація') }}
            </button>
        </div>
    </div>
</form>


@endsection