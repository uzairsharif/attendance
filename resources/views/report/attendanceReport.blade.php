@extends('attendance::layouts.adminlte')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Attendance Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Attendance-Report</li>
          </ol>
        </div>
      </div>
      <form action="{{ route('attendance.report') }}" id="reportForm">
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
                  <option value="">Select User</option>
                  @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          
          <div class="col-sm-3">
            <div class="form-group">
              <label>In Status</label>
              <select name="in_status" id="In_Status_Dropdown" class="form-control select2">
                  <option value="" selected="selected">Select In Status</option>
                @foreach(\Uzair3\Attendance\Models\Attendance::getInStatusOptions() as $inStatus)
                  <option value="{{ $inStatus }}">{{ $inStatus }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label>Out Status</label>
              <select name="out_status" id="Out_Status_Dropdown" class="form-control">
                  <option value="">Select Out Status</option>
                @foreach(\Uzair3\Attendance\Models\Attendance::getOutStatusOptions() as $outStatus)
                  <option value="{{ $outStatus }}">{{ $outStatus }}</option>
                @endforeach
              </select>
            </div>
          </div>

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
  					<!-- dynamic data will come here -->
    			</div>
    		</div>		
      </div>
      </section>
    </div>
	
@endsection

@push('scripts')
<script>
  // $(document).ready(function() {
  $(function () {
    // setTimeout was used because userDropdown was created dynamically
    // and data was comming from database so it took time and even if
    // it was in $(function(){ but still #userDropdown was not available for select2 to properly add allowClear and placeholder.
    setTimeout(() => {
        $('#userDropdown').select2({
            placeholder: 'Select a User',
            allowClear: true,
            width: '100%'
        });
    }, 1000);
    setTimeout(() => {
      $("#In_Status_Dropdown").select2({
         placeholder: 'Select In Status',
         allowClear: true,
         width: '100%'
      });
    }, 1000);
    setTimeout(() => {
      $("#Out_Status_Dropdown").select2({
         placeholder: 'Select Out Status',
         allowClear: true,
         width: '100%'
      });
    }, 1000);

    // console.log($('#userDropdown').data('select2'));
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

      // const formDataObj = Object.fromEntries(formData.entries());
      // console.log(formDataObj);



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
          } 
          else {
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