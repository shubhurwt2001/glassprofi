@extends('backend/adminlayout')

@section('page_title', 'Manage Image Gallery')
@section('imagegallery_select', 'active')

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
              <form action="{{route('admin.imagegallery.update', $imagegallery[0]->slug)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                            <label for="image_name">Image Name</label>
                            <input name="image_name" id="image_name" type="text" class="form-control" placeholder="image name" value="{{$imagegallery[0]->image_name}}">
                        </div>
                        @error('image_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image_slug">Image Slug</label>
                            <input name="image_slug" id="image_slug" type="text" class="form-control" placeholder="image slug" value="{{$imagegallery[0]->slug}}">
                        </div>
                        @error('image_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        @if($imagegallery[0]->image != '')
                            <a href="{{asset('storage/imagegallery/'.$imagegallery[0]->image)}}"><img src="{{asset('storage/imagegallery/'.$imagegallery[0]->image)}}" width="50" height="50" /></a>
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
                
                <input type="hidden" name="id" value="{{base64_encode($imagegallery[0]->id)}}" />
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