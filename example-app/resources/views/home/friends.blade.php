@extends('layouts.app')

@section('content')


<div class="friends-container">
 
 
    <div class="friends">
      <h1>Друзі</h1>
        @if(session('info'))
        <p >{{ session('info') }}</p>
        @endif
      
      @if ($user->friends()->count())
          @foreach($user->friends() as $friend)
            <img style="height:100px;" src="{{ asset($friend->avatar) }}">
            <strong>{{$friend->first_name}}</strong> <br />
            <a href="{{route('profile.show',$friend)}}" class="nav-link px-2 text-black">профіль</a>
            <a href="{{route('deleteFriend',$friend)}}" class="nav-link px-2 text-black">видалити з друзів</a>
            <br />
          @endforeach
      @else
        <h4>відсутні</h4>
      @endif
    </div>

 <div class="friend-requests">
  <h1>Заявки в друзі</h1>
    @if ($user->friendsRequest()->count()&&Auth::check()&&Auth::user()->id==$user->id)

      <h1>заявки в друзі</h1>
      @foreach($user->friendsRequest() as $friend)
        <strong>{{$friend->first_name}}</strong> <br />
        <img style="height:100px;" src="{{ asset($friend->avatar) }}">
        <a href="{{route('profile.show',$friend)}}" class="nav-link px-2 text-black">профіль</a>
        <a href="{{route('addFriend.addFriend',$friend)}}" class="nav-link px-2 text-black">підтвердити заявку в друзі</a>
        <br />
      @endforeach

    @else
        @if (Auth::check()&&Auth::user()->id==$user->id)
        <h4>не має заявок в друзі</h4>
        @endif
    @endif
   
 </div>

</div>

@endsection