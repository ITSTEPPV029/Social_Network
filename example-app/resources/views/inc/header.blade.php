@section("header")
<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Начальная загрузка"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="\" class="nav-link px-2 text-secondary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Дім</font></font></a></li>
          <li><a href="{{ route('chat') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Чат</font></font></a></li>
          <li></li>
          <li><a href="{{ route('allUser.allUser') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">всі користувачі</font></font></a></li>
          <li><a href="{{ route('addPet') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Додати тваринок</font></font></a></li>

        </ul>

        <form  action="{{route('search.searchUser')}}" method="get" enctype="multipart/form-data" class="col-12 col-lg-auto d-flex align-items-center justify-content-between" role="search">
          <input name="search" type="search" class="form-control form-control-dark text-bg-dark" placeholder="Поиск..." aria-label="Поиск">
          <button class="btn btn-outline-light ms-2 inputSubmit" type="submit">пошук</button>
      </form>
      

        @if(Auth::check())
         <a href="{{route('profile.show',['user' => Auth::user()])}}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">мій профіль</font></font></a>
         <b class="nav-link px-2 text-white" style="vertical-align: inherit;" > вітаємо  {{ Auth::user()->last_name }}!</b>
          <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a href="{{ route('logout.getSigout') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Вийти</font></font></a></font></font></button>
          @else
          <div class="text-end"> 
            <button type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a href="{{ route('registration.getSigUp') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Реєстрація</font></font></a></font></font></button>
            <button type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a href="{{ route('login.getSigin') }}" class="nav-link px-2 text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Увійти</font></font></a></font></font></button>
          </div>
        @endif

      </div>
    </div>
  </header>