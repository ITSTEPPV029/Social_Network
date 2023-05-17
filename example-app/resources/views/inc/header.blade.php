<?php

use Illuminate\Support\Facades\Auth;
?>
@section("header")
<header>
  <div class="header-container">
    <!--Лого-->
    <a href="/" class="logo">
      <img alt="Начальная загрузка" src="https://hips.hearstapps.com/hmg-prod/images/dog-puppy-on-garden-royalty-free-image-1586966191.jpg?crop=0.752xw:1.00xh;0.175xw,0&resize=1200:*" />
    </a>

    <!--<ul class="nav">
          <li><a href="\" class="nav-link text-secondary">Головна</a></li>
          <li><a href="{{ route('login.getSigin') }}">Новини</a></li>
          <li></li>
          <li><a href="{{ route('allUser.allUser') }}">всі користувачі</a></li>
      </ul>-->

    <form action="{{route('search.searchUser')}}" method="get" enctype="multipart/form-data" role="search">
      <input name="search" type="search" placeholder="Поиск..." aria-label="Поиск">
      <input class="inputSubmit" type="submit" value="пошук" />
    </form>

    <div class="auth">
      @if(Auth::check())
      <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/3239/3239958.png" /></a> <!--Сповіщення-->
      <a href="{{route('profile.show',['user' => Auth::user()])}}">мій профіль</a>
      <b style="vertical-align: inherit;"> {{ Auth::user()->last_name }}</b>
      <a href="#"><img src="<?= Auth::user()->avatar ?>" /></a><!--Аватар-->
      <button type="button"><a href="{{ route('logout.getSigout') }}">Вийти</a></button>
      @else
      <div>
        <button type="button"><a href="{{ route('registration.getSigUp') }}">Реєстрація</a></button>
        <button type="button"><a href="{{ route('login.getSigin') }}">Увійти</a></button>
      </div>
      @endif
    </div>

  </div>
</header>