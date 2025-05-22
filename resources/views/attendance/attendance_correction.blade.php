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
                Are you sure you want to approve this attendance correction?
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
                Are you sure you want to reject this attendance correction?
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
            <h1>Attendance Correction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Attendance Correction</li>
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
			          <h3 class="card-title">Attendance Correction</h3>
			        </div>
			          
			        <div class="card-body">
                  
			          <div id="attendanceTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row"></div>

			            <div class="row">
                    <div class="col-sm-12">
			            	<!-- Add New Employee Button -->

			            	
				            	<table id="attendanceTable" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
  				              <thead>
    				              <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Name</th>
                           
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Check in</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">In Status</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Requested Check in</th>
    				               
                          

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Check Out</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Out Status</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Requested Check Out</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Reason</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th>


                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
                          </tr>
  				              </thead>
  				              <tbody>
                        @foreach($attendance_corrections as $attendance_correction)
    				              <tr class="odd" id="attendance_correction-row-{{ $attendance_correction->id }}">
    				                <td class="dtr-control sorting_1" tabindex="0">{{ $attendance_correction->attendance->user->id }}</td>
    				                <td>{{ $attendance_correction->attendance->user->name }}</td>
    				              
    				                
    				                <td data-column="checkIn">{{ $attendance_correction->attendance->check_in }}</td>
    				                <td data-column="inStatus">{{ $attendance_correction->attendance->in_status }}</td>
                            <td data-column="requestedCheckIn">{{ $attendance_correction->requested_check_in }}</td>
                            <td data-column="checkOut">{{ $attendance_correction->attendance->check_out }}</td>
                            <td data-column="outStatus">{{ $attendance_correction->attendance->out_status }}</td>
                            <td data-column="requestedCheckOut">{{ $attendance_correction->requested_check_out }}</td>
                            <td data-column="reason">{{ $attendance_correction->reason }}</td>
                            <td data-column="status">
                                @if($attendance_correction->status === 'Pending')
                                    <span class="badge badge-warning">{{ $attendance_correction->status }}</span>
                                @elseif($attendance_correction->status === 'Approved')
                                    <span class="badge badge-success">{{ $attendance_correction->status }}</span>
                                @elseif($attendance_correction->status === 'Rejected')
                                    <span class="badge badge-danger">{{ $attendance_correction->status }}</span>
                                @endif
                            </td>
    				                <td data-column="action">
                                @if($attendance_correction->status === 'Pending' && !$attendance_correction->attendance->user->deleted_at)
                                    <a href="{{ route('attendance_correction.approve', $attendance_correction->id) }}" 
                                      data-toggle="modal" 
                                      data-target="#approvalConfirmationModal"
                                      onclick="storeAttendanceCorrectionId({{ $attendance_correction->id }})"
                                      class="btn btn-sm btn-success approve-btn btn_disabled" 
                                      title="Approve" >
                                        Approve
                                    </a>
                                    <a href="{{ route('attendance_correction.reject', $attendance_correction->id) }}" 
                                        data-toggle="modal" 
                                        data-target="#rejectionConfirmationModal"
                                        onclick="storeAttendanceCorrectionId({{ $attendance_correction->id }})"
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
                            <th rowspan="1" colspan="1">ID</th>
                            <th rowspan="1" colspan="1">Name</th>
                            
                            
                            
                            <th rowspan="1" colspan="1">Check In </th>
                            <th rowspan="1" colspan="1">In Status</th>
                            <th rowspan="1" colspan="1">Requested Check In</th>
                            <th rowspan="1" colspan="1">Check Out</th>
                            <th rowspan="1" colspan="1">Out Status</th>
                            <th rowspan="1" colspan="1">Requested Check Out</th>
                            <th rowspan="1" colspan="1">Reason</th>
                            <th rowspan="1" colspan="1">Status</th>
                            <th rowspan="1" colspan="1">Action</th>
                          </tr>
  				              </tfoot>
				              </table>
                    </div>
                  </div>
                </div>
			        </div>
			          <!-- /.card-body -->
			      </div>
			    </div>
  			</div>
  		</div>		
    </section>
	
@endsection

@push('scripts')
<script>
  var attendanceCorrectionId = null;
    function storeAttendanceCorrectionId(attendance_correction_Id) {
        attendanceCorrectionId = attendance_correction_Id;
    }

    // function openDeleteModal(attendance_id){
    //   $('#deleteModal').modal('show');
    //   storeAttendanceId(attendance_id);
    // }

    // $('#deleteModal').on('click', '.closedeleteModal', function () {
    //   $('#deleteModal').modal('hide');
    // });
  $(function () {

    $('.approve-btn').removeClass('btn_disabled');
    $('.reject-btn').removeClass('btn_disabled');

    $('#checkIn').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down'
        },
    });

    $('#checkOut').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down'
        },
    });

    var table = $('#attendanceTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      });

    function dynamicallyUpdateContent(data){
      const newStatus = data.updatedStatus;
      const row = table.row(`#attendance_correction-row-${attendanceCorrectionId}`).node();
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
    }
    
    
    document.getElementById('confirmApprovalButton').addEventListener('click', function () {
      if (!attendanceCorrectionId) return;

      const url = `{{ route('attendance_correction.approve', ':id') }}`.replace(':id', attendanceCorrectionId);
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      fetch(url, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Content-Type': 'application/json',
          },
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          dynamicallyUpdateContent(data);
    
          let currentPage = table.page();
          
          table.row(`#attendace_correction-row-${attendanceCorrectionId}`).draw();
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
              title: 'Attendance correction was not approved'
          });
        }
          
      })
      .catch(error => console.error('Error:', error));
    });

    document.getElementById('confirmRejectionButton').addEventListener('click', function () {
      if (!attendanceCorrectionId) return;

      const url = `{{ route('attendance_correction.reject', ':id') }}`.replace(':id', attendanceCorrectionId);
      // const url = `{{ url('/delete-users') }}/${deleteUserId}`;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      fetch(url, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Content-Type': 'application/json',
          },
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          dynamicallyUpdateContent(data);
        
          let currentPage = table.page();
          
          table.row(`#attendance_correction-row-${attendanceCorrectionId}`).draw();
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
              title: 'Attendance Correction was not rejected'
          });
        }
          
      })
      .catch(error => console.error('Error:', error));
    });

    
  });
</script>
@endpush