@extends('layouts.app')

@section('contentGuest')

<div class="guest-page-user">

  <div class="guest-page-panel">
     <h3>Для перегляду повної інформації потрібно </h3>

    <a href="{{ route('login.getSigin') }}"><h5 class="guest-page-button" >Увійти</h5> </a>
     <h3>або </h3>
    <a href="{{ route('registration.getSigUp') }}"> <h5 class="guest-page-button">Зареєструватися</h5> </a>

  </div>

  <div class="profile-overlay-test"></div> 

  <div class="profile-container">

    <div class="profile-image">
      <img src="{{ asset($user->avatar) }}">

      <div class="profile-image-bottom-div">

          @foreach($user->pets as $pet)
          <div class="profile-bottom-button">
            <img src="{{asset($pet->avatar)}}">
          </div>
          @endforeach 
      </div>
    </div>
    <div class="profile-info-container">
      <div class="profile-user-name-button">
        <div class="profile-user-name">
          <h3><strong>{{ $user->first_name }}</strong> &nbsp;
            <strong>{{ $user->last_name }}</strong>
          </h3>
        </div>
      </div>
      <div class="profile-user-info-container">
        <div class="profile-user-info">

          <div v-if="user.nick_name" class="profile-info-field"><b>Нікнейм: </b> {{ $user->nick_name }}</div>

          <div v-if="user.gender" class="profile-info-field"><b>Стать: </b> {{$user->gender }}</div>

          <div v-if="user.city" class="profile-info-field"><b>Місто: </b> {{ $user->city }}</div>

          <div v-if="user.date_of_birth" class="profile-info-field"><b>Дата народження: </b> {{ $user->date_of_birth }}
          </div>

        </div>
        <div class="profile-user-description">
            <p><b>Друзі:</b> 3</p> 
          <div v-if="user.about_me" class="profile-info-field">
            <b>Про себе: </b>{{ $user->about_me }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- ===================================== --}}
  <br/>

  <div class="post-container">
    
    @foreach($user->myPost as $post)
    <div class="post" v-for="post in posts" >
  

        <div class="post-photo">
            <img v-if="post.photo"  src="{{$post->photo}}" >
        </div>
        
        <div class="post-like-container">
          <div class="post-like">
            <!-- =================================/public для сервера ============================== -->
            <img class="post-like-img-like"  src="/img/like.png" > 
            {{-- <span v-if="post.like>0" >{{$post->like}}</span> --}}
            <img class="post-like-img-comment"  src="/img/comment.png" >
            <span  ></span>
            <img class="post-like-img-share"  src="/img/share.png">
            <img class="post-like-img-save" src="/img/save.png">
          </div>
        </div>

      <div v-if="post.text!=0" class="post-text">
        <div class=""> </div>
        <br/>
          {{-- <div >{{ $post->text }}</div> --}}
          {{-- <div v-else>{{ truncatedText(post.text) }}</div> --}}
          <b>
            {{-- {{ expanded==post.id ? 'Згорнути' : 'Розгорнути' }} --}}
          </b>
      </div>

  
      
    </div>
    @endforeach 
  </div>




</div>





@endsection


