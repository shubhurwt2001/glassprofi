@extends('backend/adminlayout')

@section('page_title', 'What Client Says')
@section('clientsays_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Client Says</h3>
                <a href="{{route('admin.clientsays.create')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Client Quote</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="clientsays_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      
                      <th>Client Name</th>
                      <th>Client Quote </th>
                      <th>Client Image</th>
                      <th>Status</th>
                      
                      <th class="not-export-col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($clientsays->count()>0)
                        @foreach($clientsays as $lists)
                          <td><?php echo $slno; ?></td>
                          
                          <td>{{ $lists->client_name }}</td>
                          <td>{{ $lists->client_quote}}</td>
                          <td>
                              @if($lists->client_image != '')
                                <a href="{{asset('storage/clientsays/'.$lists->client_image)}}" target="_blank">
                                  <img  src="{{asset('storage/clientsays/'.$lists->client_image)}}" width="30" height="30"/>
                                <a>
                              @else
                                No image.
                              @endif
                          </td>
               
                        <td>
                             @if($lists->status ==1)
                                <a href="{{route('admin.clientsays.status', ['status'=>0,'id'=> $lists->id])}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->status==0)
                                <a href="{{route('admin.clientsays.status', ['status'=>1,'id'=> $lists->id])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td>
                        <!-- <td>{{ $lists->created_at }}</td>
                        <td>{{ $lists->updated_at }}</td> -->
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{route('admin.clientsays.edit',$lists->id )}}">Edit</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{route('admin.clientsays.destroy', $lists->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="dropdown-item" type="submit">Delete</button> 
                                </form>
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
                    
                    <th>Client Name</th>
                      <th>Client Quote </th>
                      <th>Client Image</th>
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

