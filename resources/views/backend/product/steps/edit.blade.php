@extends('backend/adminlayout')

@section('page_title', 'Edit Product Step')
@section('products_select', 'active')

@section('container')
@include('backend.messages.message')


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product Step</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.productstep.update', $data->id)}}" method="post">

                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name"> Name</label>
                                        <input name="name" id="name" type="text" class="form-control" value="{{$data->name}}" placeholder="Product step name">
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>

                        <input type="hidden" name="product_slug" value="{{$data->product_slug}}" />
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->




@endsection