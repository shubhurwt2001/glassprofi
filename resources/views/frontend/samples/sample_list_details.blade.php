@extends('frontend/layout')
@section('page_title', 'Test Samples')
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
                            <li><span>Kostenlose Testmuster</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!--main section-->
   <section class="kostenlose-tesmuster my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div id="product_categorie-image" class="productImage">
                        <a href="images/proefmonsters-kleuren-14662.webp" data-fancybox> <img src="https://images.glazz.nl/400x400/Proefmonsterextrahelder.1616-52895.webp?m=2" class="img-fluid" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product_categorie">
                        <h1 class="categorie-title" itemprop="name">Lorem Ipsum Lorem Ipsum</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <button type="submit" class="btn measuring-btn float-end">To order</button></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="usps mt-4">
                                <ul>
                                    <li>Levertijd ± <b>5</b></li>
                                    <li><b>Inmeten en monteren in heel Nederland</b></li>
                                    <li><b>Geheel vrijblijvend gratis inmeten</b></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="videos mt-5 mb-5">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="https://www.youtube.com/embed/nEzFHiGJM6g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>