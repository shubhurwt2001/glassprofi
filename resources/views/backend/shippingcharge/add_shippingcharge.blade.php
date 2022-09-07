@extends('backend/adminlayout')

@section('page_title', 'Shipping Charge')
@section('shipping_charge', 'active')
@section('add_shipping_charge', 'active')

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
                <h3 class="card-title">Add Shipping Charge</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.shippingcharge.store')}}" method="post" enctype="multipart/form-data">
                
                <!--<input type="hidden" name="_method" value="PUT"> -->
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="country_name">Select country</label>
                        <select id="country_name"  name="country_name" class="form-control">
                            <option value="0">Select country</option>
                            @foreach($country as $lists)
                              <option value="{{$lists->id}}">{{$lists->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                        @error('country_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input name="postal_code" id="postal_code" type="text" class="form-control" placeholder="Postal code">
                        </div>
                        @error('postal_code')
                            <div class="alert alert-danger" role="alert">
                                {{$message}} 
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="shipping_charge">Shipping Charge</label>
                            <input name="shipping_charge" id="shipping_charge" type="text" class="form-control" placeholder="Shipping charge">
                        </div>
                        @error('shipping_charge')
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