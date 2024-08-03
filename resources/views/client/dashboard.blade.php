<!-- resources/views/client/dashboard.blade.php -->

@extends('layouts.client')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://demo.hasthemes.com/rongcha/img/slider/slider-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://demo.hasthemes.com/rongcha/img/slider/slider-2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="" style="color: black">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" style="color: black" aria-hidden="true"></span>
            <span class="" style="color: black">Next</span>
        </button>
    </div>
    <div class="card text-bg-dark">
        <img src="https://demo.hasthemes.com/rongcha/img/banner/bg-03.jpg" class="card-img" alt="...">
        <div class="card-img-overlay">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">We Provide Organic
                Green Tea For You
                Lorem ipsum dolor sit amet, consectetu adipisicing elit sedeiu tempor inci ut labore et dolore magna aliqua.
            </p>
            <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
    </div>
   
    <script>
        const myCarouselElement = document.querySelector('#myCarousel')

        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 2000,
            touch: false
        })
    </script>
@endsection
