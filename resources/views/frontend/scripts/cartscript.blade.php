    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        function update_cart(cart_id, cart_qty_id) {
            pro_cart_qty = jQuery('#pro_cart_qty_' + cart_qty_id).val();

            $.ajax({
                url: "{{ route('user.update.cartlist') }}",
                method: 'post',
                data: {
                    cart_id: cart_id,
                    pro_cart_qty: pro_cart_qty
                },
                success: function(cartupdate_res) {
                    if (cartupdate_res.status == 200 && cartupdate_res.message == 'Success') {
                        let url = "{{ route('user.cart') }}";
                        window.location.href = url;
                    }
                    if (cartupdate_res.status == 201 && cartupdate_res.message == 'Fail') {
                        let url = "{{ route('user.cart') }}";
                        window.location.href = url;
                    }
                    if (cartupdate_res.status == 400 && cartupdate_res.message == 'Fail') {
                        let url = "{{ route('user.login') }}";
                        window.location.href = url;
                    }
                }
            });
        }


        $(document).on('click', '#calculate_total_amount', function(e) {
            e.preventDefault();
            let cart_error_msg = "";
            jQuery('#shipping_cart_err_msg').html();
            jQuery('#shipping_carge_cart').text('');
            jQuery('#total_amount_cart').text('');
            let country = jQuery('#shipping_country_cart').val();
            let zip_code = jQuery('#zip_code_cart').val();
            let cart_pro_total = jQuery('#cart_pro_total').val();
            if (cart_pro_total > 0) {


                if (country == '') {
                    //alert('please select your country');
                    cart_error_msg = "please select your country";
                    jQuery('#shipping_cart_err_msg').html(`<div class="alert alert-info">${cart_error_msg}</div>`);
                } else if (zip_code == '') {
                    //alert('Please enter you zip code');
                    cart_error_msg = "Please enter you zip code";
                    jQuery('#shipping_cart_err_msg').html(`<div class="alert alert-info">${cart_error_msg}</div>`);
                }
                if (cart_error_msg == "") {
                    let cart_error_msg = "";
                    jQuery('#shipping_cart_err_msg').html('');
                    $.ajax({
                        url: "{{ route('cart.shipping.charge') }}",
                        method: 'post',
                        data: {
                            count_id: country,
                            zip_code: zip_code,
                            cart_pro_total: cart_pro_total
                        },
                        success: function(cartupdate_res) {
                            if (cartupdate_res.status == 200 && cartupdate_res.message == 'Success') {
                                //let url = "{{ route('user.cart') }}";
                                //window.location.href=url;
                                let total_amount_cart = jQuery.parseJSON(cartupdate_res.data.total_amount_with_shipping_charge);
                                let shipping_amount_cart = jQuery.parseJSON(cartupdate_res.data.shipping_charge);
                                jQuery('#shipping_carge_cart').text(`$ ${shipping_amount_cart}`);
                                jQuery('#total_amount_cart').text(`$ ${total_amount_cart}`);
                            }
                            if (cartupdate_res.status == 400 && cartupdate_res.message == 'Fail') {
                                jQuery('#shipping_cart_err_msg').html(`<div class="alert alert-info">${cartupdate_res.data}</div>`);
                            }
                        }
                    });

                }
            } else {
                cart_error_msg = "Your cart is empty";
                jQuery('#shipping_cart_err_msg').html(`<div class="alert alert-info">${cart_error_msg}</div>`);
            }

        });
    </script>