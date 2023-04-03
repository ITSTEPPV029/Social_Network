@extends('layouts.app')

@section('content')

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <h1>профіль користувача</h1>
    <strong>{{$user->first_name}}</strong> 
    <strong>{{$user->last_name}}</strong> 
    <strong>{{$user->nick_name}}</strong> 
    <hr/>
    <h1>друзі</h1>
      @foreach($user->friends() as $friend)
        <strong>{{$friend->first_name}}</strong> <br/>  
        <a href="{{route('profile.show',$friend)}}" class="nav-link px-2 text-black">профіль</a>
     <br/>   
       @endforeach   
       <hr/>


@if (!$user->friendsRequest()->count()&&Auth::check()&&Auth::user()->id==$user->id)
  <h1>заявки в друзі</h1>
  <h4>не має заявок в друзі</h4>
@else  
  @foreach($user->friendsRequest() as $friend)
    <strong>{{$friend->first_name}}</strong> <br/>  
    <a href="{{route('profile.show',$friend)}}" class="nav-link px-2 text-black">профіль</a>
    <a href="{{route('addFriend.addFriend',$friend)}}" class="nav-link px-2 text-black">добавити в друзі</a>
    <br/>   
  @endforeach   
@endif

</div>
 
@endsection