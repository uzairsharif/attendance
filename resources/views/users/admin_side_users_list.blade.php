@extends('attendance::layouts.adminlte')

@section('content')

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Delete Confirmation Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmployeeModalLabel">Edit User</h5>
        <button type="button" class="close closeEditModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editEmployeeForm">
          <div class="form-group">
            <label for="employeeName">Employee Name</label>
            <input type="text" class="form-control" id="employeeName" placeholder="User Name" readonly>
          </div>
          
          <div class="form-group">
            <label for="employeeEmail">Email</label>
            <input type="text" class="form-control" id="employeeEmail" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="employeeStatus">Status</label>
            <select class="form-control" id="employeeStatus">
              <option value="">Select Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="closeEditModal btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="editEmployeeForm">Save User</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit modal code end -->

<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
    				            <h3 class="card-title">Users</h3>
    				          </div>
    				          <!-- /.card-header -->
    				          <div class="card-body">
    				            <div id="usersTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                          <div class="row mb-2">
                            <div id="dataTableButtons" class="col-md-6"></div>
                          </div>

    				            <div class="row"><div class="col-sm-12">
    				            	
    				            	<table id="usersTable" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="usersTable_info">
    				              <thead>
    				              <tr>

                            <th class="sorting sorting_asc" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Employee ID</th>
                            

                            <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Employee Name</th>

                            <th class="sorting sorting_asc" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Department ID</th>

                            <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>

                            <th class="sorting" tabindex="0" aria-controls="usersTable" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>

                          </tr>
    				              </thead>
    				              <tbody>
                          @foreach($users as $user)
      				              <tr class="odd" id="user-row-{{ $user->id }}">
      				                <td class="sorting_1 dtr-control">{{ $user->id }}</td>
      				                <td>{{ $user->name }}</td>
      				                <td>dummy department</td>
                              <td id="status-cell-{{ $user->id }}">
                                  @if ($user->status !== 'active')
                                      <button id="updateStatusButton" onclick="updateUserStatus({{ $user->id }})" type="button" class="btn btn-primary btn_disabled">Activate</button>
                                  @else
                                      <span>Active</span>
                                  @endif
                              </td>



      				                <td>
      				                    <!-- <a href="#"
                                     class="btn btn-sm btn-primary edit-btn btn_disabled"
                                     title="Edit"
                                     data-toggle="modal"
                                     data-target="#editEmployeeModal"
                                     data-id="{{ $user->id }}"
                                     data-name="{{ $user->name }}"
                                     data-email="{{ $user->email }}"
                                     data-status="{{ $user->status }}">
                                     <i class="fas fa-edit"></i>
                                  </a> -->
                                  <a href="javascript:;"
                                     class="btn btn-sm btn-primary edit-btn btn_disabled"
                                     title="Edit"
                                     data-id="{{ $user->id }}"
                                     data-name="{{ $user->name }}"
                                     data-email="{{ $user->email }}"
                                     data-status="{{ $user->status }}"
                                     onclick="openEditModal()">
                                     <i class="fas fa-edit"></i>

                                  </a>

      				                    
      				                    <a href="#"
                                    
                                    data-toggle="modal" 
                                    data-target="#deleteConfirmationModal"
                                    class="btn btn-sm btn-danger btn_disabled" 
                                    title="Delete" 
                                    onclick="storeUserId({{ $user->id }})">
      				                        <i class="fas fa-trash-alt"></i>
      				                    </a>
      				                </td>
      				              </tr>
                          @endforeach
    				              </tbody>
    				              <tfoot>
    				              <tr>
                            
                            <th rowspan="1" colspan="1">Employee ID</th>
                            <th rowspan="1" colspan="1">Employee Name</th>
                            <th rowspan="1" colspan="1">Department ID</th>
                            <th rowspan="1" colspan="1">Status</th>
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
  var deleteUserId = null;
  var UserId = null;
  function storeUserId(user_Id) {
      deleteUserId = user_Id;     
  }
  function openEditModal(){
    // $('#editEmployeeModal').modal({
    //   focus: false,
    // });
    $('#editEmployeeModal').modal('show');

  }
  $('#editEmployeeModal').on('click', '.closeEditModal', function () {
    $('#editEmployeeModal').modal('hide');
  });

  function updateUserStatus(user_Id){
    UserId = user_Id;
    if (!UserId) return;

    const url = `{{ url('/update-user-status') }}/${UserId}`;
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

            const newStatus = data.new_status;
            const buttonCell = document.getElementById(`status-cell-${UserId}`);
            if (buttonCell) {
                buttonCell.innerHTML = `<span>Active</span>`;
            }
            // Update the edit button's data-status attribute
            const editButton = document.querySelector(`.edit-btn[data-id="${UserId}"]`);
            
            if (editButton) {
                editButton.setAttribute('data-status', newStatus);
            }

            Swal.mixin({
                toast: true,
                position: 'top-end', 
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'success',
                title: data.message
            });
        } else {
            
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: 'error',
                title: 'User Status not updated'
            });
        }
    })
    .catch(error => console.error('Error:', error));
  }

  $(function () {
    
    $('.edit-btn').removeClass('btn_disabled');
    $('.btn-danger').removeClass('btn_disabled');
    $('.btn_disabled').removeClass('btn_disabled');

    $(document).on('click', '.edit-btn', function () {

        const userId = $(this).attr('data-id');       
        const userName = $(this).attr('data-name');   
        const userEmail = $(this).attr('data-email'); 
        const userStatus = $(this).attr('data-status');

        // Populate modal fields
        $('#employeeName').val(userName);
        $('#employeeEmail').val(userEmail);
        $('#employeeStatus').val(userStatus);

        // this is to add user-id attribute in the form for saving data to the server.
        $('#editEmployeeForm').attr('user-id', userId);
    });

    $(document).on('submit', '#editEmployeeForm', function (e) {
        e.preventDefault(); // Prevent default form submission

        const userId = $(this).attr('user-id');
        const userEmail = $('#employeeEmail').val();
        const userStatus = $('#employeeStatus').val();

        $('.invalid-feedback').remove();

        $.ajax({
            url: `/update-user/${userId}`,
            type: 'PUT',
            data: {
                email: userEmail,
                status: userStatus,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {

                const updatedData = response.updatedData;
                const newStatus = updatedData.status;
                console.log(newStatus);

                // const newStatus = updatedD

                const buttonCell = document.getElementById(`status-cell-${userId}`);
                
                if (newStatus == 'active') {
                    buttonCell.innerHTML = `<span>Active</span>`;
                }
                else
                  buttonCell.innerHTML = `<button id="updateStatusButton" onclick="updateUserStatus(${userId})" type="button" class="btn btn-primary">Activate</button>`;
                // Update the edit button's data-status attribute
                const editButton = document.querySelector(`.edit-btn[data-id="${userId}"]`);
                
                if (editButton) {
                    editButton.setAttribute('data-status', newStatus);
                }
                Swal.mixin({
                  toast: true,
                  position: 'top-end', 
                  showConfirmButton: false,
                  timer: 3000
                }).fire({
                  icon: 'success',
                  title: response.message
                });
                $('#editEmployeeModal').modal('hide');
                
            },
            error: function (xhr) {
                if (xhr.status === 422) { 
                  const errors = xhr.responseJSON.errors;
                  Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  }).fire({
                    icon: 'error',
                    title: 'User not updated'
                  });
                  
                  if (errors.email) {
                      $('#employeeEmail').addClass('is-invalid');
                      $('#employeeEmail').after('<div class="invalid-feedback">' + errors.email[0] + '</div>');
                  }

                  if (errors.status) {
                      $('#employeeStatus').addClass('is-invalid');
                      $('#employeeStatus').after('<div class="invalid-feedback">' + errors.status[0] + '</div>');
                  }
              } else {
                  alert('An error occurred. Please try again.'); // Handle other errors
              }
            },
        });
    });

    let table = $('#usersTable').DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#usersTable_wrapper #dataTableButtons:eq(0)');

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
      if (!deleteUserId) return;

      const url = `{{ url('/delete-users') }}/${deleteUserId}`;
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
            
            // console.log($.fn.DataTable.isDataTable('#usersTable'));
              table = $('#usersTable').DataTable();
              let currentPage = table.page();

              table.row(`#user-row-${deleteUserId}`).remove().draw();
              table.page(currentPage).draw(false);

              Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
              }).fire({
                  icon: 'success',
                  title: data.message
              });
          } else {
              
              Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
              }).fire({
                  icon: 'error',
                  title: 'User was not deleted'
              });
          }
          
      })
      .catch(error => console.error('Error:', error));
    });
  });

</script>
@endpush