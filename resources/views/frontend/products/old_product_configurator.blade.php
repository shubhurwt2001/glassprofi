
@extends('frontend/layout')
@section('page_title', 'Product Configurator')
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
                            <li><a href="/">Bathroom</a></li>
                            <li><span>Bathroom selection aid</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->
    <section class="product-configurator py-4">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 mb-4">
                    <div class="product-configurator-content">
                        <h2 class="steps-h"><strong>Calculate your price in 4 steps</strong></h2>
                        <br>
                        <h4>Bathroom selection aid</h4>

                        <div class="accordion" id="accordionExample">
                            <div class="pacc-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Waar ben je naar op zoek?
                                    </button>
                                </h2>

                                <div id="collapseOne" class="acc-show accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-4 mb-4">
                                                <a href="product-single_detailspage.html">
                                                    <div id="pccselect" class="pacc-content">
                                                        <div class="img-hover-zoom">
                                                            <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                            <h3>shower door</h3>
                                                            <p>De keuken heeft een breedte tot 180 cm.</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                        <h3>shower enclosure</h3>
                                                        <p>De keuken heeft een breedte tot 180 cm.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                        <h3>shower cubicle</h3>
                                                        <p>De keuken heeft een breedte tot 180 cm.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <p>Staat je keuze er niet bij? Dan komen we graag de keukenachterwand inmeten.</p>
                                                <a href="" class="btn btn-lg tekstbtn d-inline-block">Lorem Ipsum<span class="faright"><i class="fa-solid fa-angle-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="pacc-item hidden">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Where does it come from222
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="acc-hidden accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-4 mb-4">
                                                <div class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                        <h3>Lorem Lpsum</h3>
                                                        <p>De keuken heeft een breedte tot 180 cm. 222</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                        <h3>Lorem Lpsum</h3>
                                                        <p>De keuken heeft een breedte tot 180 cm. 222</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/Glazendouchedeurzwart-35641.webp')}}" class="img-fluid" alt="">
                                                        <h3>Lorem Lpsum</h3>
                                                        <p>De keuken heeft een breedte tot 180 cm. 222</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <p>Staat je keuze er niet bij? Dan komen we graag de keukenachterwand inmeten.</p>
                                                <a href="" class="btn btn-lg tekstbtn d-inline-block">Lorem Ipsum<span class="faright"><i class="fa-solid fa-angle-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn measuring-btn">Free measuring service</button>
                        <button type="submit" class="btn choose-btn">Choose your glass</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    @endsection