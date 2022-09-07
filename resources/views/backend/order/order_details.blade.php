@extends('backend/adminlayout')

@section('page_title', 'Order Details')
@section('order_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="order_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      
                      <th>Order Details ID</th>
                      <th>Orders ID</th>
                      <th>Product ID</th>
                      <th>Price</th>
                      <th>Qty</th>
                      
                      
                      
                      
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($order_detail)>0)
                        @foreach($order_detail as $lists)
                          <td><?php echo $slno; ?></td>
                          
                         
                          <td>{{ $lists->id}}</td>
                          <td>{{ $lists->orders_id}}</td>
                          <td>{{ $lists->product_lists_id }}</td>
                          <td>{{ $lists->price }}</td>
                          <td>{{ $lists->qty }}</td>
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach()
                      @else
                        <td colspan="8">No order detail found</td>
                    @endif
                  </tbody>

                  <tfoot>
                    <tr>
                    
                    <th style="width: 10px">#</th>
                    
                    
                    <th>Order Details ID</th>
                      <th>Orders ID</th>
                      <th>Product ID</th>
                      <th>Price</th>
                      <th>Qty</th>
                      
                    </tr>
                  </tfoot>


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

