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

<!--main container-->
<section class="cart-section my-5">
    <div class="container">
        <div class="row">
            @if(session ('message'))
            <div class="alert alert-info">
                {{ session ('message') }}
            </div>
            @endif
            @if(session ('cart_message'))
            <div class="alert alert-info">
                {{ session()->pull('cart_message') }}
            </div>
            @endif
            <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">

                <div class="cart-area">
                    <div class="cart-details">
                        <div class="cart-item">
                            <span class="cart-head">My cart:</span>
                            <span class="c-items">{{$cart_list_count}} item</span>
                        </div>
                        <?php $total_product_amount = 0;  ?>

                        @if(count($product_cart_list)>0)
                        @foreach($product_cart_list as $cart_lists)

                        <div class="cart-all-pro">
                            <div class="cart-pro">
                                <div class="cart-pro-image">
                                    <a href="javascript:void(0)"><img src="{{asset('storage/products/'.$cart_lists->pro_image)}}" width="150" class="img-fluid" alt="image"></a>
                                </div>
                                <div class="pro-details">
                                    <h4><a href="javascript:void(0)">{{$cart_lists->name}}</a></h4>
                                    <span class="pro-size"><span class="size">Levertijd:</span> ± {{$cart_lists->delivery_time}}</span>
                                    <!--<span class="pro-shop">Petro-demo</span> -->
                                    <span class="cart-pro-price">${{$cart_lists->value}}</span>
                                </div>
                            </div>
                            <div class="qty-item">
                                <div class="center">
                                    <div class="plus-minus">

                                        <span>
                                            <!--<a href="javascript:void(0)" class="minus-btn text-black">-</a> -->
                                            @if (Auth::check())
                                            <input type="number" id="pro_cart_qty_{{$cart_lists->cartId}}" name="pro_cart_qty" min="1" max="5" value="{{$cart_lists->pro_cart_qty}}">
                                            @else
                                            <input type="number" id="pro_cart_qty_{{$cart_lists->uniqID}}" name="pro_cart_qty" min="1" max="5" value="{{$cart_lists->quantity}}">
                                            @endif

                                            <!--<a href="javascript:void(0)" class="plus-btn text-black">+</a> -->
                                        </span>
                                    </div>
                                    @if (Auth::check())
                                    <a href="javascript:void(0)" id="update_cart_{{$cart_lists->cartId}}" onclick="update_cart('{{base64_encode($cart_lists->cartId)}}', '{{$cart_lists->cartId}}' )" class="pro-remove">Update</a>
                                    <a href="{{route('user.remove.cartlist', ['cart_id'=>base64_encode($cart_lists->cartId)] )}}" class="pro-remove">Remove</a>
                                    @else
                                    <a href="javascript:void(0)" id="update_cart_{{$cart_lists->uniqID}}" onclick="update_cart('{{base64_encode($cart_lists->uniqID)}}', '{{$cart_lists->uniqID}}' )" class="pro-remove">Update</a>
                                    <a href="{{route('user.remove.cartlist', ['cart_id'=>base64_encode($cart_lists->uniqID)] )}}" class="pro-remove">Remove</a>
                                    @endif
                                </div>
                            </div>
                            @if(Auth::check())
                            <div class="all-pro-price">
                                <span>$ {{$cart_lists->value * $cart_lists->pro_cart_qty}} </span>
                                <?php $total_product_amount += $cart_lists->value * $cart_lists->pro_cart_qty; ?>
                            </div>
                            @else
                            <div class="all-pro-price">
                                <span>$ {{$cart_lists->value * $cart_lists->quantity}} </span>
                                <?php $total_product_amount += $cart_lists->value * $cart_lists->quantity; ?>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <div class="wishlist-all-pro">
                            <div class="wishlist-pro">
                                <h3>Your cart is empty</h3>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="cart-area border-0">
                    <div class="cart-details">
                        <div class="other-link">
                            <ul class="c-link">
                                <!--<li class="cart-other-link"><a href="index.html">Update cart</a></li> -->
                                <li class="cart-other-link"><a href="{{route('home')}}">Continue shopping</a></li>
                                <li class="cart-other-link"><a href="{{route('user.clear.cartlist')}}">Clear cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="cart-total">
                    <div class="cart-price">
                        <span>Subtotal</span>
                        <span class="total">$ {{$total_product_amount}}</span>
                        <input type="hidden" id="cart_pro_total" value="{{ $total_product_amount}}" />
                    </div>
                    <div class="cart-info">
                        <div id="shipping_cart_err_msg"></div>
                        <h4>Shipping info</h4>
                        <form id="cart_country_select" action="{{route('user.checkout')}}">
                            @csrf
                            <label>Country</label>
                            <select id="shipping_country_cart" name="shipping_country_cart" class="form-select" aria-label="Default select example">
                                <!--<select id="country" name="country"> -->
                                <option value="">Select a country</option>
                                @if(count($country)>0)
                                @foreach($country as $countries)
                                <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                                @endforeach
                                @else
                                <option>No country found</option>
                                @endif
                                @error('shipping_country_cart')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror


                            </select>
                            <label>Zip/postal code</label>
                            <input type="text" id="zip_code_cart" name="zip_code_cart" placeholder="Zip/postal code">
                            @error('zip_code_cart')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            <!--</form> -->
                            <a href="javascript:void(0)" id="calculate_total_amount" class="cart-calculate">Calculate</a>
                    </div>

                    <div class="shop-total">
                        <span>Shipping Charge</span>
                        <span class="total-amount" name="shipping_carge_cart" id="shipping_carge_cart">$00.00 CAD</span>
                    </div>
                    <div class="shop-total">
                        <span>Total</span>
                        <span class="total-amount" id="total_amount_cart">$00.00 CAD</span>
                    </div>
                    <!--<a href="{{-- route('user.checkout') --}}" class="check-link">Checkout</a> -->
                    @if($cart_list_count>0)
                    <input type="submit" value="Checkout" class="check-link" />
                    @else
                    <input type="submit" value="Checkout" class="check-link" disabled />
                    @endif

                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
@include('frontend.scripts.cartscript')
@endsection