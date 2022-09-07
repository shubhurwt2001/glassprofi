@extends('backend/adminlayout')

@section('page_title', 'Manage Slider')
@section('slider_select', 'active')

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
                <h3 class="card-title">Add Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.add.slider')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
  
                 
           <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                        <label for="slider_name">Slider Name</label>
                        <input name="slider_name" id="slider_name" type="text" class="form-control" placeholder="Slider name...." value="{{$slider_name}}">
                  </div>
                  @error('slider_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                        <label for="slider_slug">Slider Slug</label>
                        <input name="slider_slug" id="slider_slug" type="text" class="form-control" placeholder="Slider slug..." value="{{$slider_slug}}">
                  </div>
                  @error('slider_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror 
                </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                        <label for="slider_first_text">First text</label>
                        <input name="slider_first_text" id="slider_first_text" type="text" class="form-control" placeholder="Enter text..." value="{{$slider_first_ptag}}">
                  </div>
                  @error('slider_first_text')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                        <label for="slider_second_text">Second text</label>
                        <input name="slider_second_text" id="slider_second_text" type="text" class="form-control" placeholder="Enter text..." value="{{$slider_htag}}">
                  </div>
                  @error('slider_second_text')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror 
                </div>
              </div>

                  <div class="form-group">
                        <label for="slider_third_text">Third text</label>
                        <input name="slider_third_text" id="slider_third_text" type="text" class="form-control" placeholder="Enter text..." value="{{$slider_second_ptag}}">
                  </div>
                  @error('slider_third_text')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                
                  @if($slider_image != '')
                 <div class="form-group">
                  <a href="{{ asset('storage/slider') }}/{{$slider_image}}" target="_blank"> <img src="{{ asset('storage/slider') }}/{{$slider_image}}" width="10%" height="10%" /></a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Slider image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="slider_image" id="slider_image">
                        <label class="custom-file-label" for="slider_image">Change image</label>
                      </div>
                    </div>
                  </div>
                  @error('slider_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                  @else
                  <div class="form-group">
                    <label for="exampleInputFile">Slider image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="slider_image" id="slider_image">
                        <label class="custom-file-label" for="slider_image">Upload image</label>
                      </div>
                    </div>
                  </div>
                  @error('slider_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                 @endif
                 

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    @if($id !='')
                        <button type="submit" class="btn btn-primary">Update</button>
                    @else
                        <button type="submit" class="btn btn-primary">Add</button>
                    @endif
                      
                   
                  
                </div>
                <input type="hidden" name="id" value="{{$id}}"/>
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