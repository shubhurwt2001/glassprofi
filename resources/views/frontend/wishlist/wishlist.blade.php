@extends('frontend/layout')
@section('page_title', 'My Wishlist')
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
                            <li><span>Wishlist</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->
    <section class="wishlist-section my-5">
        <div class="container">
            <div class="row">
                @if(session ('message'))
                    <div class="alert alert-info">
                        {{ session ('message') }}
                    </div>
                @endif

                <div class="col my-5">
                    <div class="wishlist-area">
                        <div class="wishlist-details">

                            <div class="wishlist-item">
                                <span class="wishlist-head">My wishlist:</span>
                                <span class="wishlist-items">{{ $wish_list_count }} item</span>
                            </div>
                            @if(count($product_wish_list)>0)
                            @foreach($product_wish_list as $wish_lists)
                                <div class="wishlist-all-pro">
                                    <div class="wishlist-pro">
                                        <div class="wishlist-pro-image">
                                            <a href="{{asset('storage/products/'.$wish_lists->pro_image)}}"><img src="{{asset('storage/products/'.$wish_lists->pro_image)}}" width="150" class="img-fluid" alt="image"></a>
                                        </div>
                                        <div class="pro-details">
                                            <h4><a href="{{route($wish_lists->product_route_name, ['product_slug'=>$wish_lists->slug])}}">{{$wish_lists->name}}</a></h4>
                                            <span class="all-size"> Levertijd: <span class="pro-size">± {{$wish_lists->delivery_time}}</span></span>
                                            <!--<span class="wishlist-text">Petro-demo</span> -->
                                        </div>
                                    </div>
                                    <div class="qty-item">
                                        <a href="{{route('product.details', [$wish_lists->slug])}}" class="add-wishlist" >Add to cart</a>
                                        <!--<a href="{{route('user.checkout')}}" class="add-wishlist">Buy now</a>-->
                                    </div>
                                    <div class="all-pro-price">
                                        <span class="new-price">${{$wish_lists->value}}</span>
                                        <!--<span class="old-price"><del>$405.00 USD</del></span> -->
                                        <span><i class="ion-android-close"></i></span>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="wishlist-all-pro">
                                    <div class="wishlist-pro">
                                        <h3>Your wishlist is empty</h3>                                        
                                    </div>
                                </div>
                            @endif
                            

                        </div>
                    </div>

                    <div class="continue-shopping">
                        <div class="wishlist-details">

                            <div class="other-link">
                                <ul class="c-link">
                                    <li class="wishlist-other-link"><a href="{{route('home')}}">Continue shopping</a></li>
                                    <li class="wishlist-other-link"><a href="{{route('user.clear.wishlist')}}">Clear wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    @endsection