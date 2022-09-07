@extends('backend/adminlayout')

@section('page_title', 'Manage Banner')
@section('banner_select', 'active')

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
                <h3 class="card-title">Edit Banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.banner.update', $banner[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="banner_heading">Banner Heading</label>
                            <input name="banner_heading" id="banner_heading" type="text" class="form-control" placeholder="Banner heading" value="{{$banner[0]->banner_heading}}">
                        </div>
                        @error('banner_heading')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Banner Paragraph</label>
                            <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                            <textarea class="form-control" name="banner_paragraph" id="banner_paragraph" rows="2" placeholder="Enter ...">{{$banner[0]->banner_para}}</textarea>
                      </div>
                        @error('banner_paragraph')
                                  <div class="alert alert-danger" role="alert">
                                      {{$message}} 
                                  </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        @if($banner[0]->banner_image != '')
                            <a href="{{asset('storage/banner/'.$banner[0]->banner_image)}}"><img src="{{asset('storage/banner/'.$banner[0]->banner_image)}}" width="50" height="50" /></a>
                          @else
                            <p>No Image uploaded</p>
                          @endif
                          <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="banner_image" id="banner_image">
                                    <label class="custom-file-label" for="banner_image">Upload Image</label>
                                </div>
                                </div>
                            </div>
                            @error('banner_image')
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

