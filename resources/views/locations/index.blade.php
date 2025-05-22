@extends('attendance::layouts.adminlte')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Locations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Locations</li>
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
    				            <h3 class="card-title">Locations</h3>
    				          </div>
    				          <!-- /.card-header -->
    				          <div class="card-body">
    				            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"></div>

    				            <div class="row"><div class="col-sm-12">
    				            	<!-- Add New Employee Button -->
    				            	<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addEmployeeModal">
    				            	  Add New Location
    				            	</button>

    				            	<!-- Modal -->
    				            	<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    				            	  <div class="modal-dialog">
    				            	    <div class="modal-content">
    				            	      <div class="modal-header">
    				            	        <h5 class="modal-title" id="addEmployeeModalLabel">Add New Location</h5>
    				            	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				            	          <span aria-hidden="true">&times;</span>
    				            	        </button>
    				            	      </div>
    				            	      <div class="modal-body">
    				            	        <form id="addLocationForm">
    				            	          <div class="form-group">
    				            	            <label for="locationId">Location Name</label>
    				            	            <input type="text" class="form-control" id="locationId" placeholder="Location Name" required>
    				            	          </div>
    				            	          
    				            	        </form>
    				            	      </div>
    				            	      <div class="modal-footer">
    				            	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    				            	        <button type="submit" class="btn btn-primary" form="addShiftForm">Save Location</button>
    				            	      </div>
    				            	    </div>
    				            	  </div>
    				            	</div>
    				            	<!-- modal code end -->
    				            	<table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
    				              <thead>
    				              <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Location Name</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                          </tr>
    				              </thead>
    				              <tbody>
    				              <tr class="odd">
    				                <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
    				                <td>Firefox 1.0</td>
    				                
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>

    				              </tr><tr class="even">
    				                <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
    				                <td>Firefox 1.5</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="odd">
    				                <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
    				                <td>Firefox 2.0</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="even">
    				                <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
    				                <td>Firefox 3.0</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="odd">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Camino 1.0</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="even">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Camino 1.5</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="odd">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Netscape 7.2</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="even">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Netscape Browser 8</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="odd">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Netscape Navigator 9</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="even">
    				                <td class="sorting_1 dtr-control">Gecko</td>
    				                <td>Umair</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr><tr class="odd">
    				                <td class="sorting_1 dtr-control">uzair</td>
    				                <td>Mozilla 1.0</td>
    				                
    				                <td>
    				                    <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
    				                        <i class="fas fa-edit"></i>
    				                    </a>
    				                    
    				                    <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
    				                        <i class="fas fa-trash-alt"></i>
    				                    </a>
    				                </td>
    				              </tr>
    				          </tbody>
    				              <tfoot>
    				              <tr>
                            <th rowspan="1" colspan="1">ID</th>
                            <th rowspan="1" colspan="1">Location Name</th>
                            
                            <th rowspan="1" colspan="1">Action</th></tr>
    				              </tfoot>
    				            </table></div></div></div>
    				          </div>
    				          <!-- /.card-body -->
    				        </div>
    				    </div>
    			</div>
    		</div>
    	</div>
    			
    </section>
	
@endsection

@push('scripts')
	<script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
@endpush