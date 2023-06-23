@section("sideMenu")


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

        <a href="{{ route('logout.getSigout')}}">
          <div class="sideMenu-menu-item">
              <img src="/img/exit.png">
              <span>Вихід</span> 
        </div></a>

  </div>
  <div class="sideMenu-line"></div>
</div>
