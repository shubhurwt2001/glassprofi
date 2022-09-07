@extends('backend/adminlayout')

@section('page_title', 'Manage Sample Products')
@section('sampleproducts_select', 'active')

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
                <h3 class="card-title">Add Sample Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.sampleproduct.store')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_name">Sample Product Name</label>
                            <input name="sample_product_name" id="sample_product_name" type="text" class="form-control" placeholder="Sample product name">
                        </div>
                        @error('sample_product_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_slug">Slug</label>
                            <input name="sample_product_slug" id="sample_product_slug" type="text" class="form-control" placeholder="Slug">
                        </div>
                        @error('sample_product_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                    

                    
                </div>



                <div class="row">
                    <div class="col-md-6">
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


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_value">Value</label>
                            <input name="sample_product_value" id="sample_product_value" type="text" class="form-control" placeholder="Free" disabled>
                        </div>
                        @error('sample_product_value')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                </div>

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
                        <label for="keywords">Keywords</label>
                        <input name="keywords" id="keywords" type="text" class="form-control" placeholder="Searching Keywords">
                        <!--<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                
                  <div class="form-group">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="sample_product_image" id="sample_product_image">
                        <label class="custom-file-label" for="sample_product_image">Upload image</label>
                      </div>
                    </div>
                  </div>
                  @error('sample_product_image')
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
    //var simplemde = new SimpleMDE({element:$("#short_description")[0]});
    var simplemde = new SimpleMDE({element:$("#description")[0]});
</script>
@endsection