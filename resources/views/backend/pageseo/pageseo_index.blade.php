@extends('backend/adminlayout')

@section('page_title', 'Banner')
@section('seo_select', 'active')

@section('container')
@include('backend.messages.message')
 

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Seo Section</h3>
                <!--<a href="javascript:void(0)"><button type="button" class="btn btn-success btn-flat float-right">Add Banner</button></a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="clientsays_list" class="table table-bordered table-striped table-responsive">

                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <!--<th>Id</th> -->
                      <th>Page </th>
                      <th>Meta title</th>
                      <th>Meta tag</th>
                      <th>Meta description</th>
                      <th class="not-export-col">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $slno=1;  ?>
                    <tr>
                        @if(count($pageseo)>0)
                        @foreach($pageseo as $lists)
                          <td><?php echo $slno; ?></td>
                          <!--<td>{{ $lists->id }}</td> -->
                          <td>{{ $lists->page_name }}</td>
                          <td>{{ $lists->meta_title}}</td>
                          <td>{{ $lists->meta_keywords}}</td>
                          <td>{{ $lists->meta_description}}</td>
                          
                        <td>
                            <div class="btn-group">
                            <button type="button" class="btn btn-success btn-flat">Action</button>
                            <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{route('admin.seo.edit', $lists->id)}}">Edit</a>
                                <div class="dropdown-divider"></div>
                            </div>
                            </div>
                        </td>
                        
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
                      <!--<th>Id</th> -->
                      <th>Page </th>
                      <th>Meta title</th>
                      <th>Meta tag</th>
                      <th>Meta description</th>
                      <th class="not-export-col">Action</th>
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

