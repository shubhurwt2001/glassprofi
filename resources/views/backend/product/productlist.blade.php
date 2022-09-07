@extends('backend/adminlayout')

@section('page_title', 'Products')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Products</h3>
            <a href="{{route('admin.productlist.create')}}"><button type="button" class="btn btn-success btn-flat float-right">Add Product</button></a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <table id="products_list" class="table table-bordered table-striped table-responsive">

              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <!--<th>ID</th> -->
                  <th>Name</th>
                  <th>Vanaf</th>
                  <th>Levertijd </th>
                  <!--<th>Slug</th> -->
                  <th>Sample</th>
                  <!--<th>Short Desc</th>
                      <th>Desc</th>-->
                  <!--<th>Keywords</th> -->
                  <th class="not-export-col">pro_image</th>
                  <!--<th>navbars_id</th>-->
                  <th>Category Name</th>
                  <th>Status</th>
                  <th>Is Popular</th>
                  <th>Show Home Page</th>

                  <!--<th>Added on</th>
                      <th>Updated on</th> -->
                  <th class="not-export-col">Action</th>
                </tr>
              </thead>

              <tbody>
                <?php $slno = 1;  ?>
                <tr>
                  @if($productlist->count()>0)
                  @foreach($productlist as $lists)
                  <td><?php echo $slno; ?></td>
                  <!-- <td>{{-- $lists->id --}}</td> -->
                  <td>{{ $lists->name }}</td>
                  <td>{{ $lists->value }}, -</td>
                  <td> ± {{ $lists->delivery_time }}</td>
                  <!--<td>{{-- $lists->slug --}}</td> -->
                  <td>{{ $lists->sample_product }}</td>
                  <!--<td>{{-- $lists->short_desc --}}</td>
                          <td>{{-- $lists->desc --}}</td> -->
                  <!--  <td>{{-- $lists->keywords --}}</td>-->
                  <td>
                    @if($lists->pro_image != '')
                    <a href="{{asset('storage/products/'.$lists->pro_image)}}" target="_blank">
                      <img src="{{asset('storage/products/'.$lists->pro_image)}}" width="30" height="30" />
                      <a>
                        @else
                        No image.
                        @endif
                  </td>


                  <!--<td>{{$lists->navbars_id}}</td>-->
                  <td>{{$lists->category_name}}</td>


                  <td>
                    @if($lists->pro_status ==1)
                    <a href="{{route('admin.productlist.status', ['status'=>0,'slug'=> $lists->slug])}}"><button type="button" class="btn btn-primary">Active</button></a>
                    @elseif($lists->pro_status==0)
                    <a href="{{route('admin.productlist.status', ['status'=>1,'slug'=> $lists->slug])}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                    @endif
                  </td>
                  <td>
                    @if($lists->is_popular == 'Yes')
                    <a href="{{route('admin.productlist.ispopular', ['ispopular'=>'No','slug'=> $lists->slug])}}"><button type="button" class="btn btn-primary">Yes</button></a>
                    @elseif($lists->is_popular== 'No')
                    <a href="{{route('admin.productlist.ispopular', ['ispopular'=>'Yes','slug'=> $lists->slug])}}"><button type="button" class="btn btn-warning">No</button></a>
                    @endif
                  </td>
                  <td>
                    @if($lists->show_on_homepage == 'Yes')
                    <a href="{{route('admin.productlist.showonhomepage', ['show'=>'No','slug'=> $lists->slug])}}"><button type="button" class="btn btn-primary">Yes</button></a>
                    @elseif($lists->show_on_homepage== 'No')
                    <a href="{{route('admin.productlist.showonhomepage', ['show'=>'Yes','slug'=> $lists->slug])}}"><button type="button" class="btn btn-warning">No</button></a>
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
                        <a class="dropdown-item" href="{{route('admin.productlist.show',$lists->slug )}}">Show</a>
                        <a class="dropdown-item" href="{{route('admin.productlist.edit',$lists->slug )}}">Edit</a>
                        <a class="dropdown-item" href="{{route('admin.productfeature.index',['product'=>$lists->slug] )}}">Product Feature</a>
                        <a class="dropdown-item" href="{{route('admin.productdocument.index',['product'=>$lists->slug])}}">Product Documents</a>
                        <a class="dropdown-item" href="{{route('admin.productimage.index',['product'=>$lists->slug])}}">Product Images</a>
                        <a class="dropdown-item" href="{{route('admin.productstep.index',['product'=>$lists->slug])}}">Product Steps</a>
                        <a class="dropdown-item" href="{{route('admin.productattribute.index',['product'=>$lists->slug])}}">Product Attributes</a>

                        <div class="dropdown-divider"></div>
                        <!--<a class="dropdown-item" href="{{route('admin.productlist.destroy', $lists->slug)}}">Delete</a>-->
                        <form action="{{route('admin.productlist.destroy', $lists->slug)}}" method="POST">
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
                  <!--<th>ID</th> -->
                  <th>Name</th>
                  <th>Vanaf</th>
                  <th>Levertijd </th>
                  <!--<th>Slug</th> -->
                  <th>Sample</th>
                  <!--<th>Short Desc</th>
                      <th>Desc</th>-->
                  <!--<th>Keywords</th> -->
                  <th class="not-export-col">pro_image</th>
                  <!--<th>navbars_id</th>-->
                  <th>Category Name</th>
                  <th>Status</th>
                  <th>Is Popular</th>
                  <th>Show Home Page</th>
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
      $(function() {
        $("#products_list").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          //"buttons": ["excel", "pdf", "print"]
          "buttons": [{
              //text: 'excel',
              extend: 'excelHtml5',
              exportOptions: {
                columns: ':visible:not(.not-export-col)'
              }
            },
            { //text: 'pdf',
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
        }).buttons().container().appendTo('#products_list_wrapper .col-md-6:eq(0)');

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