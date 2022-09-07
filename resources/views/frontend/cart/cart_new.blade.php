@extends('frontend/layout')
@section('page_title', 'My Cart')
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
                        <li><span>Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--main container-->
<section class="cart-section my-5">
    <div class="container">
        <div class="row">
            @if(count($product_cart_list) > 0)
            <div class="col-lg-12">
                <div class="mainWrapper">
                    <div class="statusBar">
                        <span class="pBar"></span>
                        <div class="node n0 done nConfirm0">
                            <div class="main done m0 done nConfirm0"></div>
                            <span class="text t0 done nConfirm0">SHOPPING CART</span>
                        </div>
                        <div class="node n1 nConfirm1">
                            <div class="main m1 nConfirm1"></div>
                            <span class="text t1 nConfirm1">FACTS</span>
                        </div>
                        <div class="node n2 nConfirm2">
                            <div class="main m2 nConfirm2"></div>
                            <span class="text t2 nConfirm2">PAYMENT METHOD</span>
                        </div>
                        <div class="node n3 nConfirm3">
                            <div class="main m3 nConfirm3"></div>
                            <span class="text t3 nConfirm3">COMPLETE</span>
                        </div>
                        <div class="node n4 nConfirm4">
                            <div class="main m4 nConfirm4"></div>
                            <span class="text t4 nConfirm4">PAY</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-9 col-md-12 mt">
                <div class="cart-area form form-cart">
                    <?php $total_product_amount = 0;
                    $postage = 0; ?>
                    @foreach($product_cart_list as $cart_lists)
                    <?php $total_product_amount += $cart_lists->value * $cart_lists->quantity; ?>
                    <?php $postage += $cart_lists->pro_shipping_charge; ?>
                    <div class="cart-details cart-all-pro">
                        <div class="cart-all-pro">
                            <div class="cart-pro">
                                <div class="cart-pro-image">
                                    <img src="{{asset('storage/products/'.$cart_lists->pro_image)}}" width="80" class="img-fluid" alt="image">
                                </div>
                            </div>
                            <div class="edid">
                                @if(Auth::check())
                                <a href="{{route('product.details',$cart_lists->slug)}}?edit={{$cart_lists->cartId}}" style="font-size: 18px;"><i class="fa-solid fa-pen-to-square"></i></a>
                                @else
                                <a href="{{route('product.details',$cart_lists->slug)}}?edit={{$cart_lists->uniqID}} " style="font-size: 18px;"><i class="fa-solid fa-pen-to-square"></i></a>
                                @endif
                            </div>
                            <div class="qty-item">
                                <div class="center">
                                    <div class="plus-minus">
                                        <span>
                                            <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                                            @if (Auth::check())
                                            <input type="number" onchange="update_cart('{{base64_encode($cart_lists->cartId)}}', '{{$cart_lists->cartId}}' )" id="pro_cart_qty_{{$cart_lists->cartId}}" min="1" max="5" name="pro_cart_qty" value="{{$cart_lists->quantity}}">
                                            @else
                                            <input type="number" onchange="update_cart('{{base64_encode($cart_lists->uniqID)}}', '{{$cart_lists->uniqID}}' )" id="pro_cart_qty_{{$cart_lists->uniqID}}" min="1" max="5" name="pro_cart_qty" value="{{$cart_lists->quantity}}">
                                            @endif
                                            <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                                        </span>
                                        <div class="all-pro-price">
                                            <span class="border">€{{$cart_lists->value * $cart_lists->quantity}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="all-pro-price">
                                @if(Auth::check())
                                <a href="{{route('user.remove.cartlist', ['cart_id'=>base64_encode($cart_lists->cartId)] )}}" class="pro-remove" style="font-size: 18px; color: #ccc;"><i class="fa-solid fa-xmark"></i></a>
                                @else
                                <a href="{{route('user.remove.cartlist', ['cart_id'=>base64_encode($cart_lists->uniqID)] )}}" class="pro-remove" style="font-size: 18px; color: #ccc;"><i class="fa-solid fa-xmark"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- cart product deta -->
                    <div class="bd-example" style="width: 70%; margin:auto; margin-top: 30px;">
                        <div class="table">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <th scope="row" style="width: 30%;">Delivery:</th>
                                        <td style="width: 40%;">± {{$cart_lists->delivery_time}} working days</td>
                                        <td style="width: 30%;">∦</td>
                                    </tr>
                                    @if(Auth::check())

                                    @if($cart_lists->extra_details)
                                    @foreach($cart_lists->extra_details as $extra)
                                    @foreach($extra->attributes as $attribute)

                                    <tr>
                                        <td></td>
                                        <th scope="row">{{$attribute->name}}:</th>
                                        <td>{{$attribute->image_details ? $attribute->image_details->attr_image_name : 'No '.$attribute->name}}</td>
                                        <td>{{$attribute->image_details ? '€'.$cart_lists->quantity*$attribute->image_details->total_price : '€0'}}
                                            @if($attribute->dimensions)
                                            @foreach($attribute->dimensions as $dimension)
                                            <span style="text-transform: capitalize;">{{$dimension->side}}: {{$dimension->value}} </span>
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endif

                                    @else

                                    @if($cart_lists->extra_details)
                                    @foreach($cart_lists->extra_details as $extra)
                                    @foreach($extra['attributes'] as $attribute)

                                    @php $attribute = (array)$attribute; @endphp
                                    <tr>
                                        <td></td>
                                        <th scope="row">{{$attribute['name']}}:</th>
                                        <td>{{$attribute['image_details'] ? $attribute['image_details']->attr_image_name : 'No '.$attribute['name']}}</td>
                                        <td>{{$attribute['image_details'] ? '€'.$cart_lists->quantity*$attribute['image_details']->total_price : '€0'}}
                                            @if(isset($attribute['dimensions']))
                                            @foreach($attribute['dimensions'] as $dimension)
                                            <span style="text-transform: capitalize;">{{$dimension['side']}}: {{$dimension['value']}} </span>
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endforeach
                                    @endif

                                    @endif
                                    <!-- <tr></tr> -->
                                    <tr class="bg-white">
                                        <td colspan="4"><input type="text" class="cartform" placeholder="reference"></td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="bd-example" style="width: 70%; margin:auto;">
                        <div class="table">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td></td>

                                        <td colspan="2"><input type="date" id="cart_date" class="cartform" value="{{date('Y-m-d', strtotime('+'. $delivery.' day'))}}"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa-solid fa-plus"></i></td>
                                        @php
                                        $last = $product_cart_list[count($product_cart_list) - 1];
                                        @endphp
                                        <td><a href="{{route($last->child->category_route_name, ['p_slug' => $last->parent->category_slug, 'c_slug' => $last->child->category_slug])}}" title="Add a product" class="btn btn-default btn-cart">Add a product</a></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa-solid fa-ruler"></i></td>
                                        <td><a href="#" title="Add a product" class="btn btn-default btn-cart" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@dmo">Have these products measured</a></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa-solid fa-envelope"></i></td>
                                        <td><a href="#" title="Add a product" class="btn btn-default btn-cart" data-bs-toggle="modal" data-bs-target="#FormModal" data-bs-whatever="@dmo">Request a quote with these products</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:14px;">Have your shopping cart measured</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="font-size:14px;">
                                                            <p style="font-size:14px;">Have these products measured? Within 2 working days, our technician will call for an appointment.</p>
                                                            <a href="JavaScript:void(0)" class="text-decoration-underline" style="font-size:14px;">Advantage of the measurement service:</a>
                                                            <ul>
                                                                <li style="list-style: disc; list-style-position: inside;">100% fit guarantee</li>
                                                            </ul>
                                                            <img src="images/54938.png" class="img-fluid" alt="">

                                                            <p style="font-size:14px;">After measuring, we will send you a quote based on the correct measurements.</p>


                                                            <form id="measureForm" class="modalForms">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="First Name" name="f_name" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Last Name" name="l_name" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Email" name="email" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Phone No" name="phone" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Postal Code" required name="postalcode" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="House no" required name="house_no" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Supplement" name="supplement" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Street" required name="street" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="place" required name="place" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-2">
                                                                        <button class="btn shopping-btn" style="font-size:14px;">Have your shopping cart measured</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="#FormModal" style="font-size:14px;">Quote request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="font-size:14px;">
                                                            <form id="quoteForm" class="modalForms">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p style="font-size: 14px;">Would you like a quote with multiple products? then click on the cross at the top right. Compile a new product and add it to your quote. Is your offer complete? Fill in
                                                                            the details below and you will receive a quote within 2 working days. </p>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="First Name" name="f_name" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Last Name" name="l_name" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Email" name="email" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Phone No" name="phone" required class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="reference" name="reference" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <div class="mb">
                                                                            <input type="text" placeholder="Comments" name="comments" class="form-control" id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-2">
                                                                        <button type="submit" class="trk btn shopping-btn">Get quote</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr />
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td align="right">Subtotal:</td>
                                        <td><strong>€{{$total_product_amount}}</strong>
                                        </td>
                                    </tr>
                                    @if(Auth::check() && Auth::user()->discount > 0)
                                    <tr>
                                        <td align="right">Discounted Price:</td>
                                        <?php $discount = $total_product_amount - ((Auth::user()->discount / 100) * $total_product_amount); ?>
                                        <td><strong>€{{$discount}} ({{Auth::user()->discount}}%)</strong>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td align="right">Postage costs:</td>
                                        <td>
                                            <strong>€{{$postage}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">Total including VAT and shipping costs:</td>
                                        <td> @if(Auth::check() && Auth::user()->discount > 0)
                                            <strong>€{{$discount + $postage}}:</strong>
                                            @else
                                            <strong>€{{$total_product_amount + $postage}}:</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="color: #ccc;">
                                        <td align="right">Total excl. VAT:</td>
                                        <td>@if(Auth::check() && Auth::user()->discount > 0)
                                            <strong>€{{$discount}}:</strong>
                                            @else
                                            <strong>€{{$total_product_amount}}:</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="color: #ccc;">
                                        <td align="right">VAT:</td>
                                        <td><strong>€{{$postage}}:</strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" align="right">
                                            <div class="buttonHolder">
                                                <!-- <div class="button b-back disabled" id="back">Back</div> -->
                                                <form id="submitForm" method="post" action="{{route('checkout.delivery_details')}}">
                                                    @csrf
                                                    <input type="hidden" id="submit_date" name="delivery_date">
                                                    <button class="button b-next" type="submit" id="next">Complete order </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 mt">
                <div class="cart-total aside">
                    <a href="#">
                        <h5>Extra opties:</h5>
                    </a>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#FormModal" data-bs-whatever="@dmo">
                        <p>Offerte van deze samenstelling Je ontvangt een offerte per e-mail van alle producten in de winkelwagen.</p>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@dmo">
                        <p>Deze producten laten inmeten Onze monteur komt deze producten inmeten en je krijgt daarna een offerte op maat. Deze service geeft je 100% pasgarantie.</p>
                    </a>
                </div>
            </div>
            @else
            <div class="wishlist-all-pro">
                <div class="wishlist-pro">
                    <h3>Your cart is empty</h3>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection


@section('scripts')
@include('frontend.scripts.cartscript')
<script>
    $('#next').click(function() {
        // alert('h')
        event.preventDefault();
        if (!$('#cart_date').val()) {
            alert('Please select a delivery date.')
            return
        }
        var delivery_date = <?php echo json_encode(date('Y-m-d', strtotime('+' . $delivery . ' day'))); ?>;
        if ($('#cart_date').val() < delivery_date) {
            alert('Delivery date should be ' + delivery_date + ' or greater.')
            return;
        }

        $('#submit_date').val(delivery_date);

        $('#submitForm').submit();
    })



    $(document).on('submit', '.modalForms', function() {
        event.preventDefault()
        var form = $(this)
        var type = form.attr('id');

        $.ajax({
            url: '{{route("cart.measure_quote")}}',
            data: form.serialize() + `&type=${type}`,
            method: 'POST',
            success: function(data) {
                alert(data.msg);
                window.location.reload();
            },
            error: function(err) {
                $(`#${type}_err`).html(err.responseJSON.msg);
            }
        })
    })
</script>
@endsection