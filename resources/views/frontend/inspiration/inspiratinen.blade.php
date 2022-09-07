@extends('frontend/layout')
@section('page_title', 'Login Page')
@section('home_section', 'active')
@section('container')   
  <!--breadcrumb section-->
  <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-wrapper-new my-1">
                    <div id="breadcrumb">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><span>Inspirationen</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main section-->
    <section class="inspiratinen-section my-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 mb-4">
                    <div class="inner15">
                        <a href="">
                            <img src="{{asset('frontendassets/images/img25.webp')}}" class="img-fluid" alt="">
                            <div class="overlay">kitchen splashbacks</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="inner15">
                        <a href="">
                            <img src="{{asset('frontendassets/images/img1.jpg')}}" class="img-fluid" alt="">
                            <div class="overlay">kitchen splashbacks</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="inner15">
                        <a href="">
                            <img src="{{asset('frontendassets/images/img11.jpg')}}" class="img-fluid" alt="">
                            <div class="overlay">kitchen splashbacks</div>
                        </a>
                    </div>
                </div>



            </div>
        </div>
    </section>

    @endsection