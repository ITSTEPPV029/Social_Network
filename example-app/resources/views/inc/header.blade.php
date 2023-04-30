@section("header")
<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <!--Лого-->
        <a href="/" class="logo d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img class="bi me-2" alt="Начальная загрузка" src="https://hips.hearstapps.com/hmg-prod/images/dog-puppy-on-garden-royalty-free-image-1586966191.jpg?crop=0.752xw:1.00xh;0.175xw,0&resize=1200:*"/>
        </a>
        
        <!-- <ul class="nav">
          <li><a href="\" class="nav-link text-secondary">Головна</a></li>
          <li><a href="{{ route('login.getSigin') }}" class="nav-link">Новини</a></li>
          <li></li>
          <li><a href="{{ route('allUser.allUser') }}" class="nav-link">всі користувачі</a></li>
        </ul> -->

        <form  action="{{route('search.searchUser')}}"  method="get" enctype="multipart/form-data" role="search">
          <input name="search" type="search" class="form-control-dark text-bg-dark" placeholder="Поиск..." aria-label="Поиск">
          <input class="btn btn-outline-light" class="inputSubmit" type="submit" value="пошук"/>
        </form>

        @if(Auth::check())
         <a href="{{route('profile.show',['user' => Auth::user()])}}" class="nav-link px-2 text-white">мій профіль</a>
         <b class="nav-link px-2 text-white" style="vertical-align: inherit;" > вітаємо  {{ Auth::user()->last_name }}!</b>
          <button type="button" class="btn btn-warning"><a href="{{ route('logout.getSigout') }}" class="nav-link px-2 text-white">Вийти</a></button>
          @else
          <div class="text-end"> 
            <button type="button" class="btn btn-outline-light me-2"><a href="{{ route('registration.getSigUp') }}" class="nav-link px-2 text-white">Реєстрація</a></button>
            <button type="button" class="btn btn-warning"><a href="{{ route('login.getSigin') }}" class="nav-link px-2 text-white">Увійти</a></button>
          </div>
        @endif

      </div>
    </div>
  </header>