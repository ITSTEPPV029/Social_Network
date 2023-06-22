@section("sideMenu")

    {{-- <nav class="sideMenu-container">
      <ul>
        <li><a href="\">Головна сторінка</a></li>
        <li><a href="{{ route('profile.show',['user' => Auth::user()]) }}">Моя сторінка</a></li>
        <li><a href="{{ route('home.home') }}">Додати опис</a></li>
        <li><a href="{{ route('allUser.allUser') }}">всі користувачі(тест)</a></li>
        <li><a href="{{ route('friends') }}">Друзі</a></li>
        <li><a id="messageCount" href="{{ route('message') }}" >повідомлення {{$user}}</a></li>
        <li><a href="{{ route('chat') }}" >Чат</a></li>
        <li><a href="{{ route('savedPosts') }}">Збережені дописи</a></li>
        <li></li>
        <li><a href="\">Вихід</a></li>
     
      </ul> --}}
      {{-- <div></div> 
    </nav>--}}

    
<div class="sideMenu-container">

  <div class="sideMenu-container-menu">

    <a href="{{ route('news') }}">
    <div class="sideMenu-menu-item">
         <img src="/img/home.png">
         <span>Головна сторінка</span> 
    </div></a>

    <a href="{{ route('allUser.allUser') }}">
      <div class="sideMenu-menu-item">
           <img src="/img/search.png" >
           <span>Пошук</span> 
      </div></a>

      <a href="{{ route('profile.show',['user' => Auth::user()]) }}">
        <div class="sideMenu-menu-item">
             <img src="/img/MyPage.png">
             <span>Моя сторінка</span> 
        </div></a>

      <a href="{{ route('friends')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/friends.png">
              <span>Друзі</span> 
        </div></a>

      <a href="{{ route('message')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/messages.png">
              <span>Повідомлення</span> 
        </div></a>

        <a href="{{ route('savedPosts')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/savaPost.png">
              <span>Збережені дописи</span> 
        </div></a>

        <a href="{{ route('settings')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/settings.png">
              <span>Налаштування</span> 
        </div></a>

        <a href="{{ route('login.getSigin')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/exit.png">
              <span>Вихід</span> 
        </div></a>

  </div>
  <div class="sideMenu-line"></div>
</div>
