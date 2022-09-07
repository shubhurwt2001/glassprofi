@extends('frontend/layout')
@section('page_title', 'My Cart')
@section('home_section', 'active')
@section('container')

<section class="cart-section my-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="mainWrapper">
                    <div class="statusBar">
                        <span class="pBar w-25"></span>
                        <div class="node n0 done nConfirm0">
                            <div class="main done m0 done nConfirm0"></div>
                            <span class="text t0 done nConfirm0">SHOPPING CART</span>
                        </div>
                        <div class="node n1 done nConfirm1">
                            <div class="main done m1 nConfirm1"></div>
                            <span class="text done t1 nConfirm1">FACTS</span>
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
            @if(!Auth::check())
            <div class="col-lg-12 col-md-6 mt">
                <div class="bestaandeklant">
                    <h2>Bestaande klant</h2>
                    <p>Je kunt hier inloggen met je e-mailadres en wachtwoord.</p>
                    <form action="{{route('user.signin')}}" id="loginForm" method="post">
                        @csrf
                        <input type="hidden" name="checkout" value="1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">E-mailadres</label>
                                    <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Vul je e-mailadres in">


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Wachtwoord</label>
                                    <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="Wachtwoord">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <button class="btn simple-btn">Inloggen en naar betalen</a>
                                        <!-- <a href="#" class="d-block">Wachtwoord vergeten?</a> -->
                                </div>
                            </div>

                            <div class="alert col-md-12 alert-danger" id="login" style="display: none;" role="alert">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @endif
            <form action="{{route('checkout.save_details')}}" method="post" id="submitForm">
                @csrf
                <div class="col-md-12">
                    <div class="alert alert-danger mt-2" id="checkout" style="display: none;" role="alert">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 @if(Auth::check()) mt @else mt-5 @endif">

                            <div class="frmklant">
                                <div class="row">
                                    <div class="col-lg-12">

                                        @if(!Auth::check())
                                        <div class="nieuweklant">
                                            <h3>Nieuwe klant</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="account" id="optionsRadios1" value="1">
                                                        Ik wil een account aanmaken voor mijn aankoop.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="account" id="optionsRadios2" value="0" checked="">
                                                        Ik wil mijn aankoop doen zonder een account aan te maken.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="nieuweklant">
                                            <h3>Details</h3>
                                        </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <div class="col-lg-12">
                                                <p>Je gegevens worden alleen gebruikt voor het afhandelen van de bestelling.</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>E-mailadres</strong></label>
                                                        <input type="email" name="email" @if(Auth::check()) value="{{Auth::user()->email}}" readonly @endif required class="form-control" placeholder="Vul je e-mailadres in">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Telefoonnummer</strong></label>
                                                        <input type="text" name="phone" required class="form-control" placeholder="Telefoonnummer">
                                                    </div>
                                                </div>
                                                @if(!Auth::check())
                                                <div class="col-lg-6 accountCreate" style="display: none">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Wachtwoord</strong></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 accountCreate" style="display: none">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Bevestig wachtwoord</strong></label>
                                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Bevestig wachtwoord">
                                                    </div>
                                                </div>
                                                @endif
                                                <!-- <div class="col-md-12">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="" id="mailinglist" name="mailinglist" value="1"><span> Aanmelden nieuwsbrief</span></label>
                                            </div>
                                        </div> -->

                                                <div class="nieuweklant">
                                                    <h3>Adresgegevens</h3>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Voornaam</strong></label>
                                                        <input name="f_name" required class="form-control" placeholder="Voornaam">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Achternaam</strong></label>
                                                        <input name="l_name" required class="form-control" placeholder="Achternaam">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Bedrijf (niet invullen bij particulier)</strong></label>
                                                        <input name="company" required class="form-control" placeholder="Bedrijf (niet invullen bij particulier)">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Land / Regio</strong></label>
                                                        <select class="form-select" required name="location" aria-label="Default select example">
                                                            <option value="Nederland">Nederland</option>
                                                            <option value="België">België</option>
                                                            <option value="Luxemburg">Luxemburg</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Postcode</strong></label>
                                                        <input name="postcode" required class="form-control" placeholder="Postcode">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><strong>Huisnr</strong></label>
                                                                <input name="house_no" required class="form-control" placeholder="Huisnr">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"><strong>Aanvulling</strong></label>
                                                                <input name="supplement" class="form-control" placeholder="Aanvulling">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Straat</strong></label>
                                                        <input name="street" required class="form-control" placeholder="Straat">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Plaats</strong></label>
                                                        <input name="place" required class="form-control" placeholder="Plaats">
                                                    </div>
                                                </div>


                                            </div>
            </form>

        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-6 @if(Auth::check()) mt @else mt-5 @endif">
        <div class="row">
            <div class="col-lg-12">
                <div class="verzendmethode">
                    <h3>De verzendmethode</h3>
                    <p>Maak een keuze uit onderstaande verzendmethodes</p>
                    <div class="radio">
                        <label>
                            <input id="bezorgen" name="verzendwijze" checked type="radio" value="1">
                            Bezorgen<strong>(Gratis)</strong>
                        </label>
                    </div>
                    <!-- <div class="checkbox"><label><input id="ba" name="deliver" type="checkbox" value="1" onclick="$('#frmklant').data('formValidation').resetForm();if($(this).is(':checked')){$('#bezorg').removeClass('hidden');}else{$('#bezorg').addClass('hidden');}"> Wijzig het afleveradres</label></div> -->
                    <div class="radio"><label><input id="afhalen" name="verzendwijze" type="radio" value="2"> Afhalen <strong>(Gratis)</strong></label></div>
                </div>
            </div>
            <!-- hidden form -->
            <!-- <div class="col-lg-12 hidden">
                                    <div class="verzendmethode">
                                        <h4><strong>Afleveradres</strong></h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Contactpersoon levering</strong></label>
                                                    <input type="email" class="form-control" placeholder="Contactpersoon levering">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Telefoonnummer contactpersoon</strong></label>
                                                    <input type="email" class="form-control" placeholder="Telefoonnummer contactpersoon">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Bedrijf (niet invullen bij particulier)</strong></label>
                                                    <input type="email" class="form-control" placeholder="Bedrijf (niet invullen bij particulier)">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Land / Regio</strong></label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option value="">Nederland</option>
                                                        <option value="">België</option>
                                                        <option value="">Luxemburg</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Postcode</strong></label>
                                                    <input type="email" class="form-control" placeholder="Postcode">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Huisnr</strong></label>
                                                            <input type="email" class="form-control" placeholder="Huisnr">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"><strong>Aanvulling</strong></label>
                                                            <input type="email" class="form-control" placeholder="Aanvulling">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Straat</strong></label>
                                                    <input type="email" class="form-control" placeholder="Straat">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Plaats</strong></label>
                                                    <input type="email" class="form-control" placeholder="Plaats">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
            <!-- referentie -->
            <div class="col-md-12">
                <div class="bestaandeklant">
                    <!-- <h3>Opmerking</h3>-->
                    <div class="">
                        <!-- <textarea id="opmerking" name="opmerking" class="form-control hidden" placeholder="Eventuele opmerkingen kun je hier invullen ..."></textarea> -->
                        <p></p>
                        <input value="" type="text" name="referentie" class="form-control" id="referentie" placeholder="referentie">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12  mt-4">
                <button type="submit" class="btn simple-btn float-end" id="btn-gotopayment">Naar betalen</button>
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>
    <div id="appendForm"></div>
    </div>
    </div>
</section>
@endsection
@section('scripts')
@include('frontend.scripts.cartscript')
<script>
    $('#loginForm').submit(function() {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'post',
            data: form.serialize(),
            success: function(data) {
                $('#login').hide()
                window.location.reload();
            },
            error: function(err) {
                $('#login').show()
                $('#login').html(err.responseJSON.msg)
            }
        })
    })



    $('input[name=account]').change(function() {
        if ($(this).val() == 1) {
            $('.accountCreate').show();
        } else {
            $('.accountCreate').hide();
        }
    })



    $('#submitForm').submit(function() {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'post',
            data: form.serialize(),
            success: function(data) {
                $('#checkout').hide()
                // window.location.reload();
                $('#appendForm').html(`<form method="post">@csrf</form>`)
                $('#appendForm form').attr('action','{{route("checkout.order_details")}}').submit()
                
            },
            error: function(err) {
                $('#checkout').show()
                $('#checkout').html(err.responseJSON.msg)
            }
        })
    })
</script>

@endsection