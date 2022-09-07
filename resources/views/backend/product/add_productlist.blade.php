@extends('backend/adminlayout')

@section('page_title', 'Manage Products')
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
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productlist.store')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input name="product_name" id="product_name" type="text" class="form-control" placeholder="Product Name">
                        </div>
                        @error('product_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_slug">Slug</label>
                            <input name="product_slug" id="product_slug" type="text" class="form-control" placeholder="Slug">
                        </div>
                        @error('product_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select id="category"  name="category" class="form-control">
                                <option value="">Select Category</option>
                              
                                @foreach($navbar as $lists)
                                <?php /*
                                @if($parent_category_id == $lists->parent_category_id)
                                    @if($parent_category_id == 0)
                                    <option value="{{$lists->id}}">{{$lists->category_name}}</option>
                                    @else
                                    <option value="{{$lists->id}}" selected>{{$lists->category_name}}</option>      
                                    @endif
                                <!-- <option value="{{$lists->id}}" selected>{{$lists->category_name}}</option>      -->
                                @else
                                <option value="{{$lists->id}}">{{$lists->category_name}}</option>
                                @endif */ ?>
                                    <option value="{{$lists->id}}">{{$lists->category_name}}</option>
                                @endforeach
                               
                               
                            </select>
                        </div>
                            @error('category')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}} 
                                </div>
                            @enderror
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_title">Product Title</label>
                            <input name="product_title" id="product_title" type="text" class="form-control" placeholder="Product Title">
                        </div>
                        @error('product_title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_value">Value</label>
                            <input name="product_value" id="product_value" type="number" class="form-control" placeholder="Product Value">
                        </div>
                        @error('product_value')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="delivery_time">Delivery Time</label>
                            <input name="delivery_time" id="delivery_time" type="number" class="form-control" placeholder="Delivery time">
                        </div>
                        @error('delivery_time')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                        <label for="sample_product">Sample Product</label>
                        <!--<input  type="number" class="form-control" placeholder="Product shipping charge">-->
                        <select name="sample_product" id="sample_product" class="form-control">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                  </div>
                  @error('sample_product')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                <div class="form-group">
                        <label for="pro_shipping_charge">Product Shipping Charge</label>
                        <input name="pro_shipping_charge" id="pro_shipping_charge" type="number" class="form-control" placeholder="Product shipping charge">
                        <!--<textarea class="form-control" name="short_description" id="short_description" rows="3" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('short_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_title">Meta Title</label>
                            <input name="product_meta_title" id="product_meta_title" type="text" class="form-control" placeholder="Product meta title">
                        </div>
                        @error('product_meta_title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_keywords">Meta Keywords</label>
                            <!--<input name="product_meta_keywords" id="product_meta_keywords" type="text" class="form-control" placeholder="Product meta keywords">-->
                            <textarea class="form-control" name="product_meta_keywords" id="product_meta_keywords" rows="2" placeholder="Product meta keywords"></textarea>
                        </div>
                        @error('product_meta_keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_meta_description">Meta Description</label>
                            <!--<input name="product_meta_description" id="product_meta_description" type="text" class="form-control" placeholder="Product meta description">-->
                            <textarea class="form-control" name="product_meta_description" id="product_meta_description" rows="2" placeholder="Product meta description"></textarea>
                        </div>
                        @error('product_meta_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                </div>






                  <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control" name="short_description" id="short_description" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                  @error('short_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="description">Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>
                  </div>
                  @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="kewords">Keywords</label>
                        <input name="kewords" id="kewords" type="text" class="form-control" placeholder="Searching Keywords">
                        <!--<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('kewords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                
                  <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="product_image" id="product_image">
                        <label class="custom-file-label" for="product_image">Upload image</label>
                      </div>
                    </div>
                  </div>
                  @error('product_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
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

@section('scripts')

<script type = "text/javascript">
    var simplemde = new SimpleMDE({element:$("#short_description")[0]});
    var simplemde = new SimpleMDE({element:$("#description")[0]});
</script>
@endsection