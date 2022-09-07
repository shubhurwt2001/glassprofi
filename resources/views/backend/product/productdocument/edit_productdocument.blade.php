@extends('backend/adminlayout')

@section('page_title', 'Manage Product Document')
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
                <h3 class="card-title">Edit Product Document</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.productdocument.update', $product_document[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="product_document_name">Product Document Name</label>
                            <input name="product_document_name" id="product_document_name" type="text" class="form-control" placeholder="Product document name" value="{{$product_document[0]->document_title}}">
                        </div>
                        @error('product_document_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        @if($product_document[0]->document != '')
                            <a href="{{asset('storage/products/'.$product_document[0]->document)}}">{{ $product_document[0]->document }}</a>
                          @else
                            <p>No document uploaded</p>
                          @endif
                        <div class="form-group">
                                <label for="exampleInputFile">Product Document</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_document" id="product_document" value="name">
                                    <label class="custom-file-label" for="product_document">Change Document</label>
                                </div>
                                </div>
                            </div>
                            @error('product_document')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}} 
                                        </div>
                            @enderror
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