@extends('frontend/layout')
@section('page_title', 'Product Details')
@section('home_section', 'active')
@section('meta_title', $product->pro_meta_title)
@section('meta_keywords', $product->pro_meta_keyword)
@section('meta_description', $product->pro_meta_description)
@section('container')


<!-- breadcrumb section -->
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="breadcrumb-wrapper-new my-1">
                <div id="breadcrumb">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/">{{$product->parent->category_name}}</a></li>
                        <li><a href="{{route($product->category->category_route_name, ['p_slug' => $product->parent->category_slug, 'c_slug' => $product->category->category_slug])}}">{{$product->category->category_name}}</a></li>
                        <li><span>{{$product->name}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--main section-->

<section class="single-product-details my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="sticky">
                    <h2>{{$product->name}}</h2>
                    <p>{{$product->title}}</p>
                    <div class="product_details owl-carousel">
                        @if($product->product_images->count()>0)
                        @foreach($product->product_images as $image)
                        <div class="items">
                            <a href="{{asset('storage/products/'.$image->image)}}"> <img src="{{asset('storage/products/'.$image->image)}}" class="img-fluid" alt=""></a>
                        </div>
                        @endforeach

                        @else
                        <div class="items">
                            <p>No image uploaded</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- JQUERY -->
            <div class="col-lg-6 mb-4">
                <div class="product_details-content">
                    <div class="price d-flex justify-content-lg-between" id="stepDetail">
                    </div>

                    <div class="accordion" id="appendForm"></div>
                    <div id="formButtons"></div>
                    <div class="clearfix"></div>
                    <div class="d-flex justify-content-between align-items-center mt-5" id="appendProgress">
                    </div>
                    <div class="usps mt-4">
                        <h2><b>Nog even en je weet je prijs!</b></h2>
                        <ul>
                            <li>Levertijd ± <b>{{$product->delivery_time}}</b></li>
                            <li><b>Inmeten en monteren in heel Nederland</b></li>
                            <li><b>Geheel vrijblijvend gratis inmeten</b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- JQUERY END -->
            <div class="col-lg-12">
                <div class="product-details-content">
                    <h6>{{$product->title}}</h6>
                    {!!$product->excerpt_html!!}
                </div>
                <hr>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="accordion accordion-flush accordion-flush-d" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Producteigenschappen
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <table id="product-downloads-table" class="table table-borderless">
                                    <tbody>
                                        @if($product->product_features->count()>0)
                                        @foreach($product->product_features as $feature)
                                        <tr>
                                            <th scope="row">{{$feature->feature_title}}</th>
                                            <td>{{$feature->feature}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th scope="row">#</th>
                                            <td>No Feature Available</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Documenten
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="download">
                                    <table id="product-downloads-table" class="table table-borderless">
                                        <tbody>
                                            @if($product->product_documents->count()>0)
                                            @foreach($product->product_documents as $document)
                                            <tr>
                                                <th scope="row">{{$document->document_title}}</th>
                                                <td><a href="{{asset('storage/products/'.$document->document)}}">Downloaden</a></td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <th scope="row">#</th>
                                                <td>No Document Available</td>
                                            </tr>
                                            @endif


                                            <!--<tr>
                                            <th scope="row">Montagehandleiding Iris</th>
                                            <td> Downloaden</td>
                                        </tr> -->


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
@include('frontend.scripts.product_details_script')

<script>
    var current = 0;

    var cart = <?php echo json_encode($product->cart) ?>;


    var steps = <?php echo json_encode($product->steps) ?>;

    const priceFix = <?php echo json_encode($product->value) ?>;

    var price = <?php echo json_encode($product->value) ?>;


        var finalData = [];
    

    steps.map(function(step, index) {
        var obj = {
            id: step.id,
            attributes: []
        }

        step.attributes.map(function(attribute) {
            var attr = {
                id: attribute.id,
                required: attribute.required,
                image: null,
                last_image: null,
                dimensions: [],
                unit: "mm",
                name: attribute.attribute_name
            }
            obj.attributes.push(attr)
        })
        finalData.push(obj)
    })
    // console.log(finalData);
    if (cart) {
         finalData = cart.extra_details;
         price = cart.value
    }
    function forward(current) {
        if (typeof steps[current] !== 'undefined') {
            if (current == 0) {
                $('#formButtons').html(`<button type="submit" class="btn measuring-btn">Free measuring service</button>
                    <button type="submit" class="btn choose-btn step" id="next">Choose your glass</button>`)
            } else if(current != 0 && current < steps.length - 1) {
                $('#formButtons').html(`<button type="submit" class="btn measuring-btn step" id="prev">Previous Step</button>
                    <button type="submit" class="btn choose-btn step" id="next">Choose your glass</button>`)
            }else{
                $('#formButtons').html(`<button type="submit" class="btn measuring-btn step" id="prev">Previous Step</button>
                    <button type="submit" class="btn choose-btn step" id="next">Add To Cart</button>`)
            }

            $('#stepDetail').html(`<h2><strong>Stap ${current+1}: </strong>${steps[current].name}</h2>
                    <h2 class="changePrice"><strong>Vanaf:</strong> ${price},-</h2>`)

            $('#appendProgress').html(`<div class="progress w-50">
                            <div class="progress-bar" role="progressbar" style="width: ${((parseInt(current + 1))/parseInt(steps.length))*100}%;">${((parseInt(current + 1))/parseInt(steps.length))*100}%</div>
                        </div>
                        <h2 class="changePrice"><strong>Vanaf:</strong> ${price},-</h2>`)

            $('#appendForm').html(steps[current].attributes.length > 0 ? `
            ${steps[current].attributes.map(function(attribute, index){
                return `<div class="accordion-item" >
                <h2 class="accordion-header" id="headingOne_${attribute.id}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_${attribute.id}" aria-expanded="true" aria-controls="collapseOne_${attribute.id}">
                    ${attribute.attribute_name} ${attribute.required ? '<span class="text-danger">*</span>' :''}
                    </button>
                </h2>
                <div id="collapseOne_${attribute.id}" class="accordion-collapse collapse" aria-labelledby="headingOne_${attribute.id}" data-bs-parent="#appendForm">
                    <div class="accordion-body">
                        <div class="row">
                           ${attribute.images.length > 0 ? attribute.images.map(function(image,index){
                            return `<div class="col-lg-4 mb-4">
                            <div class="accordion-item" id="image_${image.id}" onclick="show_image('${encodeURIComponent(JSON.stringify(image))}','${encodeURIComponent(JSON.stringify(attribute))}')">
                                        <img src="{{asset('storage/products/${image.attr_image}')}}" width="80" class="img-fluid" alt="">
                                            <span class="rate">From €${image.attr_price_from}</span>
                                            <p>${image.attr_image_name}</p>
                                    </div>
                            </div>
                                            `
                           }).join('') : '<p>No product attribute Image added yet</p>'}
                           
                           <div id="sizes_${attribute.id}"></div>
                        </div>
                    </div>
                </div>
                    
            </div>`
            }).join('')}
            ` : "<p>No product attribute added yet</p>")


            finalData.map(function(myStep) {
                if (myStep.id == steps[current].id) {
                    myStep.attributes.map(function(attr) {
                        if (attr.image) {
                            steps[current].attributes.map(function(att) {
                                att.images.map(function(img) {
                                    if (img.id == attr.image) {
                                        att.unit = attr.unit;
                                        att.dimension_values = attr.dimensions;
                                        show_image(encodeURIComponent(JSON.stringify(img)), encodeURIComponent(JSON.stringify(att)))
                                    }
                                })
                            })
                        }
                    })
                }
            })
        }
    }

    forward(current);


    $(document).on('click', '.step', function() {
        var type = $(this).attr('id');
        var error = [];
        if (type == "next") {
            var myStep = steps[current];
            finalData.map(function(step) {
                if (myStep.id == step.id) {
                    step.attributes.map(function(attribute) {
                        if (attribute.required == 1 && attribute.image == null) {
                            // console.log(1);
                            error.push(attribute);
                        } else if (attribute.image) {
                            steps[current].attributes.map(function(attr) {
                                if (attribute.id == attr.id) {
                                    attr.images.map(function(image) {
                                        if (image.id == attribute.image && image.dimensions.length > 0 && attribute.dimensions.length != image.dimensions.length) {
                            // console.log(image,attribute);

                                            error.push(attribute);
                                        }
                                    })
                                }
                            })

                        }
                    })
                }
            })

            if (error.length > 0) {
                // console.log(error);
                alert('All fields in ' + error[0].name + ' are required.')
                return;
            }
            if (current < steps.length - 1) {
                current++;
                forward(current);
            } else {
                var cartist_id = <?php echo json_encode($product->id); ?>;
                var edit = <?php echo json_encode($product->edit); ?>;

                $.ajax({
                    url: "{{ route('add.item.cart') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "post",
                    data: {
                        cartist_id,
                        finalData,
                        edit
                    },
                    success: function(cartlist_res) {
                        let count_data = jQuery.parseJSON(cartlist_res.data);
                        //jQuery('.wishlist_count').text(count_data.wishlist_count);
                        jQuery('.cart_count').text(count_data.cart_count);
                        window.location.href = "{{route('user.cart')}}"
                    }
                })
            }
        } else {
            if (current > 0) {
                current--;
                forward(current);
            }
        }
    });


    function show_image(data, data1) {

        var image = JSON.parse(decodeURIComponent(data));
        var attribute = JSON.parse(decodeURIComponent(data1));
        $(`#collapseOne_${attribute.id} .accordion-item`).removeClass('selected');
        $(`#image_${image.id}`).addClass('selected')

        finalData.map(function(myStep) {
            if (myStep.id == steps[current].id) {
                myStep.attributes.map(function(attr) {
                    if (attribute.id == attr.id) {
                        attr.image = image.id;
                        if (attr.last_image != attr.image) {
                            attr.dimensions = []
                        }
                        attr.last_image = image.id;
                    }
                })
            }
        });

        if (image.dimensions.length > 0) {
            $(`#sizes_${attribute.id}`).html(` <div class="col-lg-12">
                <div class="pcimage"><img src="{{asset('storage/products/${image.attr_image}')}}" class="img-fluid w-100" alt=""> </div>
                <div class="size-discription text-start">
                        <p><strong>${image.attr_image_name}</strong></p>
                        ${image.dimensions.map(function(dimension, index){
                            return `<p>${dimension.dim_name} = ${dimension.dim_description}</p>`
                        }).join('')}
                        
                        
                        <label>mm</label>
                        <input type="radio" id="${image.id}" name="unit_${image.id}" class="unit" value="mm" ${attribute.unit ? attribute.unit == "mm" ? "checked" :"" :"checked"}>
                        <label for="cm">cm</label>
                        <input type="radio" id="${image.id}" name="unit_${image.id}" class="unit" value="cm" ${attribute.unit ? attribute.unit == "cm" ? "checked" :"" :""}>
                    </div>
                    <br>
                    ${image.dimensions.map(function(dimension, index){
                        if(attribute.dimension_values && attribute.dimension_values.length > 0){
                            attribute.dimension_values.map(function(value){
                          if(value.id == dimension.id){
                                     dimension.value = value.value;
                                   }
                            })
                        }
                        return `<div class="form-group text-start">
                        <h6><strong>${dimension.dim_name}</strong></h6>
                        <div class="input-group mb-3">
                            <span class="input-group-text">${dimension.side}</span>
                            <input type="number" class="form-control input_${image.id}"
                            onchange="setDimensions(${dimension.id},${attribute.id},'${dimension.side}',${image.attr_price_from})"
                            value="${dimension.value ? dimension.value : ''}"
                            placeholder="${attribute.unit ? attribute.unit == "mm" ? "in millimeters" : "in centimeters" :"in millimeters"}" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text span_${image.id}">${attribute.unit ? attribute.unit == "mm" ? "mm" : "cm" :"mm"}</span>
                        </div>
                    </div>`
                        }).join('')}
                                                                   
                    
                   <!---- ${attribute.repeat ? `<div class="adbtn text-start">
                        <button class="gl-product-el-add text-start"><span>+</span>${ attribute.repeat_button_text ? attribute.repeat_button_text :attribute.attribute_name}</button>
                    </div>`:''}--->
                </div>`)
        }
    }
</script>
<script>
    function setDimensions(dID, aID, side, tarif) {

        var totalAttr = []
        var additional = 0;
        var divider = 1000;
        var value = event.target.type == "number" ? event.target.value : event.target.getAttribute('data-val');

        finalData.map(function(myStep) {
            if (myStep.id == steps[current].id) {
                myStep.attributes.map(function(attribute) {

                    if (attribute.id == aID) {
                        divider = attribute.unit == "mm" ? 1000 : 100
                        const found = attribute.dimensions.some(el => parseInt(el.id) === parseInt(dID));
                        if (!found) {
                            attribute.dimensions.push({
                                id: dID,
                                value: value ? value : 0,
                                side: side,
                                tarif: tarif,
                                divider: divider
                            });
                        } else {
                            attribute.dimensions.map(function(dimension) {
                                if (dimension.id == dID) {
                                    dimension.value = value ? value : 0;
                                    dimension.divider = divider
                                }
                            })
                        }
                        attribute.last_image = attribute.image
                    }


                })

            }
            myStep.attributes.map(function(attribute) {
                var sides = {
                    'a': 0,
                    'b': 0,
                    'c': 0,
                    'd': 0,
                    'tarif': 0,
                    'divider': 1000
                };
                attribute.dimensions.map(function(dim) {
                    if (dim.side == "a") {
                        sides.a = parseInt(dim.value);
                    }
                    if (dim.side == "b") {
                        sides.b = parseInt(dim.value);
                    }
                    if (dim.side == "c") {
                        sides.c = parseInt(dim.value);
                    }
                    if (dim.side == "d") {
                        sides.d = parseInt(dim.value);
                    }
                    sides.tarif = dim.tarif;
                    sides.divider = dim.divider;
                })
                totalAttr.push(sides)
            })

        })
        getTotal(totalAttr);
    }

    function getTotal(totalAttr) {
        price = 0;
        // console.log(totalAttr);
        totalAttr.map(function(total) {
            // console.log(total);
            price = parseInt(price) + parseInt(total.tarif) + (((parseInt(total.a) / parseInt(total.divider)) + (parseInt(total.d) / parseInt(total.divider))) * (parseInt(total.b) / parseInt(total.divider)) * (parseInt(total.tarif)))
        })
        $('.changePrice').html(`<strong>Vanaf:</strong> ${price},-`);
    }


    $(document).on('change', '.unit', function() {
        var mainInput = $(this);
        var totalAttr = [];
        var id = $(this).attr('id');
        var val = $(this).val();

        finalData.map(function(final) {
            if (final.id == steps[current].id) {
                final.attributes.map(function(attribute) {
                    steps[current].attributes.map(function(att) {
                        if (att.id == attribute.id) {
                            att.images.map(function(image) {
                                if (image.id == id) {
                                    attribute.unit = val;
                                }
                            })
                        }
                    })
                })
            }

        })

        if (val == 'cm') {
            // console.log("hi");
            $(`.span_${id}`).html('cm')
            $(`.input_${id}`).attr('placeholder', 'in centimeters')
            var myVal = $(`.input_${id}`);
            myVal.map(function() {
                var input = $(this);
                var value = input.val();
                if (value) {
                    mainInput.attr('data-val', parseInt((parseInt(value) / 10)))
                    input.val(parseInt((parseInt(value) / 10)))
                    input.change()
                }
            })
            // $(`.input_${id}`).val(myVal) 
        } else {
            $(`.span_${id}`).html('mm')
            $(`.input_${id}`).attr('placeholder', 'in millimeters')
            var myVal = $(`.input_${id}`);
            myVal.map(function() {
                var input = $(this);
                var value = input.val();
                if (value) {
                    mainInput.attr('data-val', parseInt((parseInt(value) * 10)))
                    input.val(parseInt((parseInt(value) * 10)))
                    input.change()
                }
            })

        }

    })
</script>
@endsection