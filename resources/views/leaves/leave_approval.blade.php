@extends('attendance::layouts.adminlte')

@section('content')
<!-- Approval Confirmation Modal -->
<div class="modal fade" id="approvalConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="approvalConfirmationModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approvalConfirmationModalLabel">Confirm Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="approvalComments">Comments (optional):</label>
                    <textarea class="form-control" id="approvalComments" rows="3" placeholder="Enter comments..."></textarea>
                </div>
                Are you sure you want to approve this leave?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="confirmApprovalButton">Approve</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Approval Confirmation Modal -->

<!-- Rejection Confirmation Modal -->
<div class="modal fade" id="rejectionConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="rejectionConfirmationModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionConfirmationModalLabel">Confirm Rejection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rejectionComments">Comments (optional):</label>
                    <textarea class="form-control" id="rejectionComments" rows="3" placeholder="Enter comments..."></textarea>
                </div>
                Are you sure you want to reject this leave?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="confirmRejectionButton">Reject</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Approval Confirmation Modal -->

<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leave Approval</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave-approval</li>
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
    				            <h3 class="card-title">Leave Approval</h3>
    				          </div>
    				          <!-- /.card-header -->
    				          <div class="card-body">
    				            <div id="leavesTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"></div>

    				            <div class="row"><div class="col-sm-12">
    				            	

    				            	<!-- Modal -->
    				            	<!-- <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
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
    				            	</div> -->
    				            	<!-- modal code end -->
    				            	<table id="leavesTable" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="leavesTable_info">
    				              <thead>
    				              <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">User ID</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">From</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">To</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Reason</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Status</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Leave Review Comments</th>

                            <th class="sorting" tabindex="0" aria-controls="leavesTable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                          </tr>
    				              </thead>
    				              <tbody>
                          @foreach($applied_leaves as $applied_leave)

      				              <tr class="odd" id="leave-row-{{ $applied_leave->id }}">
      				                <td class="dtr-control sorting_1" tabindex="0">{{ $applied_leave->user_id }}</td>
      				                <td>{{ $applied_leave->user->name}}
                                @if($applied_leave->user->deleted_at)
                                  <span class="badge badge-danger">Deleted</span>
                                @endif
                              </td>
                              <td>{{ $applied_leave->from }}</td>
                              <td>{{ $applied_leave->to }}</td>
                              <td>{{ $applied_leave->reason }}</td>
                              
                              <td data-column="status">
                                  @if($applied_leave->status === 'Pending')
                                      <span class="badge badge-warning">{{ $applied_leave->status }}</span>
                                  @elseif($applied_leave->status === 'Approved')
                                      <span class="badge badge-success">{{ $applied_leave->status }}</span>
                                  @elseif($applied_leave->status === 'Rejected')
                                      <span class="badge badge-danger">{{ $applied_leave->status }}</span>
                                  @endif
                              </td>
                              <td>{{ $applied_leave['leave_review_comment'] ?? '' }}</td>

                              <td data-column="action">
                                  @if($applied_leave->status === 'Pending' && !$applied_leave->user->deleted_at)
                                      <a href="{{ route('leaves.approve', $applied_leave->id) }}" 
                                        data-toggle="modal" 
                                        data-target="#approvalConfirmationModal"
                                        onclick="storeLeaveId({{ $applied_leave->id }})"
                                        class="btn btn-sm btn-success approve-btn btn_disabled" 
                                        title="Approve" >
                                          Approve
                                      </a>
                                      <a href="{{ route('leaves.reject', $applied_leave->id) }}" 
                                          data-toggle="modal" 
                                          data-target="#rejectionConfirmationModal"
                                          onclick="storeLeaveId({{ $applied_leave->id }})"
                                          class="btn btn-sm btn-danger reject-btn btn_disabled" title="Reject">
                                          Reject
                                      </a>
                                  @endif
                                  
                              </td>
      				              </tr>
                          @endforeach
    				          </tbody>
    				              <tfoot>
    				              <tr>
                            <th rowspan="1" colspan="1">User ID</th>
                            <th rowspan="1" colspan="1">Name</th>
                            <th rowspan="1" colspan="1">From</th>
                            <th rowspan="1" colspan="1">To</th>
                            <th rowspan="1" colspan="1">Reason</th>
                            <th rowspan="1" colspan="1">Status</th>
                            <th rowspan="1" colspan="1">Leave Review Comments</th>
                            <th rowspan="1" colspan="1">Action</th>
                          </tr>
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


@push('styles')
  <style>
  </style>
@endpush
@push('scripts')
	<script>
    var LeaveId = null;
    function storeLeaveId(leave_Id) {
        LeaveId = leave_Id;     
    }

    $(function () {
      $('.approve-btn').removeClass('btn_disabled');
      $('.reject-btn').removeClass('btn_disabled');

      var table = $('#leavesTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });
      
      function dynamicallyUpdateContent(data){
        const newStatus = data.updatedStatus;
        const row = table.row(`#leave-row-${LeaveId}`).node();
        const statusColumn = row.querySelector('[data-column="status"]');
        if(newStatus != 'Pending'){
          const actionColumn = row.querySelector('[data-column="action"]');
          actionColumn.innerHTML = ``;  
        }
        statusColumn.innerHTML = `
            <span class="badge badge-${newStatus === 'Pending' ? 'warning' :
                                     newStatus === 'Approved' ? 'success' :
                                     newStatus === 'Rejected' ? 'danger': ''}">${newStatus}</span>
        `;
        // table.row(`#leave-row-${LeaveId}`).invalidate().draw();

      }
      document.getElementById('confirmApprovalButton').addEventListener('click', function () {
        if (!LeaveId) return;

        const comments = document.getElementById('approvalComments').value; 
        const url = `{{ route('leaves.approve', ':id') }}`.replace(':id', LeaveId);
        // const url = `{{ url('/delete-users') }}/${deleteUserId}`;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                approval_comments: comments
            }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            dynamicallyUpdateContent(data);
    
            let currentPage = table.page();
            
            table.row(`#leave-row-${LeaveId}`).draw();
            table.page(currentPage).draw(false);

            // Show success toast
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'success',
                title: data.message
            });
          } 
          else {  
            Swal.mixin({
                toast: true,
                position: 'top-end', 
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'error',
                title: 'Leave was not approved'
            });
          }
            
        })
        .catch(error => console.error('Error:', error));
      });

      document.getElementById('confirmRejectionButton').addEventListener('click', function () {
        if (!LeaveId) return;
        const rejectionComments = document.getElementById('rejectionComments').value; 
        const url = `{{ route('leaves.reject', ':id') }}`.replace(':id', LeaveId);
        // const url = `{{ url('/delete-users') }}/${deleteUserId}`;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                rejection_comments: rejectionComments
            }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            dynamicallyUpdateContent(data);
          
            let currentPage = table.page();
            
            table.row(`#leave-row-${LeaveId}`).draw();
            table.page(currentPage).draw(false);

            // Show success toast
            Swal.mixin({
                toast: true,
                position: 'top-end',  // Changed position to bottom-right
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'success',
                title: data.message
            });
          } 
          else {  
            Swal.mixin({
                toast: true,
                position: 'top-end',  // Changed position to bottom-right
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'error',
                title: 'Leave was not rejected'
            });
          }
            
        })
        .catch(error => console.error('Error:', error));
      });

      // $("#leavesTable").DataTable({
      //   "responsive": true,
      //   "lengthChange": true, 
      //   "autoWidth": false,
      //   "paging": true,
      //   "pageLength": 10,
      //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      // }).buttons().container().appendTo('#leavesTable_wrapper .col-md-6:eq(0)');
      
    });
  </script>
@endpush