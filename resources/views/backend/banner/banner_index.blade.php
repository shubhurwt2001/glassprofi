@extends('backend/adminlayout')

@section('page_title', 'Banner')
@section('banner_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Banners</h3>
                <!--<a href="javascript:void(0)"><button type="button" class="btn btn-success btn-flat float-right">Add Banner</button></a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="clientsays_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      
                      <th>Location</th>
                      <th>Heading </th>
                      <th>Paragraph</th>
                      <th>Image</th>
                      <!--<th>Status</th>-->
                      
                      <th class="not-export-col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($banner)>0)
                        @foreach($banner as $lists)
                          <td><?php echo $slno; ?></td>
                          
                          <td>{{ $lists->banner_location }}</td>
                          <td>{{ $lists->banner_heading}}</td>
                          <td>{{ $lists->banner_para}}</td>
                          <td>
                              @if($lists->banner_image != '')
                                <a href="{{asset('storage/banner/'.$lists->banner_image)}}" target="_blank">
                                  <img  src="{{asset('storage/banner/'.$lists->banner_image)}}" width="30" height="30"/>
                                <a>
                              @else
                                No image.
                              @endif
                          </td>
                        <?php /*
                        <td>
                             @if($lists->status ==1)
                                <a href="{{route('admin.banner.status', ['status'=>0,'id'=> $lists->id])}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->status==0)
                                <a href="{{route('admin.banner.status', ['status'=>1,'id'=> $lists->id])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td> */
                        ?>
                        <!-- <td>{{ $lists->created_at }}</td>
                        <td>{{ $lists->updated_at }}</td> -->
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{route('admin.banner.edit',$lists->id )}}">Edit</a>
                                <div class="dropdown-divider"></div>
                               <!-- <form action="#" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="dropdown-item" type="submit">Delete</button> 
                                </form> -->
                            </div>
                            </div>
                        </td>
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach()
                      @else
                        <td colspan="8">No data found</td>
                    @endif
                  </tbody>

                  <tfoot>
                    <tr>
                    
                    <th style="width: 10px">#</th>
                    
                    
                    <th>Location</th>
                      <th>Heading </th>
                      <th>Paragraph</th>
                      <th>Image</th>
                      <th>Status</th>
                     
                      <th class="not-export-col">Action</th>
                    </tr>
                  </tfoot>


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

