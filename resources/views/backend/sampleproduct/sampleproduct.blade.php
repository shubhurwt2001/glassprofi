@extends('backend/adminlayout')

@section('page_title', 'Sample Products')
@section('sampleproducts_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sample Products</h3>
                <a href="{{route('admin.sampleproduct.create')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Product</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="sample_products" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th>-->
                      <th>Name</th>
                      <!--<th>Slug</th>-->
                      <th>Value</th>
                      <th>Delivery time</th>
                      <!--<th>Route Name</th>-->
                      <!--<th>Desc</th> -->
                      <!--<th>Keywords</th> -->
                      <th class=".not-export-col">pro_image</th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($sampleproduct)>0)
                        @foreach($sampleproduct as $lists)
                          <td><?php echo $slno; ?></td>
                          <!-- <td>{{ $lists->id }}</td>-->
                          <td>{{ $lists->name }}</td>
                          <!--<td>{{ $lists->slug }}</td> -->
                          <td>{{ $lists->value }}</td>
                          <td> ± {{ $lists->delivery_time }}</td>
                          <!--<td>{{ $lists->product_route_name }}</td> -->
                          <!--<td>{{ $lists->short_desc }}</td> -->
                          <!-- <td>{{ $lists->keywords }}</td> -->
                          
                          <td>
                              @if($lists->pro_image != '')
                                <a href="{{asset('storage/sampleproducts/'.$lists->pro_image)}}" target="_blank">
                                  <img  src="{{asset('storage/sampleproducts/'.$lists->pro_image)}}" width="30" height="30"/>
                                <a>
                              @else
                                No image.
                              @endif
                          </td>
                        
                        
                        <td>
                             @if($lists->pro_status ==1)
                                <a href="{{route('admin.sampleproduct.status', ['status'=>0,'slug'=> $lists->slug])}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->pro_status==0)
                                <a href="{{route('admin.sampleproduct.status', ['status'=>1,'slug'=> $lists->slug])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
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
                                <a class="dropdown-item" href="{{route('admin.sampleproduct.show',$lists->slug )}}">Show</a>
                                <a class="dropdown-item" href="{{route('admin.sampleproduct.edit',$lists->slug )}}">Edit</a>
                                <div class="dropdown-divider"></div>
                                <!--<a class="dropdown-item" href="{{route('admin.productlist.destroy', $lists->slug)}}">Delete</a>-->
                                <form action="{{route('admin.sampleproduct.destroy', $lists->slug)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <!--<a class="dropdown-item" href="javascript:void(0)">Delete</a>-->
                                    <button class="dropdown-item" type="submit">Delete</button> 
                                </form>
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
                      <!--<th>ID</th>-->
                      <th>Name</th>
                      <!--<th>Slug</th>-->
                      <th>Value</th>
                      <th>Delivery time</th>
                      <!--<th>Route Name</th>-->
                      <!--<th>Desc</th> -->
                      <!--<th>Keywords</th> -->
                      <th>pro_image</th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
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

@section('scripts')
<script>
  $(function () {
    $("#sample_products").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["excel", "pdf", "print"]
      "buttons":[
                  {
                    //text: 'excel',
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
                 ]
    }).buttons().container().appendTo('#sample_products_wrapper .col-md-6:eq(0)');

    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });

  });
</script>
@endsection