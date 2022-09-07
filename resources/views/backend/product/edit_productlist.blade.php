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
                <h3 class="card-title">Edit Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productlist.update', $product_list[0]->slug)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input name="product_name" id="product_name" type="text" class="form-control" placeholder="Product Name" value="{{$product_list[0]->name}}">
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
                            <input name="product_slug" id="product_slug" type="text" class="form-control" placeholder="Slug" value="{{$product_list[0]->slug}}">
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
                               
                                @if($product_list[0]->navbars_id == $lists->id)
                                 <option value="{{$lists->id}}" selected>{{$lists->category_name}}</option>      -->
                                @else
                                <option value="{{$lists->id}}">{{$lists->category_name}}</option>
                                @endif 
                                    <!--<option value="{{$lists->id}}">{{$lists->category_name}}</option>-->
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
                            <input name="product_title" id="product_title" type="text" class="form-control" placeholder="Product Title" value="{{$product_list[0]->title}}">
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
                            <input name="product_value" id="product_value" type="number" class="form-control" placeholder="Product Value" value="{{$product_list[0]->value}}">
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
                            <input name="delivery_time" id="delivery_time" type="number" class="form-control" placeholder="Product Value" value="{{$product_list[0]->delivery_time}}">
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
                            @if($product_list[0]->sample_product == "No")
                                <option value="No" selected>No</option>
                                <option value="Yes">Yes</option>
                            @else
                                <option value="No">No</option>
                                <option value="Yes" selected>Yes</option>
                            @endif
                            
                        </select>
                  </div>
                  @error('sample_product')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror


                <div class="form-group">
                        <label for="pro_shipping_charge">Product Shipping Charge</label>
                        <input name="pro_shipping_charge" id="pro_shipping_charge" type="number" class="form-control" placeholder="Product shipping charge" value="{{$product_list[0]->pro_shipping_charge}}">
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
                            <input name="product_meta_title" id="product_meta_title" type="text" class="form-control" placeholder="Product meta title" value="{{$product_list[0]->pro_meta_title}}">
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
                            <textarea class="form-control" name="product_meta_keywords" id="product_meta_keywords" rows="2" placeholder="Product meta keywords">{{$product_list[0]->pro_meta_keyword}}</textarea>
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
                            <textarea class="form-control" name="product_meta_description" id="product_meta_description" rows="2" placeholder="Product meta description">{{$product_list[0]->pro_meta_description}}</textarea>
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
                        <textarea class="form-control" name="short_description" id="short_description" rows="3" placeholder="Enter ...">{{$product_list[0]->short_desc}}</textarea>
                  </div>
                  @error('short_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="description">Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ...">{{$product_list[0]->desc}}</textarea>
                  </div>
                  @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="kewords">Keywords</label>
                        <input name="kewords" id="kewords" type="text" class="form-control" placeholder="Searching Keywords" value="{{$product_list[0]->keywords}}">
                        <!--<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                 @if($product_list[0]->pro_image != '')
                 <div class="form-group">
                  <a href="{{ asset('storage/products') }}/{{$product_list[0]->pro_image}}" target="_blank"> <img src="{{ asset('storage/products') }}/{{$product_list[0]->pro_image}}" width="10%" height="10%" /></a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="product_image" id="product_image">
                        <label class="custom-file-label" for="product_image">Change image</label>
                      </div>
                    </div>
                  </div>
                  @error('product_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                  @else
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

                 @endif
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
               <input type="hidden" name="id" value="{{$product_list[0]->id}}"/>
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
    var simplemde1 = new SimpleMDE({element:$("#description")[0]});
</script>
@endsection