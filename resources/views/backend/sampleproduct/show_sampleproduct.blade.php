@extends('backend/adminlayout')

@section('page_title', 'Sample Product Information')
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
                <h3 class="card-title">Sample Product Information</h3>
              </div>
              <!-- /.card-header -->
              
              
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_name">Sample Product Name</label>
                            <input type="text" class="form-control" value="{{$sample_product[0]->name}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_slug">Slug</label>
                            <input type="text" class="form-control" value="{{$sample_product[0]->slug}}" disabled>
                        </div>
                    </div>
                    

                    
                </div>



                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_time">Delivery Time</label>
                                <input type="number" class="form-control" placeholder="Delivery time" value="{{$sample_product[0]->delivery_time}}" disabled>
                            </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sample_product_value">Value</label>
                            <input name="sample_product_value" id="sample_product_value" type="text" class="form-control" placeholder="Free" disabled>
                        </div>
                    </div>
                </div>

                  <div class="form-group">
                        <label for="description">Description</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter ..." disabled>{{$sample_product[0]->short_desc}}</textarea>
                  </div>
                 

                  <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input type="text" class="form-control" placeholder="Searching Keywords" value="{{$sample_product[0]->keywords}}" disabled>
                  </div>

                
                  @if($sample_product[0]->pro_image != "")
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <!--<input type="file" class="custom-file-input" name="sample_product_image" id="sample_product_image">
                          <label class="custom-file-label" for="sample_product_image">Upload image</label>-->
                          <a href="{{asset('storage/sampleproducts/'.$sample_product[0]->pro_image)}}" target="_blank">
                            <img  src="{{asset('storage/sampleproducts/'.$sample_product[0]->pro_image)}}" width="30" height="30"/>
                          <a>
                        </div>
                      </div>
                    </div>
                      
                  @else
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" placeholder="No Image uploaded" disabled>
                          <label class="custom-file-label" for="sample_product_image">Upload image</label>
                        </div>
                      </div>
                    </div>
                  @endif
                  

                
                 
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                      <a href="{{route('admin.sampleproduct.index')}}">  <button class="btn btn-primary">Back</button> </a>
                </div>
             
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
    //var simplemde = new SimpleMDE({element:$("#description")[0]});
</script>
@endsection