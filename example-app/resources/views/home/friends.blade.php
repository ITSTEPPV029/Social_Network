@extends('layouts.app')

@section('content')

<div class="friends-conteiner">
  <h1>Друзі</h1>
  @if ($user->friends()->count())
      @foreach($user->friends() as $friend)
        <img style="height:100px;" src="{{ asset($friend->avatar) }}">
        <strong>{{$friend->first_name}}</strong> <br />
        <a href="{{route('profile.show',$friend)}}" class="nav-link px-2 text-black">профіль</a>
        <br />
      @endforeach
  @else
    <h4>відсутні</h4>
  @endif
</div>

@endsection