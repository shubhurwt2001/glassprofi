@extends('backend/adminlayout')

@section('page_title', 'Image Gallery')
@section('imagegallery_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Image Gallery</h3>
                <a href="{{route('admin.imagegallery.create')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Image</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Image Name</th>
                      <th>Image Slug</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($imagegallery->count()>0)
                        @foreach($imagegallery as $lists)
                          <td><?php echo $slno; ?></td>
                          <!--<td>{{-- $lists->id --}}</td>-->
                          <td>{{ $lists->image_name }}</td>
                          <td>{{ $lists->slug }}</td>
                          <td>
                          @if($lists->image != '')
                          <a href="{{asset('storage/imagegallery/'.$lists->image)}}"><img src="{{asset('storage/imagegallery/'.$lists->image)}}" width="50" height="50" /></a>
                          @else
                            <p>No Image added</p>
                          @endif
                          </td>
                        <td>
                             @if($lists->image_status ==1)
                                <a href="{{ route('admin.imagegallery.status', ['status'=>0,'slug'=> $lists->id]) }}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->image_status==0)
                                <a href="{{ route('admin.imagegallery.status', ['status'=>1,'slug'=> $lists->id]) }}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td>
                        <td>{{ $lists->created_at }}</td>
                        <td>{{ $lists->updated_at }}</td>
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <!--<a class="dropdown-item" href="#">Show</a> -->
                                <a class="dropdown-item" href="{{route('admin.imagegallery.edit',[$lists->slug] )}}">Edit</a>
                                
                                <div class="dropdown-divider"></div>
                                
                                <form action="{{route('admin.imagegallery.destroy', $lists->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <!--<a class="dropdown-item" href="javascript:void(0)">Delete</a>-->
                                    <button class="dropdown-item" type="submit">Delete</button>
                                    <input type="hidden" name="image_slug" value="#" /> 
                                </form>
                            </div>
                            </div>
                        </td>
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach
                      @else
                        <td colspan="9">No Image Gallery created yet</td>
                    @endif
                  </tbody>

                  <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Image Name</th>
                      <th>Image Slug</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>


                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                
                  
                </ul>
              </div>
            </div>
            <!-- /.card -->

            </div>
          <!-- /.col -->

          </div>
        <!-- /.row -->

@endsection