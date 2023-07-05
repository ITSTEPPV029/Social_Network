<?php

use Illuminate\Support\Facades\Auth;
?>
@section("header")
<header>

  <div class="header-container">

    <a href="{{route('profile.show',['user' => Auth::user()])}}">
      <img class="header-logo"  src="/img/logoHeader.png" />
    </a>
     
    <div class="header-right-info">
      <a href="#"><img class="header-bell" src="/img/bell.png" /></a>
      <b style="vertical-align: inherit;"> {{ Auth::user()->first_name }}</b>
      <a href="{{route('profile.show',['user' => Auth::user()])}}"><img  class="header-avatar" src="<?= Auth::user()->avatar ?>" /></a>
    </div>
    
  </div>
 
</header>