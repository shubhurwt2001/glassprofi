@extends('backend/adminlayout')

@section('page_title', 'Contact us')
@section('contactus_select', 'active')

@section('container')
@include('backend.messages.message')


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contactus</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table class="table table-bordered table-striped table-responsive-sm">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th> Name </th>
                      <th> Number </th>
                       <th>Email</th>
                       <th>Message</th>
                       <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php $slno=1; //echo "<pre>"; print_r($news); die(); ?>
                  @if($contact_us->count()>0)
                  @foreach($contact_us as $list)
                   
                    <tr>
                    <td><?php echo $slno; ?></td>
                          
                           <td>{{ $list->first_name }} {{$list->last_name}}</td>
                           <td>{{ $list->phone_number }}</td>
                           <td>{{ $list->email }}</td>
                          
                           <td>
                                <div class="form-group">
                                    <textarea class="form-control" name="conatct_us" id="contact_us" rows="3" placeholder="Enter ..." disabled>{{ $list->your_question }}</textarea>
                                </div>
                           </td>

                           <td>
                               <a href="{{route('admin.contactus.message.delete', $list->id)}}"> <button type="submit" class="btn btn-primary">Delete</button></a>
                           </td>
                             

                               
                      
                    </tr>
                    
                    <?php $slno++; ?>
                   
                @endforeach
                @else
                    <td colspan="6">No data found</td>
                @endif
                    
                    
                  </tbody>

                  <thead>
                    <tr>
                    <th >#</th>
                      <th> Name </th>
                      <th> Number </th>
                       <th>Email</th>
                       <th>Message</th>
                       <th>Action</th>
                    </tr>
                  </thead>


                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $contact_us->links() }}
                  <!--<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> -->
                </ul>
              </div>
            </div>
            <!-- /.card -->

            </div>
          <!-- /.col -->

          </div>
        <!-- /.row -->




@endsection