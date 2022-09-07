@extends('frontend/layout')
@section('page_title', 'About us')
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
                            <li><span>Über uns</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--main container-->

    <section class="about-section my-5">
        <div class="container">
            <div class="row">
                <div class="col wow fadeInDown animated">
                    <div class="about-title">
                        <h1 class="heading-title">Lorem Ipsum Lorem Ipsum Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed libero vel ex maximus vulputate nec eu ligula. Vestibulum elementum nisi ut fermentum lobortis. Sed quis iaculis felis.</p>
                        <img src="{{asset('frontendassets/images/img10.jpg')}}" class="p-image img-fluid w-100" alt="pro-image">
                    </div>
                    <br>
                    <div class="about-details">
                        <p>There is something about the saree that makes a woman look dignified, glorifying and every bit stylish. Mikshaa was set up in the year 2017 with a motive to offer its designer collection at competitive price and merchantable quality
                            to its whole seller and worldwide online customer.</p>
                        <p>No matter what your individual style may be, you are sure to find a beautiful saree that will match your taste, given the large collection of stunning Indian sarees that can be worn almost on all the occasions be it wedding, formal
                            parties, Bridal, family get togethers and more!</p>
                        <p>Mikshaa is the trusted online ethnic wears store and feels proud in Indian heritage and cultural diversity in women wears. With so many different styles of drape, so many different patterns and fabric choices, sarees can fill every
                            wardrobe with much needed variety. When in doubt, it’s your best bet at looking elegant and put-together. Every state in India and worldwide are put together to cater best in terms of Indian fashion trends and women clothing
                            range.
                        </p>
                        <p>Mikshaa goals is the all worldwide delivered to ethnic wears for women. Celebrate big fat Indian occasions such as Diwali, Navratri, Durga Puja, Holi and marriage celebration with our evergreen collection of online Indian ethnic
                            wears for women. A wide Variety of option are available at the click of mouse.</p>
                        <p>Mikshaa is a great online destination to explore its extraordinary collection for sarees and other ehnic wears the best part is the site has the most competitive price and a wide eclectic range of products guaranteed to satisfy
                            every customer. Mikshaa ensures excellent delivery services to its buyer in a good condition and in a prompt manner.</p>
                        <p>Mikshaa collection is also available in the overseas market (USA, UK, Europe, Australia, Southeast Asia, Dubai, Srilanka and other countries) under the brand name of Mikshaa.</p>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-12 my-5">
                    <h1 class="heading-title text-center">Lorem Ipsum </h1>

                </div>

                <div class="col-lg-6 wow fadeInLeft animated">
                    <img src="{{asset('frontendassets/images/img10.jpg')}}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 wow fadeInRight animated">
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                        using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                        sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                </div>


            </div>


        </div>
    </section>

    <section class="processing-section py-4">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 text-center my-4">
                    <div class="processing-title">
                        <h1>Lorem Ipsum</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="processing">
                <div class="processing-row  row d-flex justify-content-center">

                    <div class="processing-item col-lg-2 text-center">
                        <button type="button" class="btn btn-circle border"><i class="fa fa-user" aria-hidden="true"></i></button>
                        <h5>advisory</h5>
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                    </div>
                    <div class="processing-item col-lg-2 text-center">
                        <button type="button" class="btn btn-circle border"><i class="fa fa-file-text" aria-hidden="true"></i></button>
                        <h5>offer</h5>
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                    </div>
                    <div class="processing-item col-lg-2 text-center">
                        <button type="button" class="btn btn-circle border"><i class="fa fa-product-hunt" aria-hidden="true"></i></button>
                        <h5>production</h5>
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                    </div>
                    <div class=" processing-item col-lg-2 text-center">
                        <button type="button" class="btn btn-circle border"><i class="fa fa-truck" aria-hidden="true"></i></button>
                        <h5>delivery</h5>
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                    </div>
                    <div class=" processing-item col-lg-2 text-center">
                        <button type="button" class="btn btn-circle border"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                        <h5>Assembly</h5>
                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
                    </div>
                </div>
            </div>
        </div>

    </section>


    @endsection