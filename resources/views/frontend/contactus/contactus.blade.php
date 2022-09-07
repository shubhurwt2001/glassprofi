@extends('frontend/layout')
@section('page_title', 'Contact Us')
@section('home_section', 'active')
@section('container') 

@include('frontend/messages/message')
  <!--breadcrumb section-->
  <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-wrapper-new my-1">
                    <div id="breadcrumb">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main section-->
    <section class="contact-section py-4">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="contactfrom">
                        <form method="post" action="{{route('user.contactus.form.submit')}}">
                            @csrf
                            <div class="row">

                               <!-- <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                            <option>Please choose</option>
                                            <option>Lorem ipsum</option>
                                            <option>Lorem ipsum</option>
                                            </select>
                                        <label for="floatingInput">Salutation</label>

                                        <div class="error">Please Select Salutation</div>

                                    </div>

                                </div> -->

                                <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="first_name" class="form-control" id="floatingName" placeholder="First Name *" value="{{ old('first_name') }}">
                                        <label for="floatingName">First Name</label>
                                        <!--<div class="error">Please Enter First Name</div> -->
                                        @error('first_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}} 
                                             </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="last_name" class="form-control" id="floatingLastName" placeholder="Last Name *" value="{{ old('last_name') }}">
                                        <label for="floatingLastName">Last Name</label>
                                        <!--<div class="error">Please Enter Last Name</div> -->
                                        @error('last_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}} 
                                             </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="phone_number" class="form-control" id="floatingPhoneNumber" placeholder="Phone Number *" value="{{ old('phone_number') }}">
                                        <label for="floatingPhoneNumber">Phone Number</label>
                                        <!--<div class="error">Please Enter Phone Number</div> -->
                                        @error('phone_number')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}} 
                                             </div>
                                        @enderror
                                    </div>
                                </div>

                               <!-- <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingReachability" placeholder="reachability">
                                        <label for="floatingReachability">reachability</label>
                                        <div class="error">Please Enter Reachability</div>

                                    </div>
                                </div> -->

                                <div class="col-lg-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="email" class="form-control" id="floatingReachability" placeholder="E-mail address *" value="{{ old('email') }}">
                                        <label for="floatingReachability">E-mail address *</label>
                                        <!--<div class="error">Please Enter E-mail address</div> -->
                                        @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}} 
                                             </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="your_question" placeholder="Your Question" id="floatingNews" style="height: 100px"></textarea>
                                        <label for="floatingReachability">Your Question</label>
                                        <!--<div class="error">Please type your question</div>-->
                                        @error('your_question')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}} 
                                             </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="submitbutton col-lg-12 justify-content-end d-flex">
                                    <!--<a href="index1.html" class="btn-style1">Send <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>-->
                                    <input type="submit" class="btn-style1" value="Send" />
                                </div>





                            </div>
                        </form>

                    </div>

                </div>

               <!-- <div class="col-lg-12">
                    <div class="addresse mb-5">
                        <span>Telephone : </span><a href="tel:0000000000">0000000000</a>
                        <br>
                        <span>Mail : </span><a href="mailto:example@mail.com">example@mail.com</a>
                        <br>
                        <span>Our service times for you : </span><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>

                    </div>
                </div> -->


            </div>
        </div>




    </section>

    
@endsection