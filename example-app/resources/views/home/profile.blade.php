@extends('layouts.app')

@section('content')

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <h1>профіль користувача</h1>
    
    <img style="height:300px;"  src="{{ asset($user->avatar) }}" >
   <br/>
    <strong>{{$user->first_name}}</strong> 
    <strong>{{$user->last_name}}</strong> 
    <strong>{{$user->nick_name}}</strong> 
    @if (Auth::check()&&Auth::user()->id==$user->id)
        <form action="{{ route('avatar.addAvatar') }}"  method="post" enctype="multipart/form-data">
            {{ csrf_field() }}	
            <label for="avatar">завантажити фото профілю</label> <br/>
            <input class="inputfile" id="avatar" name="avatar" type="file">
            @error('avatar')
              <br/>
            <span class="text-danger">{{$message}}</span>
            @enderror
            <br/>
            <input type="submit" value="завантажити" >
        </form>
     @else
     <br/>
        @if (Auth::check())
        <a href="{{route('sendingMessage',$user)}}" class="btn btn-primary btn-block">відправити повідомлення</a>
        @endif
        
    @endif

    <hr/>

 @if (Auth::check())
     <div id="appPost">
      <Post :id="{{ json_encode($user->id) }}" :this-User="{{ json_encode(Auth::user())}}" /> 
    </div>

  <hr />

  @if (Auth::user()->id!=$user->id)
    @if (Auth::user()->checkIfFriend($user))
      <a href="{{route('deleteFriend',$user)}}" class="nav-link px-2 text-black">видалити з друзів</a>
    @elseif (Auth::user()->checkFriendsRequest($user))
      <p>запит на дружбу відправлений</p>
      @else
      <a href="{{route('friendRequest.friendRequest',$user) }}">добавити в друзі</a>
    @endif
  @endif

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
  <hr />

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
  @endif



  
  <h1>Тварини користувача</h1>
  @foreach($user->pets as $pet)
  <div>
    <div class="name">{{$pet->name}}</a></div>
  </div>
  @endforeach


</div>

@endsection