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
                    <!-- <h2 class="steps-h"><strong>Calculate your price in 4 steps</strong></h2>
                    <br> -->
                    <h4>Bathroom selection aid</h4>

                    <div class="accordion" id="accordionExample">
                        <div class="pacc-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button btnOne" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What are you looking for?
                                </button>
                            </h2>

                            <div id="collapseOne" class="acc-show accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">

                                        @foreach($selection_categories as $row)
                                        <div class="col-lg-4 mb-4 getAid" data-id="{{$row->id}}" data-title="{{$row->title}}">
                                            <a href="javascript:void(0)">
                                                <div id="pccselect" class="pacc-content">
                                                    <div class="img-hover-zoom">
                                                        <img src="{{asset('frontendassets/images/selection_img.jpg')}}" class="img-fluid" alt="">
                                                        <h3>{{$row->title}}</h3>
                                                        <!-- <p>De keuken heeft een breedte tot 180 cm.</p> -->
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach


                                        <!-- <div class="col-lg-12">
                                            <p>Staat je keuze er niet bij? Dan komen we graag de keukenachterwand inmeten.</p>
                                            <a href="" class="btn btn-lg tekstbtn d-inline-block">Lorem Ipsum<span class="faright"><i class="fa-solid fa-angle-right"></i></span></a>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion" id="accordionTwo" style="display:none;">
                        <div class="pacc-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">What type of &nbsp;<span class="getTitle1"> </span>&nbsp; are you looking for?</button>
                            </h2>
                            <div id="collapseTwo" class="acc-show accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionTwo">
                                <div class="accordion-body">
                                    <div class="row getContentData">
                                      
                                    @include('frontend.products.get-selection-aid')


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="accordion" id="accordionThree" style="display:none;">
                        <div class="pacc-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">How wide is your niche?</button>
                            </h2>
                            <div id="collapseThree" class="acc-show accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionThree">
                                <div class="accordion-body">
                                    <div class="row getContentData2">

                                    @include('frontend.products.get-selection-aid2')


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="accordion" id="accordionFour" style="display:none;">
                        <div class="pacc-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Welke stijl zoek je?</button>
                            </h2>
                            <div id="collapseFour" class="acc-show accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionFour">
                                <div class="accordion-body">
                                    <div class="row getContentData3">

                                    @include('frontend.products.get-selection-aid3')


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="accordion" id="accordionFive" style="display:none;">
                        <div class="pacc-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Je hebt jouw douchedeur gevonden!</button>
                            </h2>
                            <div id="collapseFive" class="acc-show accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionFive">
                                <div class="accordion-body">
                                    <div class="row getContentData4">

                                    @include('frontend.products.get-selection-aid4')


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <span class="getNewSec"></span>





                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $(".getAid").click(function() {

            var dataId = $(this).attr("data-id");
            var dataTitle1 = $(this).attr("data-title");
            ///alert(DataId);
            // insertAfter

            $.ajax({
                type: 'get',
                url: 'get-selection-aid',
                cat_id: dataId,
                data: {
                    name: dataTitle1,
                    cat_id: dataId
                },
                success: function(res) {
                    $("#accordionTwo").show();
                    $(".btnOne").attr("aria-expanded", "false");
                    $("#collapseOne").removeClass("show");
                    $("#collapseOne").addClass("hide");

                    //$(".getSec2").empty();
                    $(".getTitle1").text(dataTitle1);
                    $(".getContentData").html(res);
                    // $.each(res, function(index, value) {
                    //     var arr = JSON.parse(res);
                    //     console.log(index, value);
                    //    $(".getSec2").append('<div class="col-lg-4 mb-4 getAidSect" data-id="' + value.id +'" data-title="' + value.title +'"><a href="javascript:void(0)"><div id="pccselect" class="pacc-content newAidSect"><div class="img-hover-zoom"><img src="http://50.116.13.170/glasprofi/frontendassets/images/selection_img.jpg" class="img-fluid" alt=""><h3>' + value.title + '</h3></div></div></a></div>');
                    // });

                }

            });
        });
    });
</script>

<script>
    $(document).on('click', '.getAidSecond', function() {
       
             ///alert('hiii');
            var dataId = $(this).attr("data-id");
            var dataTitle2 = $(this).attr("data-title");
           
            // insertAfter

            $.ajax({
                type: 'get',
                url: 'get-selection-aid2',
                cat_id: dataId,
                data: {
                    name: dataTitle2,
                    cat_id: dataId
                },
                success: function(res) {
                    $("#accordionThree").show();
                    //$(".btnTwo").attr("aria-expanded", "false");
                    $("#collapseTwo").removeClass("show");
                    $("#collapseTwo").addClass("hide");
                    $(".getSec3").empty();
                    $(".getTitle2").text(dataTitle2);
                    $(".getContentData2").html(res);
                    // $.each(res, function(index, value) {
                    //     var arr = JSON.parse(res);
                    //     console.log(index, value);
                    //     $(".getSec3").append('<div class="col-lg-4 mb-4"><a href="javascript:void(0)"><div id="pccselect" class="pacc-content"><div class="img-hover-zoom"><img src="http://50.116.13.170/glasprofi/frontendassets/images/selection_img.jpg" class="img-fluid" alt=""><h3>' + value.title + '</h3></div></div></a></div>');
                    // });

                }

            });
    })
</script>



<script>
    $(document).on('click', '.getAidThird', function() {
       
             ///alert('hiii');
            var dataId = $(this).attr("data-id");
            var dataTitle3 = $(this).attr("data-title");
           
            // insertAfter

            $.ajax({
                type: 'get',
                url: 'get-selection-aid3',
                cat_id: dataId,
                data: {
                    name: dataTitle3,
                    cat_id: dataId
                },
                success: function(res) {
                    $("#accordionFour").show();
                    //$(".btnTwo").attr("aria-expanded", "false");
                    $("#collapseThree").removeClass("show");
                    $("#collapseThree").addClass("hide");
                    $(".getSec3").empty();
                    $(".getTitle3").text(dataTitle3);
                    $(".getContentData3").html(res);
                    // $.each(res, function(index, value) {
                    //     var arr = JSON.parse(res);
                    //     console.log(index, value);
                    //     $(".getSec3").append('<div class="col-lg-4 mb-4"><a href="javascript:void(0)"><div id="pccselect" class="pacc-content"><div class="img-hover-zoom"><img src="http://50.116.13.170/glasprofi/frontendassets/images/selection_img.jpg" class="img-fluid" alt=""><h3>' + value.title + '</h3></div></div></a></div>');
                    // });

                }

            });
    })
</script>


<script>
    $(document).on('click', '.getAidFour', function() {
       
             ///alert('hiii');
            var dataId = $(this).attr("data-id");
            var dataTitle4 = $(this).attr("data-title");
            ///alert(dataId);
            // insertAfter

            $.ajax({
                type: 'get',
                url: 'get-selection-aid4',
                cat_id: dataId,
                data: {
                    name: dataTitle4,
                    cat_id: dataId
                },
                success: function(res) {
                    $("#accordionFive").show();
                    //$(".btnTwo").attr("aria-expanded", "false");
                    $("#collapseFour").removeClass("show");
                    $("#collapseFour").addClass("hide");
                    $(".getSec3").empty();
                    $(".getTitle4").text(dataTitle4);
                    $(".getContentData4").html(res);
                    // $.each(res, function(index, value) {
                    //     var arr = JSON.parse(res);
                    //     console.log(index, value);
                    //     $(".getSec3").append('<div class="col-lg-4 mb-4"><a href="javascript:void(0)"><div id="pccselect" class="pacc-content"><div class="img-hover-zoom"><img src="http://50.116.13.170/glasprofi/frontendassets/images/selection_img.jpg" class="img-fluid" alt=""><h3>' + value.title + '</h3></div></div></a></div>');
                    // });

                }

            });
    })
</script>



@endsection