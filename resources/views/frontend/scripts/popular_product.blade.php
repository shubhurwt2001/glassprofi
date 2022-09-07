<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    function showproduct(product_id) {
        let popular_html = '';
        jQuery('#popular_item_name').text('');
        jQuery('#popular_item_price').text('');
        jQuery('#popular_item_short_desc').text('');
        jQuery('#popular_product_images').html('');

        $.ajax({
            url: "{{ route('popular.item.detail') }}",
            method: 'post',
            data: `${product_id}`,
            success: function(prod_res) {
                if (prod_res.status == 200 && prod_res.message == 'Success') {
                    let pro_data = jQuery.parseJSON(prod_res.data.poducts_list);
                    //total_records = pro_data.length;
                    jQuery('#popular_item_name').text(pro_data[0].name);
                    jQuery('#popular_item_price').text('$ ' + pro_data[0].value);
                    jQuery('#popular_item_short_desc').text(pro_data[0].short_desc);
                    let $total_image = pro_data[0].productimage.length;
                    if ($total_image > 0) {
                        popular_html += `<div class="outer">
                                               <div id="big" class="owl-carousel owl-theme owl-loaded ">
                                               `;
                        $.each(pro_data[0].productimage, function(key, value) {
                            popular_html += `<div class="item">
                                                   <img src="{{asset('storage/products/')}}/${value.image }">
                                                </div>`;
                        });

                        popular_html += `</div> </div>`;
                        jQuery('#popular_product_images').html(popular_html);
                        // var owl = ;
                        // $(".owl-carousel").destroy();
                        // $("#big").data('owl.carousel').destroy()
                        $("#big").owlCarousel({
                            items: 1,
                            dots: false,
                            nav: true,
                            loop: true,
                            smartSpeed: 450,
                            autoplay: true,
                            autoplayTimeout: 3000,
                        })
                    }
                }
                if (prod_res.status == 400 && prod_res.message == 'Fail') {
                    alert('Data not found');
                }
            }
        });
    }


    function addwish(addtolist) {
        jQuery('#wishlist_message').html();
        $.ajax({
            url: "{{ route('add.item.wishlist') }}",
            method: 'post',
            data: `${addtolist}`,
            success: function(wishlist_res) {
                if (wishlist_res.status == 200 && wishlist_res.message == 'Success') {
                    jQuery('#wishlist_message').html('<p>item added successfully in your wishlist</p>');
                    //console.log(wishlist_res.data)
                    let count_data = jQuery.parseJSON(wishlist_res.data);
                    jQuery('.wishlist_count').text(count_data.wishlist_count);
                    //jQuery('.cart_count').text(count_data.cart_count);
                }
                if (wishlist_res.status == 201 && wishlist_res.message == 'Fail') {
                    jQuery('#wishlist_message').html('<p>Item already in your wishlist</p>');
                }
                if (wishlist_res.status == 400 && wishlist_res.message == 'Fail') {
                    let url = "{{ route('user.login') }}";
                    window.location.href = url;
                }
            }
        });


    }

    // function add_to_cart(cartist_id) {

    //     jQuery('#wishlist_message').html();
    //     $.ajax({
    //         url: "{{ route('add.item.cart') }}",
    //         method: 'post',
    //         data: {
    //             cartist_id
    //         },
    //         success: function(cartlist_res) {
    //             if (cartlist_res.status == 200 && cartlist_res.message == 'Success') {
    //                 jQuery('#wishlist_message').html('<p>item added successfully in your cart</p>');
    //                 let count_data = jQuery.parseJSON(cartlist_res.data);
    //                 //jQuery('.wishlist_count').text(count_data.wishlist_count);
    //                 jQuery('.cart_count').text(count_data.cart_count);
    //             }
    //             if (cartlist_res.status == 201 && cartlist_res.message == 'Fail') {
    //                 jQuery('#wishlist_message').html('<p>Item already in your cart</p>');
    //             }
    //             if (cartlist_res.status == 400 && cartlist_res.message == 'Fail') {
    //                 let url = "{{ route('user.login') }}";
    //                 window.location.href = url;
    //             }
    //         }
    //     });
    // }
</script>