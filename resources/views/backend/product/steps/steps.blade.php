@extends('backend/adminlayout')

@section('page_title', 'Product Steps')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Steps</h3>
                        <a href="{{route('admin.productstep.create', ['product'=> $data->slug]  )}}"><button type="button" class="btn btn-success btn-flat float-right">Add Product Step</button></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-bordered table-striped table-responsive">

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <!-- <th>Status</th> -->
                                    <th>Added on</th>
                                    <th>Updated on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $slno = 1;  ?>
                                <tr>
                                    @if($data->steps->count() > 0)
                                    @foreach($data->steps as $step)
                                    <td><?php echo $slno; ?></td>
                                    <td>{{$step->id}}</td>
                                    <td>{{ $step->name }}</td>

                                   
                                    <td>{{ $step->created_at }}</td>
                                    <td>{{ $step->updated_at }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-flat">Action</button>
                                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <!--<a class="dropdown-item" href="#">Show</a> -->
                                                <a class="dropdown-item" href="{{route('admin.productstep.edit',[$step->id, 'product'=>$data->slug ] )}}">Edit</a>
                                                <div class="dropdown-divider"></div>

                                                <form action="{{route('admin.productstep.destroy', $step->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <!--<a class="dropdown-item" href="javascript:void(0)">Delete</a>-->
                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                    <input type="hidden" name="product_slug" value="{{$data->slug}}" />
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <?php $slno++; ?>
                                @endforeach
                                @else
                                <td colspan="8">No Attribute added yet</td>
                                @endif
                            </tbody>

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    
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