@extends('backend/adminlayout')

@section('page_title', 'Manage Client Says')
@section('clientsays_select', 'active')

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
                <h3 class="card-title">Edit Image Gallery</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.clientsays.update', $clientsays[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input name="client_name" id="client_name" type="text" class="form-control" placeholder="client name" value="{{$clientsays[0]->client_name}}">
                        </div>
                        @error('client_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Client Quote</label>
                            <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                            <textarea class="form-control" name="client_quote" id="client_quote" rows="5" placeholder="Enter ...">{{$clientsays[0]->client_quote}}</textarea>
                      </div>
                        @error('client_quote')
                                  <div class="alert alert-danger" role="alert">
                                      {{$message}} 
                                  </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        @if($clientsays[0]->client_image != '')
                            <a href="{{asset('storage/clientsays/'.$clientsays[0]->client_image)}}"><img src="{{asset('storage/clientsays/'.$clientsays[0]->client_image)}}" width="50" height="50" /></a>
                          @else
                            <p>No Image uploaded</p>
                          @endif
                          <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image_gallery" id="image_gallery">
                                    <label class="custom-file-label" for="image_gallery">Upload Image</label>
                                </div>
                                </div>
                            </div>
                            @error('image_gallery')
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
                
                <input type="hidden" name="id" value="{{base64_encode($clientsays[0]->id)}}" />
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
   
    var simplemde = new SimpleMDE({element:$("#client_quote")[0]});
</script>
@endsection