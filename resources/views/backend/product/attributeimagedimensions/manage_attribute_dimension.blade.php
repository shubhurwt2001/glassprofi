@extends('backend/adminlayout')

@section('page_title', 'Manage Product Attribute Dimension')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Product Attribute Dimension</h3>
                 <!-- <a href="#"><button type="button" class="btn btn-success btn-flat float-right">Add Product Attribute</button></a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Side</th>
                      <th>Dimension Name</th>
                      <th>Description</th>
                      <th>Start Point </th>
                      <th>End Point </th>
                      <th>Attribute Image </th>
                      <th>Status</th>
                      <th>Added on</th>
                      <th>Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if($productattribute_dimension->count()>0)
                        @foreach($productattribute_dimension as $lists)
                          <td><?php echo $slno; ?></td>
                          <td>{{$lists->side}}</td>
                          <td>{{ $lists->dim_name }}</td>
                          <td>{{$lists->dim_description}}</td>
                          <td>{{ $lists->dim_start }}</td>
                          <td>{{ $lists->dim_end }}</td>
                          
                          <!--<td>{{ $lists->attr_id }}</td> -->
                          <td>
                          @if($productattribute_image[0]->attr_image != '')
                          <a href="{{asset('storage/products/'.$productattribute_image[0]->attr_image)}}"><img src="{{asset('storage/products/'.$productattribute_image[0]->attr_image)}}" width="50" height="50" /></a>
                          @else
                            <p>No Image added</p>
                          @endif
                          </td>
                          
                        <td>
                             @if($lists->attr_dim_status ==1)
                                <a href="{{ route('admin.productattribute.dimension.status', ['product'=>base64_encode($productlist[0]->slug), 'status'=>base64_encode(0),'attr_dimension_id'=> base64_encode($lists->id), 'attr_id'=>base64_encode($productattribute[0]->id), 'attr_image_id'=>base64_encode($productattribute_image[0]->id)]) }}"><button type="button" class="btn btn-primary">Active</button></a>
                                @elseif($lists->attr_dim_status==0)
                                <a href="{{ route('admin.productattribute.dimension.status', ['product'=>base64_encode($productlist[0]->slug), 'status'=>base64_encode(1),'attr_dimension_id'=> base64_encode($lists->id), 'attr_id'=>base64_encode($productattribute[0]->id), 'attr_image_id'=>base64_encode($productattribute_image[0]->id)]) }}"><button type="button" class="btn btn-warning">Deactive</button></a>
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
                                <a class="dropdown-item" href="{{route('admin.productattribute.edit.dimension',['attr_dimension_id'=>base64_encode($lists->id),'attr_image_id'=>base64_encode($productattribute_image[0]->id), 'product'=>$productlist[0]->slug, 'attr_id'=>base64_encode($productattribute[0]->id) ] )}}">Edit</a>
                                <div class="dropdown-divider"></div>
                                
                                <form action="{{route('admin.productattribute.destroy.dimension', base64_encode($lists->id))}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <!--<a class="dropdown-item" href="javascript:void(0)">Delete</a>-->
                                    <button class="dropdown-item" type="submit">Delete</button>
                                    <input type="hidden" name="product_slug" value="{{$productlist[0]->slug}}" /> 
                                    <input type="hidden" name="product_attribute_id" value="{{$productattribute[0]->id}}" />
                                    <input type="hidden" name="product_attribute_image_id" value="{{$productattribute_image[0]->id}}" />
                                </form>
                            </div>
                            </div>
                        </td>
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach
                      @else
                        <td colspan="8">No Attribute Image added yet</td>
                    @endif
                  </tbody>

                  <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                      <th>ID</th>
                      <th>Dimension Name</th>
                      <th>Description</th>
                      <th>Start Point </th>
                      <th>End Point </th>
                      <th>Attribute Image </th>
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