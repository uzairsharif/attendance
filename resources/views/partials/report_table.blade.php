<div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row d-flex align-items-center mb-3">
                  <!-- <div class="col-sm-3">
                    <button type="button" class="btn btn-block bg-primary">Generate Report</button>
                  </div> -->
                </div>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row"></div>

                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                      <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Check in</th>
                      <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Note</th> -->
                      
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">In Status</th>

                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Check Out</th>

                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Out Status</th>

                      <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th></tr> -->
                      </thead>
                      <tbody>
                      @forelse ($data as $item)
                      <tr class="odd">
                        <td>{{ $item->user_id }}</td>
                      
                        <td>{{ $item->user->name }}</td>
                        
                        <td>{{ $item->effective_check_in }}</td>
                        <td>{{ $item->effective_in_status }}</td>
                        <td>{{ $item->effective_check_out }}</td>
                        <td>{{ $item->effective_out_status }}</td>
                        
                        
                        <!-- <td>
                            <a href="{{-- route('edit_route', $id) --}}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="{{-- route('delete_route', $id) --}}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td> -->
                      </tr>
                      @empty
                        <tr>
                          <td colspan="8">No records found.</td>
                        </tr>
                     @endforelse
                  </tbody>
                      <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">ID</th>
                        
                        <th rowspan="1" colspan="1">Name</th>
                        <th rowspan="1" colspan="1">Check In </th>
                        <!-- <th rowspan="1" colspan="1">Note</th> -->
                        <th rowspan="1" colspan="1">In Status</th>
                        <th rowspan="1" colspan="1">Check Out</th>
                        <th rowspan="1" colspan="1">Out Status</th>
                        <!-- <th rowspan="1" colspan="1">Action</th> -->
                      </tr>
                      </tfoot>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
