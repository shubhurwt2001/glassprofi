@extends('backend/adminlayout')

@section('page_title', 'Add Product Attribute Dimension')
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
                        <h3 class="card-title">Add Product Attribute Dimension</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.productattribute.store.image.dimension')}}" method="post" enctype="multipart/form-data">

                        <!--<input type="hidden" name="_method" value="PUT"> -->
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dimension_name">Dimension Name</label>
                                        <input name="dimension_name" id="dimension_name" type="text" class="form-control" placeholder="Attribute image name">
                                    </div>
                                    @error('dimension_name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dimension_description">Dimension Description</label>
                                        <input name="dimension_description" id="dimension_description" type="text" class="form-control" placeholder="Dimension description ....">
                                    </div>
                                    @error('dimension_description')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dimension_start_point">Dimension Start from</label>
                                        <input name="dimension_start_point" id="dimension_start_point" type="text" class="form-control" placeholder="Dimension starting point .....">
                                    </div>
                                    @error('dimension_start_point')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dimension_end_point">Dimension End Point</label>
                                        <input name="dimension_end_point" id="dimension_end_point" type="text" class="form-control" placeholder="Dimension end .....">
                                    </div>
                                    @error('dimension_end_point')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="side">Dimension Side</label>
                                        <select name="side" class="form-control">
                                            @foreach($dropdown as $drop)
                                            <option value="{{$drop}}">{{$drop}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('side')
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
                        <input type="hidden" name="product_id" value={{$productlist[0]->id}} />
                        <input type="hidden" name="product_slug" value={{$productlist[0]->slug}} />
                        <input type="hidden" name="product_attribute_id" value="{{$productattribute[0]->id}}" />
                        <input type="hidden" name="product_attribute_image_id" value="{{$productattribute_image[0]->id}}" />

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