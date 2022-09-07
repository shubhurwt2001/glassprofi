@extends('backend/adminlayout')

@section('page_title', 'Product Information')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')
 

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!--<form action="{{route('admin.productlist.update', $product_list[0]->name)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT"> -->
                  
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" value="{{$product_list[0]->name}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_slug">Slug</label>
                            <input type="text" class="form-control" placeholder="Slug" value="{{$product_list[0]->slug}}" disabled>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category"  name="category" class="form-control">
                                <option value="" disabled>Select Category</option>
                              
                                @foreach($navbar as $lists)
                               
                                @if($product_list[0]->navbars_id == $lists->id)
                                 <option value="{{$lists->id}}" selected disabled>{{$lists->category_name}}</option>      -->
                                @else
                                <option value="{{$lists->id}}" disabled>{{$lists->category_name}}</option>
                                @endif 
                                    <!--<option value="{{$lists->id}}">{{$lists->category_name}}</option>-->
                                @endforeach
                               
                               
                            </select>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_title">Product Title</label>
                            <input type="text" class="form-control" placeholder="Product Title" value="{{$product_list[0]->title}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_value">Value</label>
                            <input type="number" class="form-control" placeholder="Product Value" value="{{$product_list[0]->value}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="delivery_time">Delivery Time</label>
                            <input type="number" class="form-control" placeholder="Product Value" value="{{$product_list[0]->delivery_time}}" disabled>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                        <label for="pro_shipping_charge">Product Shipping Charge</label>
                        <input type="number" class="form-control" placeholder="Product shipping charge" value="{{$product_list[0]->pro_shipping_charge}}" disabled>
                        <!--<textarea class="form-control" name="short_description" id="short_description" rows="3" placeholder="Enter ..."></textarea>-->
                  </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_title">Meta Title</label>
                            <input type="text" class="form-control" placeholder="Product meta title" value="{{$product_list[0]->pro_meta_title}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" rows="2" placeholder="Product meta keywords" disabled>{{$product_list[0]->pro_meta_keyword}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_description">Meta Description</label>
                            <textarea class="form-control" name="product_meta_description" id="product_meta_description" rows="2" placeholder="Product meta description" disabled>{{$product_list[0]->pro_meta_description}}</textarea>
                        </div>
                    </div>
                </div>




                  <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control" rows="3" placeholder="Enter ..." disabled>{{$product_list[0]->short_desc}}</textarea>
                  </div>
                  

                  <div class="form-group">
                        <label for="description">Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control"  rows="5" placeholder="Enter ..." disabled>{{$product_list[0]->desc}}</textarea>
                  </div>
                 
                  <div class="form-group">
                        <label for="kewords">Keywords</label>
                        <input type="text" class="form-control" placeholder="Searching Keywords" value="{{$product_list[0]->keywords}}" disabled>
                        <!--<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>-->
                  </div>
                  

                 @if($product_list[0]->pro_image != '')
                 <div class="form-group">
                  <a href="{{ asset('storage/products') }}/{{$product_list[0]->pro_image}}" target="_blank"> <img src="{{ asset('storage/products') }}/{{$product_list[0]->pro_image}}" width="10%" height="10%" /></a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" disabled>
                        <label class="custom-file-label" for="product_image"></label>
                      </div>
                    </div>
                  </div>
                 
                  @else
                  <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input"  disabled>
                        <label class="custom-file-label" for="product_image"></label>
                      </div>
                    </div>
                  </div>
                 

                 @endif
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <!--<button type="submit" class="btn btn-primary">Update</button> -->
                </div>
               <!--<input type="hidden" name="id" value="{{$product_list[0]->id}}"/>-->
              <!--</form> -->
            </div>
            <!-- /.card -->

            </div>
          <!--/.col (left) -->

          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




@endsection