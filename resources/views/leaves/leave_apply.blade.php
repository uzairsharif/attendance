@extends('attendance::layouts.user')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leave Apply</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave Apply</li>
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
	            <h3 class="card-title">Leave Apply</h3>
	          </div>
	          <!-- /.card-header -->
	          <div class="card-body">
	            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
  	            <form id="leave-apply-form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Leave Type</label>
                        <select class="form-control leave_type" name="leaveType" style="width: 100%;">
                          <option selected="selected">Casual Leave</option>
                          <option>Medical Leave</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>From</label>
                          <div class="input-group date" id="FromDate" data-target-input="nearest">
                              <input type="text" name="FromDate" class="form-control datetimepicker-input" data-target="#FromDate">
                              <div class="input-group-append" data-target="#FromDate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To</label>
                          <div class="input-group date" id="ToDate" data-target-input="nearest">
                              <input type="text" name="ToDate" class="form-control datetimepicker-input" data-target="#ToDate">
                              <div class="input-group-append" data-target="#ToDate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>No. of Days</label>
                        <input id="numOfDays" name="numOfDays" type="text" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Reason</label>
                        <input name="reason" id="reason" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <button id="leave-apply-btn" type="button" class="btn btn-primary">Submit</button>
                    </div>
                  
                  </div>
                </form>
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
      $(function () {
        //Initialize Select2 Elements
        $('.leave_type').select2()

        // document.getElementById('leave-apply-btn').addEventListener('click', function () {
        //     const form = document.getElementById('leave-apply-form');
        //     const formData = new FormData(form);
        //     const url = `{{ route('leave.store') }}`;
        //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //     fetch(url, {
        //         method: 'POST',
        //         headers: {
        //             'Accept': 'application/json',
        //             'X-CSRF-TOKEN': csrfToken,
        //         },
        //         body: formData,
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.success) {
        //           console.log(data);
        //             Swal.mixin({
        //                 toast: true,
        //                 position: 'top-end',
        //                 showConfirmButton: false,
        //                 timer: 3000
        //             }).fire({
        //                 icon: 'success',
        //                 title: data.message
        //             });
        //       } else {
        //             Swal.mixin({
        //                 toast: true,
        //                 position: 'top-end',
        //                 showConfirmButton: false,
        //                 timer: 3000
        //             }).fire({
        //                 icon: 'error',
        //               title: 'Attendance not marked.'
        //             });
        //         }
        //     })
        //     .catch(error => console.error('Error:', error));
        // });
        document.getElementById('leave-apply-btn').addEventListener('click', function () {
            const form = document.getElementById('leave-apply-form');
            const formData = new FormData(form);
            const url = `{{ route('leave.store') }}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Clear previous error messages
            form.querySelectorAll('.text-danger').forEach(el => el.remove());
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.json().then(errorData => {
                        throw errorData;
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).fire({
                        icon: 'success',
                        title: data.message
                    });
                    form.reset(); // Optionally reset the form
                } else {
                    Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).fire({
                        icon: 'error',
                        title: 'Leave not applied!'
                    });
                }
            })
            .catch(error => {
              console.log(error)
                if (error.errors) {
                    Object.keys(error.errors).forEach(field => {
                        const input = form.querySelector(`[id="${field}"]`);
                        if (input) {
                            if (input.tagName === 'DIV') {
                                const childInput = input.querySelector('input');
                                if (childInput) {
                                   childInput.classList.add('is-invalid');
                                }
                            } else {
                               input.classList.add('is-invalid');
                            }    
                            const errorMessage = document.createElement('span');
                            errorMessage.classList.add('text-danger');
                            errorMessage.textContent = error.errors[field][0];
                            input.parentElement.appendChild(errorMessage);
                        }
                    });
                } else {
                    console.error('Error:', error);
                }
            });
        });
  
      });
      $('#FromDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
      });
      $('#ToDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
      });

      // Update ToDate minimum date based on FromDate selection
    $("#FromDate").on("change.datetimepicker", function (e) {
        $('#ToDate').datetimepicker('minDate', e.date);
        calculateDays();
    });

    // Update FromDate maximum date based on ToDate selection
    $("#ToDate").on("change.datetimepicker", function (e) {
        $('#FromDate').datetimepicker('maxDate', e.date);
        calculateDays();
    });

    function calculateDays() {
      let startDate = $('#FromDate').datetimepicker('date');
      let endDate = $('#ToDate').datetimepicker('date');
      if (startDate && endDate) {
          let diffInDays = endDate.diff(startDate, 'days') + 1;
          $('#numOfDays').val(diffInDays);
      } else {
          $('#numOfDays').val('');
      }
    }


    </script>
@endpush

