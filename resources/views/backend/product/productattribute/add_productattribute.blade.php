@extends('backend/adminlayout')

@section('page_title', 'Manage Product Attributes')
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
            <h3 class="card-title">Add Product Attribute</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{route('admin.productattribute.store')}}" method="post" enctype="multipart/form-data">

            <!--<input type="hidden" name="_method" value="PUT"> -->
            @csrf
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="attribute_name">Attribute Name</label>
                    <input name="attribute_name" id="attribute_name" type="text" class="form-control" placeholder="Product attribute name">
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
                      <option value="{{$step->id}}">{{$step->name}}</option>
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
                      <option value="0" selected>No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="repeat">Repeat</label>
                    <select name="repeat" class="form-control">
                      <option value="0" selected>No</option>
                      <option value="1">Yes</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="repeat_button_text">Repeat Button Text</label>
                    <input type="text" name="repeat_button_text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <input type="hidden" name="product_id" value={{$productlist[0]->id}} />
            <input type="hidden" name="product_slug" value={{$productlist[0]->slug}} />
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