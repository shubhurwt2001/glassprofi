@extends('backend/adminlayout')

@section('page_title', 'Product Features')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Feature</h3>
                <a href="{{route('admin.productfeature.create', ['product'=>$productlist[0]->slug]  )}}"><button type="button" class="btn btn-success btn-flat float-right">Add Product feature</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Title</th>
                      <th>Product Feature</th>
                      <th>Product Name </th>
                      <th>Showing Serial Number </th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($productfeature->count()>0)
                        @foreach($productfeature as $lists)
                          <td><?php echo $slno; ?></td>
                          <!-- <td>{{-- $lists->id --}}</td>--> 
                          <td>{{ $lists->feature_title }}</td>
                          <td>{{ $lists->feature }}</td>
                          <!--<td>{{-- $lists->product_lists_id --}}</td>-->
                          <td>{{ $productlist[0]->name }}</td>
                          <td>{{ $lists->pro_feature_serial_no }}</td>
                          
                        <td>
                             @if($lists->feature_status ==1)
                                <a href="{{ route('admin.productfeature.status', ['product'=>$productlist[0]->slug, 'status'=>0,'id'=> $lists->id]) }}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->feature_status==0)
                                <a href="{{ route('admin.productfeature.status', ['product'=>$productlist[0]->slug, 'status'=>1,'id'=> $lists->id]) }}"><button type="button" class="btn btn-warning">Deactive</button></a>
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
                                <a class="dropdown-item" href="{{route('admin.productfeature.edit',[$lists->id, 'product'=>$productlist[0]->slug ] )}}">Edit</a>
                                
                                <div class="dropdown-divider"></div>
                                
                                <form action="{{route('admin.productfeature.destroy', $lists->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <!--<a class="dropdown-item" href="javascript:void(0)">Delete</a>-->
                                    <button class="dropdown-item" type="submit">Delete</button>
                                    <input type="hidden" name="product_slug" value="{{$productlist[0]->slug}}" /> 
                                </form>
                            </div>
                            </div>
                        </td>
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach
                      @else
                        <td colspan="8">No feature added yet</td>
                    @endif
                  </tbody>

                  <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                      <!--<th>ID</th> -->
                      <th>Title</th>
                      <th>Product Feature</th>
                      <th> Product Name </th>
                      <th>Showing Serial Number </th>
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