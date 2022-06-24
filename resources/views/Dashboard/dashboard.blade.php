@extends('platilla')
@section('content')
<div class="container1">
    <img src="{{ asset('img/Favicon_1.png')}}" class="img-responsive" >
</div>
<div class="carousel container1" >
    <div class="carousel-inner" role="listbox" >
        <img src="{{ asset('img/Electromecanica.jpg')}}" class="img-carousel">
        <div class="text">Electromecanica</div>
    </div>

    <div class="carousel-inner" role="listbox">
        <img src="{{ asset('img/Electronica.jpg')}}" class="img-carousel"  >
        <div class="text">Electronica</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/GestionEmpresarial.jpg')}}" class="img-carousel">
        <div class="text">Gestion Empresarial</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/Industrial.jpg')}}" class="img-carousel">
        <div class="text">Industrial</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/Logistica.jpg')}}" class="img-carousel">
        <div class="text">Logistica</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/Mecatronica.jpg')}}" class="img-carousel">
        <div class="text">Mecatronica</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/Quimica.jpg')}}" class="img-carousel">
        <div class="text">Quimica</div>
    </div>

    <div class="carousel-inner ">
        <img src="{{ asset('img/Sistemas.jpg')}}" class="img-carousel">
        <div class="text">Sistemas</div>
    </div>

    <div class="carousel-inner">
        <img src="{{ asset('img/Tics.jpg')}}" class="img-carousel">
        <div class="text">Tic's</div>
    </div>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
  <span class="dot" ></span>
</div>
<script>
    let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("carousel-inner");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active1", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active1";
  setTimeout(showSlides, 3000);
}
</script>
@endsection
