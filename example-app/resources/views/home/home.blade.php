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
      <h1>Знайди друзів</h1>
      <h1>для себе</h1>
      <h1>і свого</h1>
      <h1>улюбленця</h1>
      <a href="login" style="width: 7.5rem;">Увійти</a>
      <a href="registration">Зареєструватися</a>
    </div>
    <div class="imageDog" style="bottom: -8%; right: 0%;">
      <img src="/img/dog.png" />
    </div>
    <div class="moreNext">
      <p>Дізнатися більше </p>
      <img src="/img/doubleArrowDown.svg" /></button>
    </div>
  </div>


  <!-- _______________________________________Для виділення головного екрану__________________________________________________ -->
  <div id="moreHome">
    <div class="moreDiv">
      <img src="/img/PetLifeLogo_Line.png" />
      <div>
        <div>
          <h1>Діліться</h1>
          <h1>своїми</h1>
          <h1>моментами</h1>
          <h1>з іншими</h1>
        </div>
        <div class="video-frame">
          <video controls width="100%" muted="muted">
            <source src="/video/testVideo.mp4" />
          </video>
        </div>
      </div>
      <div class="imageDog" style="bottom: 0%; right: 0%;">
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
        <div style="text-align: right;">
          <h1>Знаходьте</h1>
          <h1>компанію</h1>
          <h1>для себе</h1>
          <h1>і своїх</h1>
          <h1>улюбленців</h1>
        </div>
      </div>
      <div class="imageDog" style="bottom: -15%; left: 0%;">
        <img src="/img/cat.png" style="height: 450px;" />
      </div>
    </div>
    <p>
      <a href="registration">Зареєструватися</a>
    </p>
  </div>

</div>


@endsection