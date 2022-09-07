@extends('backend/adminlayout')

@section('page_title', 'Manage Product Image')
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
                <h3 class="card-title">Edit Product Image</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productimage.update', $product_image[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                            <label for="product_image_name">Product Image Name</label>
                            <input name="product_image_name" id="product_image_name" type="text" class="form-control" placeholder="Product image name" value="{{$product_image[0]->image_name}}">
                        </div>
                        @error('product_image_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        @if($product_image[0]->image != '')
                            <a href="{{asset('storage/products/'.$product_image[0]->image)}}"><img src="{{asset('storage/products/'.$product_image[0]->image)}}" width="50" height="50" /></a>
                          @else
                            <p>No document uploaded</p>
                          @endif
                          <div class="form-group">
                                <label for="exampleInputFile">Product Image</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_image" id="product_image">
                                    <label class="custom-file-label" for="product_image">Upload Image</label>
                                </div>
                                </div>
                            </div>
                            @error('product_image')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}} 
                                        </div>
                            @enderror
                    </div>
                </div>


                
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
                
                <input type="hidden" name="product_slug" value="{{$product_slug}}" />
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