@section("sideMenu")

@if (Auth::check())
    <nav class="sideMenu-container">
      <ul>
        <li><a href="\">Головна сторінка</a></li>
        <li><a href="{{ route('profile.show',['user' => Auth::user()]) }}">Моя сторінка</a></li>
        <li><a href="{{ route('home.home') }}">Додати опис</a></li>
        <li><a href="{{ route('allUser.allUser') }}">Друзі</a></li>
        <li><a href="{{ route('message') }}" >повідомлення</a></li>
        <li><a href="{{ route('chat') }}" >Чат</a></li>
        <li><a href="\">Збережені дописи</a></li>
        <li><a href="\">Налаштування</a></li>
        <li><a href="\">Вихід</a></li>
        
      </ul>
      <div></div>
    </nav>
@endif