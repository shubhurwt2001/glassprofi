@extends('backend/adminlayout')

@section('page_title', 'Add Product Attribute Image')
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
                <h3 class="card-title">Add Product Attribute Image</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productattribute.store.image')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="image_name">Image Name</label>
                            <input name="image_name" id="image_name" type="text" class="form-control" placeholder="Attribute image name">
                        </div>
                        @error('image_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price_from">Price From</label>
                            <input name="price_from" id="price_from" type="number" class="form-control" placeholder="Price starting from">
                        </div>
                        @error('price_from')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                                <label for="exampleInputFile">Product Attribute Image</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_attribute_image" id="product_attribute_image">
                                    <label class="custom-file-label" for="product_attribute_image">Upload Image</label>
                                </div>
                                </div>
                            </div>
                            @error('product_attribute_image')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}} 
                                        </div>
                            @enderror
                    </div>
                </div>


                
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <input type="hidden" name="product_id" value={{$productlist[0]->id}} />
                <input type="hidden" name="product_slug" value={{$productlist[0]->slug}} />
                <input type="hidden" name="product_attribute_id" value="{{$productattribute[0]->id}}" />
                
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