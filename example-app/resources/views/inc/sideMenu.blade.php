@section("sideMenu")

    <nav class="sideMenu-container">
      <ul>
        <li><a href="\">Головна сторінка</a></li>
        <li><a href="{{ route('profile.show',['user' => Auth::user()]) }}">Моя сторінка</a></li>
        <li><a href="{{ route('home.home') }}">Додати опис</a></li>
        <li><a href="{{ route('allUser.allUser') }}">всі користувачі(тест)</a></li>
        <li><a href="{{ route('friends') }}">Друзі</a></li>
        <li><a id="messageCount" href="{{ route('message') }}" >повідомлення {{$user}}</a></li>
        <li><a href="{{ route('chat') }}" >Чат</a></li>
        <li><a href="\">Збережені дописи</a></li>
        <li><a href="{{ route('settings') }}">Налаштування профілю</a></li>
        <li><a href="\">Вихід</a></li>
     
      </ul>
      <div></div>
    </nav>
