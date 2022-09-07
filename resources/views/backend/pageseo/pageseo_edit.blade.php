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
              <form action="{{route('admin.seo.update', $homepageseo->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">

                
                
                <div class="row">
                  <div class="col-md-12">
                          <div class="form-group">
                              <label for="page_name">Page</label>
                              <input type="text" class="form-control" placeholder="Page name" value="{{$homepageseo->page_name}}" disabled>
                          </div>
                      </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="meta title" value="{{$homepageseo->meta_title}}">
                        </div>
                        @error('navbar_meta_title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="2" placeholder="meta keywords">{{$homepageseo->meta_keywords}}</textarea>
                        </div>
                        @error('navbar_meta_keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="2" placeholder="meta description">{{$homepageseo->meta_description}}</textarea>
                        </div>
                        @error('navbar_meta_description')
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

