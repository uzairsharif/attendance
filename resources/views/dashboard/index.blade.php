@extends('attendance::layouts.adminlte')

@section('content')
	<!-- More Info Modal for Users -->
	<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="usersModalLabel">All Users</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <table class="table table-bordered">
	          <thead>
	            <tr>
	              <th>Name</th>
	              <th>Email</th>
	              <th>Role</th>
	            </tr>
	          </thead>
	          <tbody>
	            @foreach($data['users'] as $user)
	              <tr>
	                <td>{{ $user->name }}</td>
	                <td>{{ $user->email }}</td>
	                <td>{{ $user->role }}</td>
	              </tr>
	            @endforeach
	          </tbody>
	        </table>
	        <p>Total Users: {{ $data['totalUsers'] }} users</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="lateTodayModal" tabindex="-1" role="dialog" aria-labelledby="lateTodayModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="lateTodayModalLabel">Late Employees Today</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <table class="table table-bordered">
	          <thead>
	            <tr>
	              <th>Name</th>
	              <th>Check-In Time</th>
	            </tr>
	          </thead>
	          <tbody>
	            @foreach($data['lateToday'] as $attendance)
	              <tr>
	                <td>{{ $attendance->user->name }}</td>
	                <td>{{ $attendance->check_in }}</td>
	              </tr>
	            @endforeach
	          </tbody>
	        </table>
	        <p>Total Late: {{ $data['totalLateToday'] }} employees</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="onTimeModal" tabindex="-1" role="dialog" aria-labelledby="onTimeModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="onTimeModalLabel">On Time Employees Today</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <table class="table table-bordered">
	          <thead>
	            <tr>
	              <th>Name</th>
	              <th>Check-In Time</th>
	            </tr>
	          </thead>
	          <tbody>
	            @foreach($data['onTimeToday'] as $attendance)
	              <tr>
	                <td>{{ $attendance->user->name }}</td>
	                <td>{{ $attendance->check_in }}</td>
	              </tr>
	            @endforeach
	          </tbody>
	        </table>
	        <p>Total On Time: {{ $data['totalOnTimeToday'] }} employees</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <div class="content-header">
	    <div class="container-fluid">
	      <div class="row mb-2">
	        <div class="col-sm-6">
	          <h1 class="m-0">Dashboard</h1>
	        </div><!-- /.col -->
	        <div class="col-sm-6">
	          <ol class="breadcrumb float-sm-right">
	            <li class="breadcrumb-item"><a href="#">Home</a></li>
	            <li class="breadcrumb-item active">Dashboard</li>
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
	          <div class="col-lg-3 col-6">
	              <div class="small-box bg-info">
	                  <div class="inner">
	                      <h3>{{ $data['totalUsers'] }}</h3>

	                      <p>Total Employees</p>
	                  </div>
	                  <div class="icon">
	                      <i class="fas fa-user-tie"></i>
	                  </div>
	                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#usersModal">
	                      More info <i class="fas fa-arrow-circle-right"></i>
	                  </a>
	              </div>
	          </div>
	          <div class="col-lg-3 col-6">
	              <div class="small-box bg-success">
	                  <div class="inner">
	                      <h3>{{ $data['totalOnTimeToday'] }}</h3>

	                      <p>On Time Today</p>
	                  </div>
	                  <div class="icon">
	                      <i class="fas fa-tachometer-alt"></i>
	                  </div>
	                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#onTimeModal">
	                      More info <i class="fas fa-arrow-circle-right"></i>
	                  </a>
	              </div>
	          </div>
	          <div class="col-lg-3 col-6">
	              <div class="small-box bg-danger">
	                  <div class="inner">
	                      <h3>{{ $data['totalLateToday'] }}</h3>

	                      <p>Late Today</p>
	                  </div>
	                  <div class="icon">
	                      <i class="fas fas fa-user-clock"></i>
	                  </div>
	                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#lateTodayModal">
	                      More info <i class="fas fa-arrow-circle-right"></i>
	                  </a>
	              </div>
	          </div>
	          <div class="col-lg-3 col-6">
	              	<div class="small-box bg-warning">
	                  	<div class="inner">
	                      	<h3>{{ $data['onTimePercentage'] }}%</h3>
	                      	<p>On Time Percentage</p>
	                  	</div>
	                  	<div class="icon">
	                      	<i class="fas fa-clock"></i>
	                  	</div>
	                  	<a href="#" class="small-box-footer" data-toggle="modal" data-target="#onTimeModal">
	                    	More info <i class="fas fa-arrow-circle-right"></i>
	                  	</a>
	              	</div>
	          </div>
	          
	      </div>
	      <!-- /.row -->
	    </div>
	    <!-- /.container-fluid -->
	  </div>
	  <!-- /.content -->
	</div>
@endsection
