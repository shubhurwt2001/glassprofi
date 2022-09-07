@extends('backend/adminlayout')

@section('page_title', 'Navbar')
@section('navbar_select', 'active')

@section('container')
@include('backend.messages.message')


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Menu Category</h3>
                <a href="{{route('admin.manage.navbar')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Menu</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="navbar_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Category Name</th>
                      <th>Category Slug</th>
                      <th>Parent Category Name</th>
                      <th class="not-export-col">Category Image</th>
                      <th>Status</th>
                      <th>Show on Home Page</th>
                      <!--<th>Added on</th>
                      <th>Updated on</th>-->
                      <th class="not-export-col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($navbar->count()>0)
                        @foreach($navbar as $lists)
                        <td><?php echo $slno; ?></td>
                        <!--<td>{{-- $lists->id --}}</td> -->
                        <td>{{$lists->category_name}}</td>
                        <td>{{$lists->category_slug}}</td>
                        @if($lists->parent_category_id == "0")
                          <td>{{$lists->category_name}}</td>
                        @else
                          @foreach($navbar as $cat_name)
                         
                            @if($cat_name->id == $lists->parent_category_id)
                              <td>{{$cat_name->category_name}}</td>
                            @endif
                          @endforeach
                        @endif
                        <!--<td>{{-- $lists->category_image --}}</td> -->
                        <td>
                          @if($lists->category_image != '')
                            <a href="{{asset('storage/category/'.$lists->category_image)}}" target="_blank">
                              <img  src="{{asset('storage/category/'.$lists->category_image)}}" width="20" height="20"/>
                            <a>
                          @else
                            No image.
                          @endif
                        </td>
                        <td>
                             @if($lists->category_status ==1)
                                <a href="{{url('admin/navbar/status/0')}}/{{$lists->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->category_status==0)
                                <a href="{{url('admin/navbar/status/1')}}/{{$lists->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                              @endif
                        </td>

                        <td>
                             @if($lists->show_home_page == 'Yes')
                                <a href="{{url('admin/navbar/show/No')}}/{{$lists->id}}"><button type="button" class="btn btn-primary">Yes</button></a>
                              @elseif($lists->show_home_page== 'No' && $lists->parent_category_id != 0)
                                <a href="{{url('admin/navbar/show/Yes')}}/{{$lists->id}}"><button type="button" class="btn btn-warning">No</button></a>
                               @elseif($lists->parent_category_id== 0)
                                <a href="javascript:void(0)"><button type="button" class="btn btn-warning" Disabled> - </button></a>
                              @endif
                        </td>


                        
                       <!-- <td>{{-- $lists->created_at --}}</td>
                        <td>{{-- $lists->updated_at --}}</td> -->
                        
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <!--<a class="dropdown-item" href="#">Show</a> -->
                                <a class="dropdown-item" href="{{route('admin.edit.navbar', $lists->id)}}">Edit</a>
                                <!--<a class="dropdown-item" href="#">Something else here</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('admin/navbar/delete')}}/{{$lists->id}}">Delete</a>
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

                  <tfoot>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Category Name</th>
                      <th>Category Slug</th>
                      <th>Parent Category Name</th>
                      <th class="not-export-col">Category Image</th>
                      <th>Status</th>
                      <th>Show on Home Page</th>
                      <!--<th>Added on</th>
                      <th>Updated on</th> -->
                      <th class="not-export-col">Action</th>
                    </tr>
                  </tfoot>


                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <!-- {{-- $navbar->links() --}}--> 
                  
                </ul>
              </div>
            </div>
            <!-- /.card -->

            </div>
          <!-- /.col -->

          </div>
        <!-- /.row -->

@endsection

@section('scripts')
<script>
  $(function () {
    $("#navbar_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      
      //"buttons": ["excel", "pdf", "print"]
      /*"buttons":[
                  {
                    //text: 'Excel',
                    extend: 'excelHtml5',
                    exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                  },
                   {  //text: 'pdf',
                      extend: 'pdfHtml5',
                      exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        //text: 'print',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                 ]*/
    }).buttons().container().appendTo('#navbar_list_wrapper .col-md-6:eq(0)');

    
  });
</script>
@endsection