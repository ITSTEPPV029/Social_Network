@extends('layouts.app')

@section('content')


<div class="friends-container">
 
 
    <div class="friends">
      <h1>Друзі</h1>
      <hr/>
        @if(session('info'))
        <p >{{ session('info') }}</p>
        @endif
      
      @if ($user->friends()->count())
          @foreach($user->friends() as $friend)
            <div class="friend-info">
              <a href="{{route('profile.show',$friend)}}" >
                  <img style="height:100px;" src="{{ asset($friend->avatar) }}">
              </a>
                <b>{{$friend->first_name }} &nbsp; {{$friend->last_name}}</b><br/>
            </div>
            @if (Auth::user()->id==$user->id)
            <a href="{{route('deleteFriend',$friend)}}"  class="friend-button-delete-orange" >видалити з друзів</a>
            @endif
            <br />
          @endforeach
      @else
        <h4>відсутні</h4>
      @endif
    </div>

<div class="friend-spacer"></div>

@if (Auth::user()->id==$user->id)

 <div class="friend-requests">
  <h1>Заявки в друзі</h1>
 <hr/>
    @if ($user->friendsRequest()->count()&&Auth::check()&&Auth::user()->id==$user->id)
      @foreach($user->friendsRequest() as $friend)
        <div class="friend-info">
          <a href="{{route('profile.show',$friend)}}" >
              <img style="height:100px;" src="{{ asset($friend->avatar) }}">
          </a>
            <b>{{$friend->first_name }} &nbsp; {{$friend->last_name}}</b><br/>
        </div>
        <a class="friend-button-orange"  href="{{route('addFriend.addFriend',$friend)}}" >підтвердити </a>
      @endforeach

    @else
        @if (Auth::check()&&Auth::user()->id==$user->id)
        <h4>не має заявок</h4>
        @endif
    @endif
  @endif 
 </div>

</div>

@endsection