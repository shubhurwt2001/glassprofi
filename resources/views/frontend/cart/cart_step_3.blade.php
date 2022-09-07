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

<section class="cart-section my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mainWrapper">
                    <div class="statusBar">
                        <span class="pBar w-50"></span>
                        <div class="node n0 done nConfirm0">
                            <div class="main done m0 done nConfirm0"></div>
                            <span class="text t0 done nConfirm0">SHOPPING CART</span>
                        </div>
                        <div class="node n1 done nConfirm1">
                            <div class="main done m1 nConfirm1"></div>
                            <span class="text done t1 nConfirm1">FACTS</span>
                        </div>
                        <div class="node n2 done nConfirm2">
                            <div class="main done m2 nConfirm2"></div>
                            <span class="text done t2 nConfirm2">PAYMENT METHOD</span>
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
            <!-- belling details -->
            <div class="col-lg-12" id="payNow">
                <div class="bestelling">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="orderdh">
                                <h2> Your order</h2>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="dah">
                                <h4>Delivery address</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dah">
                                <h4>Billing address</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <address class="order-ad">
                                <p style="text-transform: capitalize;">{{$checkout_details['company']}}</p>
                                <p style="text-transform: capitalize;">for {{$checkout_details['f_name']}} {{$checkout_details['l_name']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['house_no']}} {{$checkout_details['street']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['postcode']}} {{$checkout_details['place']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['location']}}</p>
                            </address>
                        </div>
                        <div class="col-lg-6">
                            <address class="order-ad">
                                <p style="text-transform: capitalize;">{{$checkout_details['company']}}</p>
                                <p style="text-transform: capitalize;">for {{$checkout_details['f_name']}} {{$checkout_details['l_name']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['house_no']}} {{$checkout_details['street']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['postcode']}} {{$checkout_details['place']}}</p>
                                <p style="text-transform: capitalize;">{{$checkout_details['location']}}</p>
                            </address>
                        </div>
                        <div class="col-lg-12 col-md-12 mt">
                            <?php $total_product_amount = 0;
                            $postage = 0; ?>
                            @foreach($product_cart_list as $cart_lists)
                            <?php $total_product_amount += $cart_lists->value * $cart_lists->quantity; ?>
                            <?php $postage += $cart_lists->pro_shipping_charge; ?>

                            <div class="cart-area form form-cart">
                                <div class="cart-details cart-all-pro">
                                    <div class="cart-all-pro order-content">
                                        <div class="cart-pro">
                                            <div class="cart-pro-image">
                                                <img src="{{asset('storage/products/'.$cart_lists->pro_image)}}" width="80" class="img-fluid" alt="image">
                                            </div>
                                        </div>
                                        <div class="edid">
                                            <p>{{$cart_lists->name}}</p>
                                        </div>
                                        <div class="qty-item">
                                            <div class="center">
                                                <div class="plus-minus">
                                                    <div class="all-pro-price">
                                                        <span class="border">€{{$cart_lists->value * $cart_lists->quantity}}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div class="all-pro-price ">
                                            <a href="index.html" class="pro-remove" style="font-size: 18px; color: #ccc;"><i class="fa-solid fa-xmark"></i></a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- cart product deta -->
                                <div class="bd-example">
                                    <div class="table-responsive">
                                        <div class="table" style="width: 70%; margin:auto; margin-top: 30px;">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <th scope="row" style="width: 30%;">Delivery:</th>
                                                        <td style="width: 40%;">± {{$cart_lists->delivery_time}} working days</td>
                                                        <td style="width: 30%;">&nspar;</td>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="bd-example">
                                <div class="table-responsive">
                                    <div class="table" style="width: 70%; margin:auto; margin-top: 10px;">
                                        <table width="100%">
                                            <tr>
                                                <td width="50%">
                                                    <!-- <table>
                                                        <tr>
                                                            <td>
                                                                <form id="frmPromotion" name="frmPromotion" class="form-inline" method="post">
                                                                    <div class="form-group">
                                                                        <input id="prom" name="prom" type="text" class="form-control" placeholder="Kortingscode" required="">
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-primary">Controleer code</button></td>
                                                        </tr>
                                                    </table> -->
                                                </td>
                                                <td width="50%">
                                                    <table width="100%">
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
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12" id="bottomPay">
            <div class="betaalmethode">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="akkoord" required="" id="terms">
                        <span>Ik heb de <a class="bootpopup" href="#" target="_blank" title="Algemene voorwaarden">algemene voorwaarden</a>
                            gelezen en ga hiermee akkoord.</span>
                    </label>
                </div>
                <span class="text-danger" id="error"></span>
            </div>
            <div class="text-right">
                <div class="buttonHolder">
                    <div class="button b-next" id="next">Complete order </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection


@section('scripts')
@include('frontend.scripts.cartscript')
<script>
    $('#next').click(function() {
        if (!$('#terms').is(":checked")) {
            $('#error').html('Please check terms and conditions.')
        } else {
            $('#bottomPay').remove()
            $('.nConfirm3').addClass('done')
            $('#payNow').addClass('the-content mt-5')
            $('.pBar').removeClass('w-50').addClass('w-75')
            $('#payNow').html(`
                    <ul class="check-list mt-5">
                        <li>
                            <h1>
                                Complete your order by choosing an option!
                            </h1>
                        </li>
                    </ul>
                    <hr>
                    <form id="payForm">
                    @csrf
                    <div class="alert alert-danger"  style="display:none"></div>
                    <div class="d-flex flex-direction-column justify-content-start align-items-center">
                    <select class="form-control" name="payment_type" style="max-width:200px;margin-right:10px">
                    <option value="1">Direct Pay</option>
                    <option value="2">Pay by invoice</option>
                    </select>
                    <button class="btn shopping-btn">Continue</button>
                    </div>
                    </form>
                `)
        }
    })
</script>
<script>
    $(document).on('submit', '#payForm', function() {
        event.preventDefault();

        var form = $(this)

        $.ajax({
            url: "{{route('place-order')}}",
            method: "post",
            data: form.serialize(),
            error: function(err) {
                $('.alert-danger').html(err.responseJSON.msg).show()
                if (err.responseJSON.code == 400) {
                    window.location.href = "{{url('cart')}}"
                }
            },
            success: function(data) {
                $('.alert-danger').hide();
                if (data.code == 200) {
                    window.location.href = `/order/${data.order_id}`
                } else {
                    window.location.href = data.link;
                }
            }
        })
    })
</script>
@endsection