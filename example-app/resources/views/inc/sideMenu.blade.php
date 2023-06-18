@section("sideMenu")

<script>
  let full_show = false;
  function onClick(elem) {
  let r = document.querySelector(':root');
  let p = elem.parentElement;
    if (full_show) {
      p.classList.remove("show-full");
      full_show = false;
    } else {
      p.classList.add("show-full");
      full_show = true;
    }
  }
</script>
<button onclick="onClick(this)">A</button>
<nav class="sideMenu-container">
  <ul>
    <li><span></span><a href="\">Головна сторінка</a></li>
    <li><span></span><a href="{{ route('profile.show',['user' => Auth::user()]) }}">Моя сторінка</a></li>
    <li><span></span><a href="{{ route('home.home') }}">Додати опис</a></li>
    <li><span></span><a href="{{ route('allUser.allUser') }}">всі користувачі(тест)</a></li>
    <li><span></span><a href="{{ route('friends') }}">Друзі</a></li>
    <li><span></span><a id="messageCount" href="{{ route('message') }}">повідомлення {{$user}}</a></li>
    <li><span></span><a href="{{ route('chat') }}">Чат</a></li>
    <li><span></span><a href="\">Збережені дописи</a></li>
    <li><span></span><a href="{{ route('settings') }}">Налаштування профілю</a></li>
    <li><span></span><a href="\">Вихід</a></li>
  </ul>
  <div></div>
</nav>