@extends('backend/adminlayout')

@section('page_title', 'Order')
@section('order_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="order_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      
                      <th>Order ID</th>
                      <th>Registered User</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <!--
                      <th>Company Name</th>
                      <th>Country</th>
                      <th>Address</th>
                      <th>Apartment</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Post Code</th>
                      <th>Order Notes</th>
                      <th>Coupen Code</th>
                      <th>Coupen Value</th>
                      <th>Order Status</th>
                      <th>Payment Type</th>
                      <th>Payment Status</th>
                      <th>Total Amount</th>
                      <th>Shipping Charge</th>
                      <th>Grand Total</th>
                      <th>Track Details</th>
                      <th>Transaction Number</th> -->

                      <th>Payment Id</th>

                      <!--<th>Paid Payer Id</th>
                      <th>Paid Payer Email</th> -->

                      <th>Paid Amount</th>

                      <!--<th>Paid Currency</th> -->
                      <th>Paid Payment Status</th>
                      
                      
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($user_orders)>0)
                        @foreach($user_orders as $lists)
                          <td><?php echo $slno; ?></td>
                          
                          <td><a href="{{ route('admin.order.details', ['order_id'=> base64_encode($lists->id)]) }}">{{ $lists->id }} </a></td>
                          <td><a href="javascript:void(0)">{{ $lists->users_id }} </a></td>
                          <td>{{ $lists->first_name}}</td>
                          <td>{{ $lists->last_name}}</td>
                          <td>{{ $lists->email }}</td>
                          <td>{{ $lists->phone }}</td>
                          <!--
                          <td>{{-- $lists->compeny_name --}}</td>
                          <td>{{-- $lists->country --}}</td>
                          <td>{{-- $lists->address --}}</td>
                          <td>{{-- $lists->apartment --}}</td>
                          <td>{{-- $lists->city --}}</td>
                          <td>{{-- $lists->state --}}</td>
                          <td>{{-- $lists->postcode --}}</td>
                          <td>{{-- $lists->order_notes --}}</td>
                          <td>{{-- $lists->coupon_code --}}</td>
                          <td>{{--  $lists->coupon_value --}}</td>
                          <td>{{-- $lists->order_status --}}</td>
                          <td>{{-- $lists->payment_type --}}</td>
                          <td>{{-- $lists->payment_status --}}</td>
                          <td>{{-- $lists->total_amount --}}</td>
                          <td>{{-- $lists->shipping_charge --}}</td>
                          <td>{{-- $lists->grand_total --}}</td>
                          <td>{{-- $lists->track_details --}}</td>
                          <td>{{-- $lists->txn_no --}}</td> -->

                          <td>{{ $lists->paid_payment_id }}</td>
                          <!--<td>{{-- $lists->paid_payer_id --}}</td>
                          <td>{{-- $lists->paid_payer_email --}}</td>-->
                          <td>{{ $lists->paid_amount}}</td>
                          <!--<td>{{-- $lists->paid_currency --}}</td>-->
                          <td>{{ $lists->paid_payment_status }}</td>
                         
                       
                       
                        
                    </tr>                    
                    <?php $slno++; ?>
                    @endforeach()
                      @else
                        <td colspan="8">No data found</td>
                    @endif
                  </tbody>

                  <tfoot>
                    <tr>
                    
                    <th style="width: 10px">#</th>
                    
                    
                    <th>Order ID</th>
                      <th>Registered User</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <!--
                      <th>Company Name</th>
                      <th>Country</th>
                      <th>Address</th>
                      <th>Apartment</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Post Code</th>
                      <th>Order Notes</th>
                      <th>Coupen Code</th>
                      <th>Coupen Value</th>
                      <th>Order Status</th>
                      <th>Payment Type</th>
                      <th>Payment Status</th>
                      <th>Total Amount</th>
                      <th>Shipping Charge</th>
                      <th>Grand Total</th>
                      <th>Track Details</th>
                      <th>Transaction Number</th> -->

                      <th>Payment Id</th>

                      <!--<th>Paid Payer Id</th>
                      <th>Paid Payer Email</th> -->

                      <th>Paid Amount</th>

                      <!--<th>Paid Currency</th> -->
                      <th>Paid Payment Status</th>
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

