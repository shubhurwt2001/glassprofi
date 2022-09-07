@extends('backend/adminlayout')

@section('page_title', 'Manage Country')
@section('shipping_charge', 'active')
@section('country', 'active')

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
                <h3 class="card-title">Add Country</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.country.store')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="country_name">Country Name</label>
                            <input name="country_name" id="country_name" type="text" class="form-control" placeholder="Country name">
                        </div>
                        @error('country_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="country_slug">Country Name</label>
                            <input name="country_slug" id="country_slug" type="text" class="form-control" placeholder="Country slug">
                        </div>
                        @error('country_slug')
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