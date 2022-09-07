@extends('backend/adminlayout')

@section('page_title', 'Manage Product Feature')
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
                <h3 class="card-title">Edit Product Features</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productfeature.update', $product_feature[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_feature_name">Product Feature Name</label>
                            <input name="product_feature_name" id="product_feature_name" type="text" class="form-control" placeholder="Product Feature Name" value="{{$product_feature[0]->feature_title}}">
                        </div>
                        @error('product_feature_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_feature">Product Feature</label>
                            <input name="product_feature" id="product_feature" type="text" class="form-control" placeholder="Product Feature" value="{{$product_feature[0]->feature}}">
                        </div>
                        @error('product_feature')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pro_feature_sl_no.">Product Serial No.</label>
                            <input name="pro_feature_sl_no" id="pro_feature_sl_no" type="number" min="0" class="form-control" placeholder="Product Feature Serial Number" value="{{$product_feature[0]->pro_feature_serial_no}}">
                        </div>
                        @error('pro_feature_sl_no')
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