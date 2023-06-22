<?php

use Illuminate\Support\Facades\Auth;
?>
@section("header")
<header>

  <div class="header-container">

    <a href="/">
      <img class="header-logo"  src="/img/logoHeader.png" />
    </a>
     
  <div class="header-right-info">
    <a href="#"><img class="header-bell" src="/img/bell.png" /></a>
    <b style="vertical-align: inherit;"> {{ Auth::user()->first_name }}</b>
    <a href="{{route('profile.show',['user' => Auth::user()])}}"><img  class="header-avatar" src="<?= Auth::user()->avatar ?>" /></a>
    
  </div>
   
    
  

  </div>
 


      {{--<button type="button"><a href="{{ route('logout.getSigout') }}">Вийти</a></button>
        <button type="button"><a href="{{ route('registration.getSigUp') }}">Реєстрація</a></button>
        <button type="button"><a href="{{ route('login.getSigin') }}">Увійти</a></button>
    {{-- <form action="{{route('search.searchUser')}}" method="get" enctype="multipart/form-data" role="search">
      <input name="search" type="search" placeholder="Поиск..." aria-label="Поиск">
      <input class="inputSubmit" type="submit" value="пошук" />
    </form> --}}

 
</header>