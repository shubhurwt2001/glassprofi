<section class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="headre-shipping">
                        <p>Get Up To 80% off In your first Offer!</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <ul>
                        <li><a href="tel:+41 (0) 62 777 59 56"><i class="fa fa-phone"></i>+41 (0) 62 777 59 56</a></li>

                        <li><a href="malito:info@glasschweiz.ch"><i class="fa fa-envelope"></i> info@glasschweiz.ch</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container d-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-top-ul">
                        <ul>
                            <li><i class="fa fa-check"></i> Made in Germany</li>
                            <li><i class="fa fa-check"></i> checkEdelstahlkomponenten</li>
                            <li><i class="fa fa-check"></i> checkPersönliche Ansprechpartner</li>
                            <li><i class="fa fa-check"></i> checkKostenlose & unverbindliche Beratung</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php //$menu =  getTopNavBar(); print_r($menu) ?>

    
    <section class="main-header">
        <div class="container-fluid main-header">
            <div class="row align-items-center">
                <div class="col-lg-2 col-sm-6 float-start">
                    <a href="{{route('home')}}" class="logo"><img src="{{asset('frontendassets/images/logo.png')}}"></a>
                </div>
                
                <div class="col-lg-7">
                    <div class="navigation">
                        <nav>
                            <ul> 
                            <?php //echo "<pre>"; //print_r($allCategories); //die(); ?>
                            @foreach($categories as $category)
                            <li class="dropdown-child">
                                <a href="javascript:void(0);">{{ $category->category_name }}</a>
                                <div class="wrap">
                                <ul class="img_hover">
                                @if(count($category->childs))
                                    @foreach($category->childs as $child)
                                        
                                        <li> 
                                            @if($child->category_route_name != '')
                                                <!--<a href="{{-- route($child->category_route_name, $category->category_slug) --}}">{{-- $child->category_name --}}</a>-->
                                                <a href="{{route($child->category_route_name, ['p_slug' => $category->category_slug, 'c_slug' => $child->category_slug])}}">{{ $child->category_name }}</a>
                                            @else
                                            <a href="javascript:void(0)">{{ $child->category_name }}</a>
                                            @endif
                                            
                                            <img src="{{asset('storage/category/'.$child->category_image)}}" class="imgMenu active">
                                        </li>
                                   @endforeach
                                @endif
                                </ul>
                                </div>
                            </li>
                            @endforeach

                            
                                <!--
                                <li class="dropdown-child">
                                    <a href="javascript:void(0);">Badkamer</a>
                                    <div class="wrap">
                                        <ul class="img_hover">
                                            <li>
                                                <a href="product-configurator.html">Kieshulp badkamer</a>
                                                <img src="{{asset('frontendassets/images/products/img1.jpg')}}" class="imgMenu active">
                                            </li> -->

                                            <!--<li><a href="product_list.html">Douchedeuren</a>
                                                <img src="{{asset('frontendassets/images/products/img2.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Douchewanden</a>
                                                <img src="{{asset('frontendassets/images/products/img3.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Douchecabines</a>
                                                <img src="{{asset('frontendassets/images/products/img4.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Badwanden</a>
                                                <img src="{{asset('frontendassets/images/products/img5.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Wastafelblad</a>
                                                <img src="{{asset('frontendassets/images/products/img6.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Saunadeur</a>
                                                <img src="{{asset('frontendassets/images/products/img7.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Spiegels</a>
                                                <img src="{{asset('frontendassets/images/products/img8.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Achterwand douche</a>
                                                <img src="{{asset('frontendassets/images/products/img9.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Planchet</a>
                                                <img src="{{asset('frontendassets/images/products/img10.webp')}}" class="imgMenu">
                                            </li> -->
                                        <!--
                                        </ul>
                                    </div>
                                </li> -->

                                <!--
                                <li class="dropdown-child">
                                    <a href="javascript:;">Keuken</a>
                                    <div class="wrap">
                                        <ul class="img_hover">
                                            <li>
                                                <a href="#">Bereken in 4 stappen jouw prijs</a>
                                                <img src="{{asset('frontendassets/images/products/img11.jpg')}}" class="imgMenu active">
                                            </li>

                                            <li><a href="#">Keukenachterwand maatwerk</a>
                                                <img src="{{asset('frontendassets/images/products/img12.jpeg')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Keukenachterwand standaard</a>
                                                <img src="{{asset('frontendassets/images/products/img13.webp')}}" class="imgMenu">
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="dropdown-child">
                                    <a href="javascript:;">Deuren</a>
                                    <div class="wrap">
                                        <ul class="img_hover">
                                            <li>
                                                <a href="#">
                                                    Kieshulp deuren</a>
                                                <img src="{{asset('frontendassets/images/products/img14.jpg')}}" class="imgMenu active">
                                            </li>

                                            <li><a href="#">Glazen deuren</a>
                                                <img src="{{asset('frontendassets/images/products/img15.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Aanslagdeuren</a>
                                                <img src="{{asset('frontendassets/images/products/img16.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Pendeldeuren</a>
                                                <img src="{{asset('frontendassets/images/products/img17.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Schuifdeuren</a>
                                                <img src="{{asset('frontendassets/images/products/img18.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Taatsdeuren</a>
                                                <img src="{{asset('frontendassets/images/products/img19.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Schuifwanden</a>
                                                <img src="{{asset('frontendassets/images/products/img20.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Ensuite deuren</a>
                                                <img src="{{asset('frontendassets/images/products/img21.webp')}}" class="imgMenu">
                                            </li>

                                            <li><a href="#">Industriële deuren</a>
                                                <img src="{{asset('frontendassets/images/products/img22.webp')}}" class="imgMenu">
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="dropdown-child">
                                    <a href="javascript:;">Accessoires</a>
                                    <div class="wrap">
                                        <ul class="img_hover">
                                            <li>
                                                <a href="#">Glasprofile</a>
                                                <img src="{{asset('frontendassets/images/img1.jpg')}}" class="imgMenu active">
                                            </li>
                                            <li>
                                                <a href="#">Glasplattenhalter und -klemmen</a>
                                                <img src="{{asset('frontendassets/images/img2.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Befestigungsmaterial Glasplatten</a>
                                                <img src="{{asset('frontendassets/images/img3.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Spiegelklemmen</a>
                                                <img src="{{asset('frontendassets/images/img4.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Spiegelheizung</a>
                                                <img src="{{asset('frontendassets/images/img5.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Stabilisatorstange</a>
                                                <img src="{{asset('frontendassets/images/img6.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Dichtungsprofile Duschtür</a>
                                                <img src="{{asset('frontendassets/images/img7.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Schwallschutz</a>
                                                <img src="{{asset('frontendassets/images/img8.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Türbeschläge</a>
                                                <img src="{{asset('frontendassets/images/img9.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Werkzeug</a>
                                                <img src="{{asset('frontendassets/images/img10.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Kit</a>
                                                <img src="{{asset('frontendassets/images/img11.jpg')}}" class="imgMenu">
                                            </li>
                                            <li>
                                                <a href="#">Pflegeprodukte</a>
                                                <img src="{{asset('frontendassets/images/img12.jpg')}}" class="imgMenu">
                                            </li>
                                        </ul>
                                    </div>
                                </li> -->

                            </ul> 
                        </nav>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6 float-end">
                    <div class="headre-account">
                        <ul class="d-flex justify-content-end align-items-center">
                            <li><a href="javascript:void(0)"><i class="fa fa-search"></i></a></li>
                            @auth
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out"></i></a></li>
                                <li><a href="{{route('user.wishlist')}}"><i class="fa fa-heart"></i></a><span class="wishlist_count">{{ $total_wishlist_item }}</span></li>
                                <li><a href="{{route('user.cart')}}"><i class="fa fa-shopping-cart"></i></a><span class="cart_count"  >{{ $total_cart_itme }}</span></li>
                            @else
                                <li><a href="{{route('user.login')}}"><i class="fa fa-user"></i></a></li>
                                <li><a href="{{route('user.wishlist')}}"><i class="fa fa-heart"></i></a><span class="wishlist_count">{{ $total_wishlist_item}}</span></li>
                                <li><a href="{{route('user.cart')}}"><i class="fa fa-shopping-cart"></i></a><span class="cart_count">{{ $total_cart_itme }}</span></li>
                            @endauth
                            

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    

        <!-- Start serch box area -->
        <div class="predictive__search--box">
            <div class="predictive__search--box__inner">
                <h2 class="predictive__search--title">Search Products</h2>
                <form class="predictive__search--form" action="#">
                    <label>
                        <input class="predictive__search--input" placeholder="Search Here" type="text">
                    </label>
                    <button class="predictive__search--button primary__btn" aria-label="search button"><svg
                            class="header__search--button__svg" xmlns="http://www.w3.org/2000/svg" width="30.51"
                            height="25.443" viewBox="0 0 512 512">
                            <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none"
                                stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                stroke-width="32" d="M338.29 338.29L448 448" />
                        </svg> </button>
                </form>
            </div>
            <button class="predictive__search--close__btn " aria-label="search close btn">
                <svg class="predictive__search--close__icon" xmlns="http://www.w3.org/2000/svg" width="40.51"
                    height="30.443" viewBox="0 0 512 512">
                    <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                </svg>
            </button>
        </div>
        <!-- End serch box area -->
    </section>

    