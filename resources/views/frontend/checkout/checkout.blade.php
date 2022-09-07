@extends('frontend/layout')
@section('page_title', 'Checkout')
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
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--main container-->

<section class="sheckout-section my-5">
    <div class="container">
        <div class="row">
            <div class="col mb-5">
                <div class="checkout-area">
                    <div class="billing-area">

                        <form action="{{route('place.order')}}" method="post">
                            @csrf
                            <h2>Billing details</h2>
                            <div class="billing-form">
                                <ul class="billing-ul input-2">
                                    <li class="billing-li">
                                        <label>First name</label>
                                        <input type="text" id="f_name" name="f_name" placeholder="First name">
                                        <div class="invalid-feedback"></div>
                                        @error('f_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                    <li class="billing-li">
                                        <label>Last name</label>
                                        <input type="text" id="l_name" name="l_name" placeholder="Last name">
                                        <div class="invalid-feedback"></div>
                                        @error('l_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                </ul>
                                <ul class="billing-ul">
                                    <li class="billing-li">
                                        <label>Company name (Optional)</label>
                                        <input type="text" id="company_detail" name="company_detail" placeholder="Company name">
                                        <div class="invalid-feedback"></div>
                                    </li>
                                </ul>
                                
                                <ul class="billing-ul">
                                    <li class="billing-li">
                                        <label>Street address</label>
                                        <input type="text" id="address" name="address" placeholder="Street address">
                                        <div class="invalid-feedback"></div>
                                        @error('address')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                </ul>
                                <ul class="billing-ul">
                                    <li class="billing-li">
                                        <label>Apartment,suite,unit etc. (Optional)</label>
                                        <input type="text" id="apartment" name="apartment" placeholder="">
                                    </li>
                                </ul>
                                <ul class="billing-ul">
                                    <li class="billing-li">
                                        <label>Town / City</label>
                                        <input type="text" id="city" name="city" placeholder="">
                                        <div class="invalid-feedback"></div>
                                        @error('city')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                </ul>
                                <ul class="billing-ul">
                                    <li class="billing-li">
                                        <label>State</label>
                                        <input type="text" id="state" name="state" placeholder="">
                                        <div class="invalid-feedback"></div>
                                        @error('state')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                </ul>
                                <!--
                                    <ul class="billing-ul">
                                        <li class="billing-li">
                                            <label>Postcode / ZIP</label>
                                            <input type="text" id="postcode" name="postcode" placeholder="">
                                            <div class="invalid-feedback"></div>
                                            @error('postcode')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}} 
                                                </div>
                                            @enderror
                                        </li>
                                    </ul> -->
                                <ul class="billing-ul input-2">
                                    <li class="billing-li">
                                        <label>Email address</label>
                                        <input type="text" id="mail" name="mail" placeholder="Email address">
                                        <div class="invalid-feedback"></div>
                                        @error('mail')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                    <li class="billing-li">
                                        <label>Phone</label>
                                        <input type="text" id="phone" name="phone" placeholder="Phone">
                                        <div class="invalid-feedback"></div>
                                        @error('phone')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </li>
                                </ul>
                            </div>

                            <div class="billing-details">

                                <h2>Shipping details</h2>
                                <ul class="shipping-form">
                                    <!--<li class="check-box">
                                            <input type="checkbox" name="--">
                                            <label>Ship to a different address?</label>
                                        </li> -->
                                    <li class="comment-area">
                                        <label>Order notes(Optional)</label>
                                        <textarea id="order_notes" name="order_notes" rows="4"></textarea>
                                    </li>
                                </ul>


                            </div>
                    </div>
                    <div class="order-area">
                        <div class="check-pro">
                            <h2>Total Items In your cart ({{$cart_list_count}})</h2>
                            <!--<ul class="check-ul">
                                    <li>
                                        <div class="check-pro-img">
                                            <a href="product.html"><img src="{{asset('frontendassets/images/img1.jpg')}}" width="99" class="img-fluid" alt="image"></a>
                                        </div>
                                        <div class="check-content">
                                            <a href="product.html">Fresh healthy food</a>
                                            <span class="check-code-blod">Product code: <span>CA70051541B</span></span>
                                            <span class="check-price">$00.00</span>
                                        </div>
                                    </li>

                                </ul> -->
                        </div>
                        <h2>Your order</h2>
                        <ul class="order-history">
                            <li class="order-details">
                                <span>Product:</span>
                                <span>Price:</span>
                                <span>Quantity:</span>
                                <span>Total:</span>
                            </li>
                            @if(count($product_cart_list)>0)
                            @foreach($product_cart_list as $lists)
                            <li class="order-details">
                                <span>{{$lists->name}}</span>

                                <span>{{$lists->value}}</span>

                                <span>{{$lists->pro_cart_qty}}</span>

                                <span>{{$lists->value*$lists->pro_cart_qty}}</span>

                            </li>
                            @endforeach
                            @endif
                            <!--<li class="order-details">
                                    <span>Orange juice:</span>
                                    <span>$00.00</span>
                                </li>
                                <li class="order-details">
                                    <span>Shrimp jumbo:</span>
                                    <span>$00.00</span>
                                </li>
                                <li class="order-details">
                                    <span>Subtotal:</span>
                                    <span>$00.00</span>
                                </li>-->
                            <li class="order-details">
                                <span>Sub Total:</span>
                                <span>${{$getCartTotalamount}}</span>

                            </li>
                            <li class="order-details">
                                <span>Shipping Charge:</span>
                                <span>{{ $checkout_shipping_charge[0]->shipping_charge }}</span>
                            </li>
                            <li class="order-details">
                                <span>Total:</span>
                                <span>${{$grand_total}}</span>

                            </li>
                        </ul>

                        <ul class="order-form">
                            <!-- <li>
                                        <input type="checkbox" name="--">
                                        <label>Direct bank transfer</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="--">
                                        <label>Cheque payment</label>
                                    </li> -->
                            <li>
                                <input type="checkbox" name="paypal" id="paypal">
                                <label>Paypal</label>
                            </li>
                            <li class="pay-icon">
                                <a href="javascript:void(0)"><i class="fa fa-credit-card"></i></a>
                                <a href="javascript:void(0)"><i class="fa fa-cc-visa"></i></a>
                                <a href="javascript:void(0)"><i class="fa fa-cc-paypal"></i></a>
                                <a href="javascript:void(0)"><i class="fa fa-cc-mastercard"></i></a>
                            </li>
                        </ul>

                        <div class="checkout-btn">
                            <!--<a href="javascript:void(0)" class="btn-style1">Place order</a> -->
                            @if($getCartTotalamount>0)
                            <input type="submit" class="btn-style1">
                            @else
                            <input type="submit" class="btn-style1" disabled>
                            @endif

                        </div>
            
                        <input type="hidden" name="country" value="{{$checkout_shipping_charge[0]->countries_id}}" />
                        <input type="hidden" name="postcode" value="{{$checkout_shipping_charge[0]->postal_code}}" />
            


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection