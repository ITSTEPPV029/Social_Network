@extends('layouts.app')

@section('content')


<div class="profile-container">

    <div class="profile-image">
    <img src="{{ asset($user->avatar) }}" >
      <div class="bottom-div">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <div class="profile-info-container">
      <div class="profile-user-name-button">
        <div class="profile-user-name">
            <p><strong>{{$user->first_name}}</strong> 
             <strong>{{$user->last_name}}</strong> </p>
        </div>
        <div class="profile-user-button">
          <button>Додати в друзі</button>
          <button>Написати</button>
        </div>
      </div>
      <div class="profile-user-info-container">
        <div class="profile-user-info">
        <div class="info-field"><b>@<b>{{$user->nick_name}}</b></b></div>
         <div class="info-field"><b>Стать:</b> {{$user->gender}}</div>
         <div class="info-field"><b>Місто:</b> {{$user->city}}</div>
         <div class="info-field"><b>Дата народження:</b> {{$user->date_of_birth}}</div>
        </div>
        <div class="profile-user-description">
          <div class="info-field">
                    <b>Про себе: </b>{{$user->about_meprofilePage}}
        </div>
      </div>
    </div>
</div>

{{-- 
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


</div> --}}


<script>
  function submitForm() {
    document.getElementById("my-avatar-form").submit();
  }
</script>
@endsection


