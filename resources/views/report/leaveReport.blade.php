@extends('attendance::layouts.adminlte')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leave Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave-Report</li>
            </ol>
          </div>
        </div>
        <form action="{{ route('leave.report') }}" id="reportForm">
          <div class="row mb-2">
            <div class="col-sm-3">
              <div class="form-group">
                <label>From:</label>
                  <div class="input-group date" id="from_date_container" data-target-input="nearest">
                      <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date_container">
                      <div class="input-group-append" data-target="#from_date_container" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>To:</label>
                  <div class="input-group date" id="to_date_container" data-target-input="nearest">
                      <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date_container">
                      <div class="input-group-append" data-target="#to_date_container" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>User</label>
                <select name="user_id" id="userDropdown" class="form-control select2">
                    <option value="">Select a User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            
            <div class="col-sm-3">
              <div class="form-group">
                <label>Status</label>
                <select name="status" id="Status_Dropdown" class="form-control">
                    <option value="">Select Status</option>
                  @foreach(\Uzair3\Attendance\Models\Leave::getStatusOptions() as $Status)
                    <option value="{{ $Status }}">{{ $Status }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            {{--
            <!-- <div class="col-sm-3">
              <div class="form-group">
                <label>Out Status</label>
                <select name="out_status" id="Out_Status_Dropdown" class="form-control">
                    <option value="">Select Out Status</option>
                  @foreach(\App\Models\Attendance::getOutStatusOptions() as $outStatus)
                    <option value="{{ $outStatus }}">{{ $outStatus }}</option>
                  @endforeach
                </select>
              </div>
            </div> -->

            --}}

            <div class="col-sm-3 d-flex align-items-center">
              <button type="submit" class="btn btn-block bg-primary mt-3">Generate Report</button>
            </div>
          </div>
        </form>
      </div>
    </section>
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="row-12" id="reportSection">
    					
    		  </div>
    		</div>
    	</div>
    </div>
    			
    </section>
	
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#userDropdown').select2({
        placeholder: 'Select a User',
        allowClear: true,
        width: '100%' 
    });

  });
  $('#from_date_container').datetimepicker({
    format: 'YYYY-MM-DD',
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'far fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times'
    }
  });
  $('#to_date_container').datetimepicker({
    format: 'YYYY-MM-DD',
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'far fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times'
    }
  });

  document.getElementById('reportForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const url = this.action;

      fetch(url, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
          },
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
            
              document.getElementById('reportSection').innerHTML = data.html;
          } else {
            Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
              }).fire({
                  icon: 'error',
                  title: data.message
              });
          }
      })
      .catch(error => console.error('Error:', error));
  });


</script>
@endpush