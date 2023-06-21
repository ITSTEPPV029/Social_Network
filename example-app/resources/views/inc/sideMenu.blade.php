@section("sideMenu")

<script>
  let full_show = false;

  function onClick(elem) {
    let r = document.querySelector(':root');
    let p = elem.parentElement;
    let t = p.getElementsByTagName("nav")[0];
    // t.style.setProperty('--sideMenu-width', "11%");
    // t.style.setProperty('--sideMenu-height', "300%");
    // t.style.setProperty('--margin-ul-left', "1%");
    // t.style.setProperty('--margin-li-top', "15.5%");
    // t.style.setProperty('--sideMenu-short-width', "2.2%");
    p.classList.add("show-full");
    t.style.setProperty('--sideMenu-width', t.clientWidth + 'px');
    p.classList.remove("show-full");
    t.style.setProperty('transition', 'width 2s ease-in-out');
    if (full_show) {
      p.classList.remove("show-full");
      // t.style.setProperty('width', '2.2%');
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
    <li style="background: linear-gradient(0deg, #F5F5F5 6.79%, #F5F4F5 68.13%, #F1F0F1 74.23%, #E5E4E5 80.43%, #D0D0D0 86.68%, #B4B4B4 92.91%, #A3A3A3 96.02%);"><img src="file:///D://SHAG//Diplom//house.png" /><a href="\">Головна сторінка</a></li>
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