@extends('attendance::layouts.user')

@section('content')
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <div class="content-header">
	    <div class="container-fluid">
	      <div class="row mb-2">
	        <div class="col-sm-6">
	          <h1 class="m-0">Employee Attendance</h1>
	        </div><!-- /.col -->
	        <div class="col-sm-6">
	          <ol class="breadcrumb float-sm-right">
	            <li class="breadcrumb-item"><a href="#">Home</a></li>
	            <li class="breadcrumb-item active">attendance</li>
	          </ol>
	        </div><!-- /.col -->
	      </div><!-- /.row -->
	    </div><!-- /.container-fluid -->
	  </div>
	  <!-- /.content-header -->

	  <!-- Main content -->
	  <div class="content">
	  	<div class="container-fluid">
	  		<div class="row">
	  			<div class="col-sm-12">
	  				<form id="attendanceForm">
	  				    <!-- Employee Name -->
	  				    <div class="form-group">
	  				        <label for="employee_name">Employee Name</label>
	  				        <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ Auth::user()->name }}" readonly>
	  				    </div>

	  				    <!-- Image Upload -->
	  				    <div class="form-group">
	  				        <label for="employee_image">Upload Image</label>
	  				        <input type="file" class="form-control-file" id="employee_image" name="employee_image">
	  				    </div>

	  				    <!-- Check-in Button -->
	  				    <div class="form-group">
	  				        <button id="attendanceButton" type="button" class="btn btn-primary">Check In</button>
	  				    </div>
	  				</form>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	  <!-- /.content -->
	</div>
@endsection
@push('styles')
  <style>
  </style>
@endpush
@push('scripts')
	<script>
    $(function () {
      	$('.btn-primary').removeClass('btn_disabled');

      	document.getElementById('attendanceButton').addEventListener('click', function () {
          	const form = document.getElementById('attendanceForm');
          	const formData = new FormData(form);
          	const url = `{{ route('attendance.store') }}`;
          	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          	fetch(url, {
              	method: 'POST',
              	headers: {
                  	'X-CSRF-TOKEN': csrfToken,
              	},
              	body: formData, // Use FormData object as the request body
          	})
          	.then(response => response.json())
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
              } else {
                  	Swal.mixin({
                      	toast: true,
                      	position: 'top-end',
                      	showConfirmButton: false,
                      	timer: 3000
                  	}).fire({
                      	icon: 'error',
                    	title: 'Attendance not marked.'
                  	});
              	}
          	})
          	.catch(error => console.error('Error:', error));
      	});
    });
	</script>
@endpush
