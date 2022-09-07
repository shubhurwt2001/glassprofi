
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
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><span>Login</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->
    <section class="login-section my-5">
        <div class="container">
            <div class="row">
            @if(session ('loginerror'))
                <div class="alert alert-info">
                    {{ session ('loginerror') }}
                </div>
             @endif
            
             @if(session ('wishlist'))
                <div class="alert alert-danger">
                    {{ session()->pull('wishlist') }}
                </div>
             @endif
             @if(session ('cart'))
                <div class="alert alert-danger">
                    {{ session()->pull('cart') }}
                </div>
             @endif
            
                <div class="col my-5">
                    <div class="login-area">
                        <div class="login-box">
                            <h1>Login</h1>
                            <p>Please login below account detail</p>
                            <form action="{{route('user.signin')}}" method="post">
                                @csrf
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Email">
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <div class="social-login d-flex justify-content-center">
                                    <!--<a href="login.html" class="btn btn-login"><span><i class="fa fa-envelope" aria-hidden="true"></i></span>Gmail</a>-->
                                   <!--<div class="g-signin2 btn-login" data-onsuccess="gmailLogIn"></div>-->
                                   <div class="btn-login" id="login_by_gmail"></div> 
                                   
                                   
                                    <a href="login.html" class="btn btn-login"><span><i class="fa fa-facebook-official" aria-hidden="true"></i></span>Facebook</a>
                                </div>

                                <!--<a href="login.html" class="btn-style1">Sign in</a> -->
                                <input type="submit" class="btn-style1" value="Sign in" />
                                <a href="forgot-password.html" class="re-password">Forgot your password?</a>
                            </form>
                        </div>
                        <div class="login-account">
                            <h4>Don't have an account?</h4>
                            <a href="{{route('user.register')}}" class="ceate-a">Create account</a>
                            <div class="login-info">
                                <a href="terms-conditions.html" class="terms-link"><span>*</span> Terms &amp; conditions.</a>
                                <p>Your privacy and security are important to us. For more information on how we use your data read our <a href="privacy-policy.html">privacy policy</a></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


@endsection