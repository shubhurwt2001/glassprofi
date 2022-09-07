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
                <h3 class="card-title">Edit Sample Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.sampleproduct.update', $sample_product[0]->slug)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_name">Sample Product Name</label>
                            <input name="sample_product_name" id="sample_product_name" type="text" class="form-control" value="{{$sample_product[0]->name}}">
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
                            <input name="sample_product_slug" id="sample_product_slug" type="text" class="form-control" placeholder="Slug" value="{{$sample_product[0]->slug}}">
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
                                <input name="delivery_time" id="delivery_time" type="number" class="form-control" placeholder="Delivery time" value="{{$sample_product[0]->delivery_time}}">
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
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ...">{{$sample_product[0]->short_desc}}</textarea>
                  </div>
                  @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input name="keywords" id="keywords" type="text" class="form-control" placeholder="Searching Keywords" value="{{$sample_product[0]->keywords}}">
                        <!--<textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror


                  @if($sample_product[0]->pro_image != "")
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image</label>
                      <div class="input-group">
                        
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="sample_product_image" id="sample_product_image">
                          <label class="custom-file-label" for="sample_product_image">Change image</label>
                        </div>
                      </div>
                    </div>
                    @error('sample_product_image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}} 
                                </div>
                    @enderror
                    <a href="{{asset('storage/sampleproducts/'.$sample_product[0]->pro_image)}}" target="_blank">
                            <img  src="{{asset('storage/sampleproducts/'.$sample_product[0]->pro_image)}}" width="50" height="50"/>
                          <a>
                      
                  @else
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
                  @endif


                
                  

                
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <input type="hidden" name="id" value="{{$sample_product[0]->id}}"/>
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