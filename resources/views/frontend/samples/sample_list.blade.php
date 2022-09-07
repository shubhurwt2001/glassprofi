
@extends('frontend/layout')
@section('page_title', 'Sample product')
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
                        <li><a href="javascript:void(0)">Gratis proefmonsters</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--main section-->

<section class="main-content-container">
    <div class="container">
        <div class="row mt-5">

            <div class="col-lg-3 leftsidebar">
                <div class="row">

                   

                    <div class="col-lg-12 my-5">
                        <div class="productfilter">
                            <div class="filter-accordion-title"><b>Filters</b></div>

                            <div class="widget-content">
                                <ul id="accordion">
                                    <li>
                                        <hr>
                                        <h4>Lorem Ipsum <span class="plusminus">-</span></h4>
                                        <ul class="checkbox">
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                        </ul>
                                    </li>


                                    <li>
                                        <hr>
                                        <h4>Lorem Ipsum <span class="plusminus">-</span></h4>
                                        <ul class="checkbox">
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="id1">
                                                <label for="id1">Lorem Ipsum <span> (14)</span></label>
                                            </li>
                                        </ul>
                                    </li>


                                </ul>
                            </div>








                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-9 rightsidebar">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{asset('storage/sampleproducts/Packenzo-137lowres-52911.webp')}}" class="img-fluid " alt="">
                    </div>
                    <div class="col-lg-6">
                        
                            <p> Gratis proefmonsters </p>
                                                  
                            <p> Ben je nog niet helemaal zeker van de glassoort of de glaskleur? Bestel dan onze proefmonsters, zodat je ze thuis rustig kan bekijken. Je kan tot 4 gratis proefmonsters bestellen. Wij zorgen er dan voor dat je de proefmonsters binnen een paar dagen thuis ontvangt. </p>
                        

                    </div>
                </div>


                <!--products list-->

                <div class="row my-5">
                    @if(count($sample_product)>0)
                    @foreach($sample_product as $lists)
                    <div class="col-lg-4 col-md-6 productblock mb-4">
                        <a href="{{route('sample.product', ['sample_product_slug'=>base64_encode($lists->slug)])}}">
                            <div class="aproduct">
                                <div class="image-wrapper">
                                    <img class="b-lazy b-loaded" src="{{asset('storage/products/'.$lists->pro_image)}}" class="img-fluid" alt="Tessa">
                                </div>
                                <div class="aproduct_content">
                                    <h5 class="aproduct-title">{{$lists->name}}</h5>
                                    
                                    <p class="price"><strong>$</strong>{{$lists->value}},-</p>
                                    <!--<div class="aproduct_rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>(4)
                                    </div> -->

                                    <div class="aproduct_specification">
                                        <i class="icon-levertijd inline-visibleonmobile"></i>
                                        <b class="inline-hiddenonmobile"> Levertijd:</b>&nbsp;± {{$lists->delivery_time}} werkdagen
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @else
                        <p>No sample proudct available</p>
                    @endif


                    <!--<div class="col-lg-12">
                        


                        <div class="row">
                            <div class="col-lg-12 mt-5">
                                <h2 class="blog-heading">What is Lorem Ipsum?</h2>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="product-blog">
                                    <a href="">
                                        <div class="blog-img">
                                            <img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="blog-title">
                                            <h2>What is Lorem Ipsum?</h2>
                                        </div>
                                        <div class="blog-content">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                            <a href="" class="readmore">read more</a>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div> -->
                </div>







            </div>
        </div>
</section>




@endsection