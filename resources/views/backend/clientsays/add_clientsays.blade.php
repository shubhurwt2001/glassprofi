@extends('backend/adminlayout')

@section('page_title', 'Manage Client Says')
@section('clientsays_select', 'active')

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
                <h3 class="card-title">Add Client Says</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.clientsays.store')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input name="client_name" id="client_name" type="text" class="form-control" placeholder="client name">
                        </div>
                        @error('client_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Client Quote</label>
                            <!--<input name="route_name" id="route_name" type="text" class="form-control" placeholder="Route name">-->
                            <textarea class="form-control" name="client_quote" id="client_quote" rows="5" placeholder="Enter ..."></textarea>
                      </div>
                        @error('client_quote')
                                  <div class="alert alert-danger" role="alert">
                                      {{$message}} 
                                  </div>
                        @enderror
                    </div>
                </div>

              
                <div class="form-group">
                   <label for="exampleInputFile">Client Image</label>
                     <div class="input-group">
                       <div class="custom-file">
                         <input type="file" class="custom-file-input" name="client_image" id="client_image">
                         <label class="custom-file-label" for="client_image">Upload Image</label>
                        </div>
                      </div>
                </div>
                 @error('client_image')
                   <div class="alert alert-danger" role="alert">
                     {{$message}} 
                    </div>
                  @enderror
 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                </div>
               
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

@section('scripts')

<script type = "text/javascript">
   
    var simplemde = new SimpleMDE({element:$("#client_quote")[0]});
</script>
@endsection