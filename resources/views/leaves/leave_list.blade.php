@extends('attendance::layouts.user')

@section('content')
<div class="content-wrapper">
	  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leave List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave-list</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="row-12">
    					<div class="card">
    				          <div class="card-header">
    				            <h3 class="card-title">Leave List</h3>
    				          </div>
    				          <!-- /.card-header -->
    				          <div class="card-body">
    				            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"></div>

    				            <div class="row"><div class="col-sm-12">
    				            	
    				            	
    				            	<!-- modal code end -->
    				            	<table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
    				              <thead>
    				              <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">From</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">To</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Number of Days</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Type</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Reason</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Status</th>

                            
                          </tr>
    				              </thead>
    				              <tbody>
                          @foreach($leaves as $leave)
      				              <tr class="odd">
      				                <td class="dtr-control sorting_1" tabindex="0">{{ $leave['id'] }}</td>
      				                <td>{{ $leave['from'] }}</td>
                              <td>{{ $leave['to'] }}</td>
                              <td>{{ $leave['number_of_days'] }}</td>
                              <td>{{ $leave['type'] }}</td>
                              <td>{{ $leave['reason'] }}</td>
                              <td>
                                  @if($leave['status'] === 'Approved')
                                      <span class="badge badge-success">Approved</span>
                                  @elseif($leave['status'] === 'Pending')
                                      <span class="badge badge-warning">Pending</span>
                                  @elseif($leave['status'] === 'Rejected')
                                      <span class="badge badge-danger">Rejected</span>
                                  @else
                                      <span class="badge badge-secondary">Unknown</span>
                                  @endif
                              </td>
      				              </tr>
                          @endforeach
    				              </tbody>
    				              <tfoot>
      				              <tr>
                              <th rowspan="1" colspan="1">ID</th>
                              <th rowspan="1" colspan="1">From</th>
                              <th rowspan="1" colspan="1">To</th>
                              <th rowspan="1" colspan="1">Number of Days</th>
                              <th rowspan="1" colspan="1">Type</th>
                              <th rowspan="1" colspan="1">Reason</th>
                              <th rowspan="1" colspan="1">Status</th>
                            </tr>
    				              </tfoot>
    				            </table>
                      </div>
                    </div>
                  </div>
    				    </div>
    				  </div>
    				</div>
    			</div>
    		</div>
    	</div>
    			
    </section>
	
@endsection

@push('scripts')
	<script>
      // $(function () {
      //   $("#example1").DataTable({
      //     "responsive": true, "lengthChange": false, "autoWidth": false,
      //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
      // });
    </script>
@endpush