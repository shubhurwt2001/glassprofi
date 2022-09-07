
    <footer class="footer__section footer__bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-widget">
                        <h3>Zahlungsarten</h3>

                        <ul class="payment-method">
                            <li><img src="{{asset('frontendassets/images/payment-img2.png')}}" alt="" class="img-fluid"></li>
                            <li><img src="{{asset('frontendassets/images/payment-img1.png')}}" alt="" class="img-fluid"></li>
                            <li><img src="{{asset('frontendassets/images/payment-img3.png')}}" alt="" class="img-fluid"></li>
                            <li><img src="{{asset('frontendassets/images/payment-img4.png')}}" alt="" class="img-fluid"></li>
                            <li><img src="{{asset('frontendassets/images/payment-img5.png')}}" alt="" class="img-fluid"></li>
                            <li><img src="{{asset('frontendassets/images/payment-img6.png')}}" alt="" class="img-fluid"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-widget">
                        <a href="#"><img src="images/logo.png"></a>
                        <p>Glasschweiz GmbH, ist eine Tochtergesellschaft der Steinfort Glas.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2 class="widget-title">Account Info</h2>
                        <ul>
                            @auth
                                <li><a href="{{route('user.logout')}}">Logout</a></li>
                                <li><a href="{{route('user.checkout')}}">checkout</a></li>
                                <li><a href="{{route('user.account')}}">My Account</a></li>
                                <li><a href="{{route('user.cart')}}">cart</a></li>
                            @else
                            <li><a href="{{route('user.login')}}">login</a></li>
                            <li><a href="{{route('user.register')}}">Register</a></li>
                            @endauth

                           
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2 class="widget-title">Quick Links</h2>
                        <ul>
                            <li><a href="{{route('user.inspiratinen')}}">Inspirationen</a></li>
                            <li><a href="{{route('user.aboutus')}}">Über uns</a></li>
                            <li><a href="{{route('user.kostenlose.testmuster')}}">Kostenlose Testmuster</a></li>
                            <li><a href="{{route('user.messservice')}}">Messservice</a></li>
                            <li><a href="{{route('user.contactus')}}">Kontakt</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">

                    </div>
                </div>
            </div>

            <div class="divider">
                <hr>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="footer-widget">
                        <h2>Social Media</h2>
                        <ul class="social">
                            <li>
                                <a href="#" target="_blank"><img src="{{asset('frontendassets/images/facebook.png')}}" alt="" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><img src="{{asset('frontendassets/images/youtube.png')}}" alt="" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><img src="{{asset('frontendassets/images/instagram.png')}}" alt="" class="img-fluid"></a>
                            </li>
                            <li>
                                <a href="#" target="_blank"><img src="{{asset('frontendassets/images/pintrest.png')}}" alt="" class="img-fluid"></a>
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h2 class="widget-title">Newsletter</h2>
                        <p>Get updates by subscribe our weekly newsletter</p>
                        <form>
                            <input type="text" placeholder="Email">
                            <button class="primary__btn">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row footer--bottom">
                <div class="col-lg-12 text-center">
                    <p>Copyright © 2022 Glasschweiz</p>
                </div>
            </div>
        </div>
    </footer>
