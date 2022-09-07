@extends('backend/adminlayout')

@section('page_title', 'Manage Shipping Charge')
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
                <h3 class="card-title">Edit Shipping Charge</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.shippingcharge.update', $shippingcharge[0]->id)}}" method="post">
                
                <input type="hidden" name="_method" value="PUT"> 
                  @csrf
                <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="country_name">Select country</label>
                        <select id="country_name"  name="country_name" class="form-control">
                            <option value="0">Select country</option>
                            @if(count($country)>0)
                            @foreach($country as $lists)
                              @if($shippingcharge[0]->countries_id == $lists->id)
                              <option value="{{$lists->id}}" selected>{{$lists->country_name}}</option>
                              @else
                                <option value="{{$lists->id}}">{{$lists->country_name}}</option>
                              @endif
                              
                            @endforeach
                            @else
                            <option>Please add country first</option>
                            @endif
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
                            <input name="postal_code" id="postal_code" type="text" class="form-control" placeholder="Postal code" value="{{$shippingcharge[0]->postal_code}}">
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
                            <input name="shipping_charge" id="shipping_charge" type="text" class="form-control" placeholder="Shipping charge" value="{{$shippingcharge[0]->shipping_charge}}">
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
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
                
                <input type="hidden" name="id" value="{{base64_encode($shippingcharge[0]->id)}}" />
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