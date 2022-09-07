@extends('frontend/layout')
@section('page_title', 'My Cart')
@section('home_section', 'active')
@section('container')
<!--breadcrumb section-->
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="breadcrumb-wrapper-new my-1">
                <div id="breadcrumb">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cart-section my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mainWrapper">
                    <div class="statusBar">
                        <span class="pBar w-100"></span>
                        <div class="node n0 done nConfirm0">
                            <div class="main done m0 done nConfirm0"></div>
                            <span class="text t0 done nConfirm0">SHOPPING CART</span>
                        </div>
                        <div class="node n1 done nConfirm1">
                            <div class="main done m1 nConfirm1"></div>
                            <span class="text done t1 nConfirm1">FACTS</span>
                        </div>
                        <div class="node n2 done nConfirm2">
                            <div class="main done m2 nConfirm2"></div>
                            <span class="text done t2 nConfirm2">PAYMENT METHOD</span>
                        </div>
                        <div class="node n3 done nConfirm3">
                            <div class="main done m3 nConfirm3"></div>
                            <span class="text done t3 nConfirm3">COMPLETE</span>
                        </div>
                        <div class="node n4 done nConfirm4">
                            <div class="main m4 done nConfirm4"></div>
                            <span class="text t4 done nConfirm4">PAY</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 the-content mt-5">
                <ul class="check-list mt-5">
                    <li>
                        <h1>
                            {{$msg}}
                        </h1>
                    </li>
                </ul>
                <hr>
                <!-- <a href="#" class="btn shopping-btn">Direct pay </a> -->
            </div>
        </div>

    </div>
    </div>
</section>
@endsection


@section('scripts')
@include('frontend.scripts.cartscript')

@endsection