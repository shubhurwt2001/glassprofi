
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
                            <li><span>Create account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->
    <div class="login-section my-5">
        <div class="container">
            <div class="row">

                <div class="col py-5">
                    <div class="register-area">
                        <div class="register-box">
                            <h1>Create account</h1>
                            <p>Please register below account detail</p>
                            <form method="post" action="{{route('user.registeration')}}">
                                @csrf
                                <input type="text" name="first_name" placeholder="Firts name" value={{old('first_name')}}>
                                @error('first_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <input type="text" name="last_name" placeholder="Last name" value={{old('last_name')}}>
                                @error('last_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <input type="email" name="email" placeholder="Email" value={{old('email')}}>
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <input type="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}} 
                                     </div>
                                @enderror
                                <!--<a href="account.html" class="btn-style1">Create</a> -->
                                <input type="submit" class="btn-style1" value="Create" />
                            </form>
                        </div>
                        <div class="register-account">
                            <h4>Already an account holder?</h4>
                            <a href="{{route('user.login')}}" class="ceate-a">Log in</a>
                            <div class="register-info">
                                <a href="terms-conditions.html" class="terms-link"><span>*</span> Terms &amp; conditions.</a>
                                <p>Your privacy and security are important to us. For more information on how we use your data read our <a href="privacy-policy.html">privacy policy</a></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection