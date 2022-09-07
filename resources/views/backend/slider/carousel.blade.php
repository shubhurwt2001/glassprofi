@extends('backend/adminlayout')

@section('page_title', 'Slider')
@section('slider_select', 'active')

@section('container')
@include('backend.messages.message')


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Slider</h3>
                <a href="{{route('admin.add.slider')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Slider</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Image</th>
                      <th>Image Name</th>
                      <!--<th>Image Slug</th> -->
                      <th>First Text</th>
                      <th>Second Text</th>
                      <th>Third Text</th>
                      <th>Status</th>
                      <!--<th>Added on</th>
                      <th>Updated on</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($slider->count()>0)
                        @foreach($slider as $lists)
                          <td><?php echo $slno; ?></td>
                          <!--<td>{{-- $lists->id --}}</td>-->
                          <td>
                              @if($lists->slider_image != '')
                                <a href="{{asset('storage/slider/'.$lists->slider_image)}}" target="_blank">
                                  <img  src="{{asset('storage/slider/'.$lists->slider_image)}}" width="20" height="20"/>
                                <a>
                              @else
                                No image.
                              @endif
                          </td>
                        
                        
                        <td>{{$lists->slider_name}}</td>
                        <!--<td>{{-- $lists->slider_slug --}}</td>-->
                        <td>{{$lists->slider_first_ptag}}</td>
                        <td>{{ $lists->slider_htag }}</td>
                        <td>{{ $lists->slider_second_ptag }}</td>
                        
                        <td>
                             @if($lists->slider_status ==1)
                                <a href="{{route('admin.slider.status', ['status'=>0,'slug'=> $lists->slider_slug])}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->slider_status==0)
                                <a href="{{route('admin.slider.status', ['status'=>1,'slug'=> $lists->slider_slug])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td>
                        <!--<td>{{-- $lists->created_at --}}</td>
                        <td>{{-- $lists->updated_at --}}</td> -->
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <!--<a class="dropdown-item" href="#">Show</a> -->
                                <a class="dropdown-item" href="{{route('admin.slider.edit', $lists->id)}}">Edit</a>
                                <!--<a class="dropdown-item" href="#">Something else here</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.slider.delete', $lists->id)}}">Delete</a>
                            </div>
                            </div>
                        </td>
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach()
                      @else
                        <td colspan="8">No Menu item found</td>
                    @endif
                  </tbody>

                  <thead>
                    <tr>
                    
                    <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Image</th>
                      <th>Image Name</th>
                      <!--<th>Image Slug</th> -->
                      <th>First Text</th>
                      <th>Second Text</th>
                      <th>Third Text</th>
                      <th>Status</th>
                      <!--<th>Added on</th>
                      <th>Updated on</th> -->
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