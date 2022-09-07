@extends('frontend/layout')
@section('page_title', 'Mess Service')
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
                            <li><span>Messservice</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main section-->

    <section class="single-product-details my-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-12 mb-4">
                    <div class="product_details-content">

                        <h2><strong>Lorem Ipsum</strong></h2>

                        <div class="bannerimg">
                            <img src="{{asset('frontendassets/images/banner-bg2.jpg')}}" class="img-fluid" alt="">
                        </div>

                        <div class="accordion mt-5 p-0" id="accordionExample">

                            <div class="accordion-item p-0">

                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Lorem Ipsum
                                    </button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="col-lg-4 col-md-6 productblock mb-4">
                                                <a href="#">
                                                    <div class="aproduct">
                                                        <div class="image-wrapper">
                                                            <img class="b-lazy b-loaded" src="https://images.glazz.nl/400x400/Tessa-46173.webp?m=2" alt="Tessa">
                                                        </div>
                                                        <button type="submit" class="btn measuring-btn pbtn">Lorem Ipsum</button></div>
                                                </a>
                                            </div>

                                            <div class="col-lg-4 col-md-6 productblock mb-4">
                                                <a href="#">
                                                    <div class="aproduct">
                                                        <div class="image-wrapper">
                                                            <img class="b-lazy b-loaded" src="https://images.glazz.nl/400x400/Tessa-46173.webp?m=2" alt="Tessa">
                                                        </div>
                                                        <button type="submit" class="btn measuring-btn pbtn">Lorem Ipsum</button></div>
                                                </a>
                                            </div>

                                            <div class="col-lg-4 col-md-6 productblock mb-4">
                                                <a href="#">
                                                    <div class="aproduct">
                                                        <div class="image-wrapper">
                                                            <img class="b-lazy b-loaded" src="https://images.glazz.nl/400x400/Tessa-46173.webp?m=2" alt="Tessa">
                                                        </div>
                                                        <button type="submit" class="btn measuring-btn pbtn">Lorem Ipsum</button></div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 col-md-6 productblock mb-4">
                                                <a href="#">
                                                    <div class="aproduct">
                                                        <div class="image-wrapper">
                                                            <img class="b-lazy b-loaded" src="https://images.glazz.nl/400x400/Tessa-46173.webp?m=2" alt="Tessa">
                                                        </div>
                                                        <button type="submit" class="btn measuring-btn pbtn">Lorem Ipsum</button></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection