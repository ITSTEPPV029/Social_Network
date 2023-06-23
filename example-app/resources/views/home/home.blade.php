@extends('layouts.app')

@section('contentGuest')


<script>
  let hidden = true;

  /* function changeDisplay(elem) {
    let img = elem.getElementsByTagName('img');
    if (hidden) {
      document.getElementById("moreHome").style.setProperty('display', 'block');
      if (img != null)
        img[0].style.setProperty('transform', 'rotateZ(180deg)');
    } else {
      document.getElementById("moreHome").style.setProperty('display', 'none');
      if (img != null)
        img[0].style.setProperty('transform', 'rotateZ(0)');
    }
    hidden = !hidden;
  } */
  const posDif = 250;
  window.addEventListener('scroll', () => {
        let elem = document.getElementsByTagName('video');
        const scrolled = window.scrollY;
        let position;
        for (let el of elem) {
          position = el.offsetTop;
          if ((position < scrolled + posDif && position >= scrolled) || (position > scrolled - posDif && position <= scrolled))
            onVideoHover(el);
          else
            onVideoHoverOut(el);
        }
      });

      function onVideoHover(elem) {
        elem.play();
      }

      function onVideoHoverOut(elem) {
        elem.pause();
      }
</script>

<div class="homeMain">
  <div class="homeDiv">
    <div class="logo-main">
      <img src="/img/PetLifeLogo_Line.png" />
    </div>
    <div>
      <h2>Знайди друзів для себе і свого улюбленця</h2>
      <a href="login" style="width: 7.5rem;">Увійти</a>
      <a href="registration">Зареєструватися</a>
    </div>
    <div class="imageDog" style="top: 3.29%; left: 56.5%;">
      <img src="/img/dog.png" />
    </div>
  </div>

  <div class="moreNext">
    <p>Дізнатися більше </p>
    <img src="/img/doubleArrowDown.svg" /></button>
  </div>
  <!-- _______________________________________Для виділення головного екрану__________________________________________________ -->
  <div id="moreHome">
    <div class="moreDiv">
      <img src="/img/PetLifeLogo_Line.png" />
      <div>
        <h2>Діліться з своїми моментами з іншими</h2>
        <div class="video-frame">
          <video controls width="100%" muted="muted">
            <source src="/video/testVideo.mp4" />
          </video>
        </div>
      </div>
      <div class="imageDog" style="top: 44.5%; right: -4.5%;">
        <img src="/img/dog.png" style="height: 450px;" />
      </div>
    </div>
    <div class="moreDiv">
      <img src="/img/PetLifeLogo_Line.png" />
      <div>
        <div class="video-frame">
          <video controls width="100%" muted="muted">
            <source src="/video/testVideo1.mp4" />
          </video>
        </div>
        <h2>Знаходьте компанію для себе і своїх улюбленців</h2>
      </div>
      <div class="imageDog" style="top: 82%; left: 0%;">
        <img src="/img/cat.png" style="height: 450px;" />
      </div>
    </div>
    <p>
      <a href="registration">Зареєструватися</a>
    </p>
  </div>

  <div>
    <!-- <div class="col-md-5 p-lg-5 mx-auto my-5">
      <h1 class="display-4 fw-normal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">В нас и нтерфейc в якому розбереться навіть ваший собака </font></font></h1>
      <p class="lead fw-normal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">И еще более остроумный подзаголовок в придачу. </font><font style="vertical-align: inherit;">Ускорьте свои маркетинговые усилия с помощью этого примера, основанного на маркетинговых страницах Apple.</font></font></p>
      <a class="btn btn-outline-secondary" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Вскоре</font></font></a>
    </div> -->
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>


@endsection