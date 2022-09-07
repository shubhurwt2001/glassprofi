
@extends('frontend/layout')
@section('page_title', 'Product Configurator')
@section('home_section', 'active')
@section('meta_title', $child_select_category[0]->nav_meta_title)
@section('meta_keywords', $child_select_category[0]->nav_meta_keyword)
@section('meta_description', $child_select_category[0]->nav_meta_description)
@section('container') 


 <!--breadcrumb section-->
 <section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="breadcrumb-wrapper-new my-1">
                <div id="breadcrumb">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/">{{$parent_category[0]->category_name}}</a></li>
                        <li><span>{{$child_select_category[0]->category_name}}</span></li>
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

                    <div class="col-lg-12">
                        <div class="filter widget">
                            <!--<h3>Bathroom</h3>-->
                            <h3>{{$parent_category[0]->category_name}}</h3>
                            <ul>
                                @if($child_category->count()>0)
                                @foreach($child_category as $child_categories)
                                <?php $active=""; if($child_select_category[0]->id == $child_categories->id){$active = 'active';}else{$active="";}  ?>
                                    <li class="{{$active}}">
                                        @if($child_categories->category_route_name != '')
                                            <!--<a href="{{-- route($child_categories->category_route_name, $child_categories->category_slug)--}}" title="{{-- $child_categories->category_name --}}">{{-- $child_categories->category_name --}}<span class="filter-badge"> ({{-- $child_categories->productlist_count --}}) </span></a>-->
                                            <a href="{{route($child_categories->category_route_name, ['p_slug' => $parent_category[0]->category_slug, 'c_slug' => $child_categories->category_slug])}}" title="{{$child_categories->category_name}}">{{$child_categories->category_name}}<span class="filter-badge"> ({{$child_categories->productlist_count}}) </span></a>
                                        @else
                                            <a href="javascript:void(0)" title="{{$child_categories->category_name}}">{{$child_categories->category_name}}<span class="filter-badge"> ({{$child_categories->productlist->count()}}) </span></a>
                                         @endif
                                        <!--<a href="{{-- route($child_categories->category_route_name, $child_categories->category_slug) --}}" title="Douchedeuren">{{-- $child_categories->category_name --}}<span class="filter-badge"> ({{-- $child_categories->productlist->count() --}}) </span></a>-->
                                    </li>    
                                @endforeach()
                                @else
                                    <p>No category added yet</p>
                                @endif
                                <!--<li class="active"><a href="" title="Douchedeuren">Shower doors<span class="filter-badge"> (14)</span></a></li>
                                <li class=""><a href="" title="Douchewanden">Lorem Ipsum<span class="filter-badge"> (12)</span></a></li>
                                <li class=""><a href="" title="Douchecabines">Lorem Ipsum<span class="filter-badge"> (14)</span></a></li>
                                <li class=""><a href="" title="Badwanden">Lorem Ipsum<span class="filter-badge"> (8)</span></a></li>
                                <li class=""><a href="" title="Wastafelblad">Lorem Ipsum<span class="filter-badge"> (1)</span></a></li>
                                <li class=""><a href="" title="Saunadeur">SaunaLorem Ipsumdeur<span class="filter-badge"> (1)</span></a></li>
                                <li class=""><a href="" title="Spiegels">Lorem Ipsum<span class="filter-badge"> (10)</span></a></li>
                                <li class=""><a href="" title="Planchets">Lorem Ipsum<span class="filter-badge"> (2)</span></a></li>
                                <li class=""><a href="" title="Achterwand douche">Lorem Ipsum<span class="filter-badge"> (2)</span></a></li> -->

                            </ul>
                        </div>
                    </div>

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
                    @if($child_select_category[0]->category_image != "")
                            <img src="{{asset('storage/category/'.$child_select_category[0]->category_image)}}" class="img-fluid " alt="">
                        @else
                            <p> No Image available</p>
                        @endif
                        <!--<img src="{{asset('frontendassets/images/douchedeuren-0721-46360.webp')}}" class="img-fluid " alt="">-->
                    </div>
                    <div class="col-lg-6">
                        @if($child_select_category[0]->nav_short_desc != "")
                            <p> {!! $child_select_category[0]->nav_short_description !!} </p>
                            
                        @else
                            <p> No description available</p>
                        @endif

                    </div>
                </div>


                <!--products list-->

                <div class="row my-5">
                    @if($poducts->count()>0)
                    @foreach($poducts as $lists)
                    <div class="col-lg-4 col-md-6 productblock mb-4">
                        <a href="{{route($lists->product_route_name, ['product_slug'=>$lists->slug])}}">
                            <div class="aproduct">
                                <div class="image-wrapper">
                                    <img class="b-lazy b-loaded" src="{{asset('storage/products/'.$lists->pro_image)}}" class="img-fluid" alt="Tessa">
                                </div>
                                <div class="aproduct_content">
                                    <h5 class="aproduct-title">{{$lists->name}}</h5>
                                    <h6 class="aproduct-description">{{$lists->title}}</h6>
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
                        <p>No Proudct added yet</p>
                    @endif


                    <div class="col-lg-12">
                        <div class="description">
                        @if($child_select_category[0]->nav_desc != "")
                             {!! $child_select_category[0]->nav_description !!}
                            
                        @else
                            <p> No description available</p>
                        @endif
                            <!--
                            <h6>What is Lorem Ipsum?</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <h6>What is Lorem Ipsum?</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>


                            <ul>
                                <li>Lorem Ipsum is simply dummy text</li>
                                <li>Lorem Ipsum is simply dummy text</li>
                                <li>Lorem Ipsum is simply dummy text</li>
                                <li>Lorem Ipsum is simply dummy text</li>
                                <li>Lorem Ipsum is simply dummy text</li>
                            </ul>

                            <div class="videos mt-5 mb-5">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="https://www.youtube.com/embed/nEzFHiGJM6g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>


                            <h6>What is Lorem Ipsum?</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <h6>What is Lorem Ipsum?</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>





                            <h6>Veelgestelde vragen</h6>
                            <div id="faq-accordion" class="category-faq panel-group">
                                <h5><strong>Douchedeuren</strong></h5>

                                <div class="faq-start position-relative">
                                    <div class="accordion">
                                        <a href="#collapse-1" data-bs-toggle="collapse" class="collapse-title my-2">How are items packaged? <i class="fa fa-chevron-down" aria-hidden="true"></i> </a>
                                        <div class="collapse collapse-content" id="collapse-1">
                                            <p>All items are carefully packaged as to avoid any form of damage.</p>
                                        </div>
                                    </div>
                                    <div class="accordion">
                                        <a href="#collapse-2" data-bs-toggle="collapse" class="collapse-title my-2">How are items packaged? <i class="fa fa-chevron-down" aria-hidden="true"></i> </a>
                                        <div class="collapse collapse-content" id="collapse-2">
                                            <p>All items are carefully packaged as to avoid any form of damage.</p>
                                        </div>
                                    </div>
                                    <div class="accordion">
                                        <a href="#collapse-3" data-bs-toggle="collapse" class="collapse-title my-2">How are items packaged? <i class="fa fa-chevron-down" aria-hidden="true"></i> </a>
                                        <div class="collapse collapse-content" id="collapse-3">
                                            <p>All items are carefully packaged as to avoid any form of damage.</p>
                                        </div>
                                    </div>
                                    <div class="accordion">
                                        <a href="#collapse-4" data-bs-toggle="collapse" class="collapse-title my-2">How are items packaged? <i class="fa fa-chevron-down" aria-hidden="true"></i> </a>
                                        <div class="collapse collapse-content" id="collapse-4">
                                            <p>All items are carefully packaged as to avoid any form of damage.</p>
                                        </div>
                                    </div>




                                </div>





                            </div> -->
                        </div>


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
                    </div>
                </div>







            </div>
        </div>
</section>




@endsection