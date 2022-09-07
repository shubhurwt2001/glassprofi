@extends('frontend/layout')
@section('page_title', 'My Account')
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
                            <li><span>Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->
    <section class="shipping-area my-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="account-title">
                        <h1>Welcome Vegist</h1>
                    </div>
                    <div class="account-area">
                        <div class="account">
                            <h4>My account</h4>
                            <ul class="page-name">
                                <li class="register-id"><a href="wishlist.html">Wishlist(0)</a></li>
                                <li class="register-id"><a href="addresses.html">View addresses(0)</a></li>
                                <li class="register-id"><a href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <div class="account-detail">
                            <h4>Account details</h4>
                            <ul class="a-details">
                                <li>Andrew louise</li>
                                <li class="mail-register">andrew@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="order-details">
                        <h4>Order history</h4>
                        <p>You haven't placed any orders yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection