@extends('layouts.app')

@section('content')

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">

@if(isset($message))
   <dialog open >
      <p> Користувач вже у друзях </p>
      <p><button id="closeDialog">Закрити вікно</button></p>
     </dialog> 
@endif
            

  @foreach($users as $user)
  <div class="blokMerch">
      {{--<img class="photo" onclick="clickImg(this)" src="{{ asset('/storage/'. $merch->name_main_photo) }}" > --}}
      <div class="text">
          <img style="height:100px;"  src="{{ asset($user->avatar) }}" ><br/>
           <strong>{{$user->first_name}}</strong> 
           <strong>{{$user->last_name}}</strong> 
           <strong>{{$user->nick_name}}</strong> 
      </div>
      <a href="{{route('profile.show',$user) }}">профіль</a>
      @if(Auth::check())    
          <a href="{{route('friendRequest.friendRequest',$user) }}">добавити в друзі</a>
       @endif
  </div>
  <br/>
@endforeach 
</div>
 


@endsection