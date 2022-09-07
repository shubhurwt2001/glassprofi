@extends('backend/adminlayout')

@section('page_title', 'Banner')
@section('register_user', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <!--<a href="javascript:void(0)"><button type="button" class="btn btn-success btn-flat float-right">Add Banner</button></a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="clientsays_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>First Name</th>
                      <th>Last Name </th>
                      <th>Email</th>
                      <th>Status</th>
                      <th class="not-export-col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($user_detail)>0)
                        @foreach($user_detail as $lists)
                          <td><?php echo $slno; ?></td>
                          
                          <td>{{ $lists->f_name }}</td>
                          <td>{{ $lists->l_name}}</td>
                          <td>{{ $lists->email}}</td>
                          
                        
                        <td>
                             @if($lists->status ==1)
                                <a href="{{route('admin.user.status',['status'=>0,'id'=> $lists->id])}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->status==0)
                                <a href="{{route('admin.user.status',['status'=>1,'id'=> $lists->id])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td> 
                        
                        
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="#">Edit</a>
                                <div class="dropdown-divider"></div>
                              
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
                      <th>First Name</th>
                      <th>Last Name </th>
                      <th>Email</th>
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

