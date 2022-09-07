@extends('backend/adminlayout')

@section('page_title', 'Manage Navbar')
@section('navbar_select', 'active')

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
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.add.navbar')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input name="category_name" id="category_name" type="text" class="form-control" placeholder="Category Name" value="{{$category_name}}">
                        </div>
                        @error('category_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_slug">Slug</label>
                            <input name="category_slug" id="category_slug" type="text" class="form-control" placeholder="Slug" value="{{$category_slug}}">
                        </div>
                        @error('category_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                    

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="parent_category">Parent Category</label>
                        <select id="parent_category"  name="parent_category" class="form-control">
                            <option value="0">Select Category</option>
                            @foreach($navbar as $lists)
                              @if($parent_category_id == $lists->id)
                              <option value="{{$lists->id}}" selected>{{$lists->category_name}}</option>
                              @else
                              <option value="{{$lists->id}}">{{$lists->category_name}}</option>
                              @endif
                            @endforeach
                        </select>
                    </div>
                    @error('parent_category')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                  </div>
            </div>

            <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="navbar_meta_title">Meta Title</label>
                            <input name="navbar_meta_title" id="navbar_meta_title" type="text" class="form-control" placeholder="meta title" value="{{$nav_meta_title}}">
                        </div>
                        @error('navbar_meta_title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="navbar_meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" name="navbar_meta_keywords" id="navbar_meta_keywords" rows="2" placeholder="meta keywords">{{$nav_meta_keyword}}</textarea>
                        </div>
                        @error('navbar_meta_keywords')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="navbar_meta_description">Meta Description</label>
                            <textarea class="form-control" name="navbar_meta_description" id="navbar_meta_description" rows="2" placeholder="meta description">{{$nav_meta_description}}</textarea>
                        </div>
                        @error('navbar_meta_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>
                </div>


                  @if($parent_category_id !=0)
                  <div class="form-group">
                        <label for="route_name">Route Name</label>
                        <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name" value="{{$category_route_name}}">-->
                        <select name="route_name" id="route_name" class="form-control">
                          <option value="">Please select route</option>
                          @if($category_route_name == "product.confiqurator")
                            <option value="product.configurator" selected>Product Configurator</option>
                            <option value="product.list">Product</option>
                          @elseif($category_route_name == "product.list")
                            <option value="product.configurator">Product Configurator</option>
                            <option value="product.list" selected>Product</option>
                          @else
                          <option value="product.configurator">Product Configurator</option>
                          <option value="product.list">Product</option>
                          @endif
                        </select>
                        <!--<textarea class="form-control" name="padel_address" id="padel_address" rows="2" placeholder="Enter ..."></textarea>-->
                  </div>
                  @error('route_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                @endif
                  <div class="form-group">
                        <label for="nav_short_description">Short Description</label>
                        <textarea class="form-control" name="nav_short_description" id="nav_short_description" rows="3" placeholder="Enter ...">{{$nav_short_description}}</textarea>
                  </div>
                  @error('nav_short_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                  <div class="form-group">
                        <label for="nav_description">Description</label>
                        <textarea class="form-control" name="nav_description" id="nav_description" rows="5" placeholder="Enter ...">{{$nav_description}}</textarea>
                  </div>
                  @error('nav_description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                 @if($category_image != '')
                 <div class="form-group">
                  <a href="{{ asset('storage/category') }}/{{$category_image}}" target="_blank"> <img src="{{ asset('storage/category') }}/{{$category_image}}" width="10%" height="10%" /></a>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="navbar_image" id="navbar_image">
                        <label class="custom-file-label" for="navbar_image">Change image</label>
                      </div>
                    </div>
                  </div>
                  @error('navbar_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                  @else
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="navbar_image" id="navbar_image">
                        <label class="custom-file-label" for="navbar_image">Upload image</label>
                      </div>
                    </div>
                  </div>
                  @error('navbar_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror

                 @endif
                 <?php /*
                  <!--<div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="navbar_image" id="navbar_image">
                        <label class="custom-file-label" for="navbar_image">Choose file</label>
                      </div>
                    </div>
                  </div> -->
                  @error('navbar_image')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                  @enderror
                    */?>
                 

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

@section('scripts')

<script type = "text/javascript">
    var simplemde = new SimpleMDE({element:$("#nav_short_description")[0]});
    var simplemde = new SimpleMDE({element:$("#nav_description")[0]});
</script>
@endsection