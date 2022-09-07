@extends('backend/adminlayout')

@section('page_title', 'Manage Product Attribute')
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
            <h3 class="card-title">Edit Product Attribute</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('admin.productattribute.update', $productattribute[0]->id)}}" method="post">

            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="attribute_name">Attribute Name</label>
                    <input name="attribute_name" id="attribute_name" type="text" class="form-control" placeholder="Product image name" value="{{$productattribute[0]->attribute_name}}">
                  </div>
                  @error('attribute_name')
                  <div class="alert alert-danger" role="alert">
                    {{$message}}
                  </div>
                  @enderror
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="step">Step</label>
                    <select name="step" class="form-control">
                      <option value="" disabled selected>Select Step</option>
                      @foreach($steps as $step)
                      <option value="{{$step->id}}" @if($step->id == $productattribute[0]->step) selected @endif>{{$step->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  @error('step')
                  <div class="alert alert-danger" role="alert">
                    {{$message}}
                  </div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="required">Required</label>
                    <select name="required" class="form-control">
                      <option value="0" @if($productattribute[0]->required == 0) selected @endif>No</option>
                      <option value="1" @if($productattribute[0]->required == 1) selected @endif>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="repeat">Repeat</label>
                    <select name="repeat" class="form-control">
                      <option value="0" @if($productattribute[0]->repeat == 0) selected @endif>No</option>
                      <option value="1" @if($productattribute[0]->repeat == 1) selected @endif>Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="repeat_button_text">Repeat Button Text</label>
                    <input type="text" name="repeat_button_text" value="{{$productattribute[0]->repeat_button_text}}" class="form-control">
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <input type="hidden" name="product_slug" value="{{$product_slug}}" />
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