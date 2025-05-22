@extends('attendance::layouts.user')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attendance Correction Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Attendance Correction Request</li>
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
	            <h3 class="card-title">Attendance Correction Request</h3>
	          </div>
	          <!-- /.card-header -->
	          <div class="card-body">
	            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <form id="attendance_correction_form">
	                <div class="row">
                   <span id="attendance_error" class="text-danger"></span>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Date</label>
                        <select id="attendance_dates" class="form-control select2" style="width: 100%;">
                            <option value="" selected="selected">Select Date</option>
                          @foreach($attendance_dates as $attendance_date)
                            <option value="{{$attendance_date}}">{{ $attendance_date}}</option>
                          @endforeach
                          
                        </select>
                      </div>

                      <!-- <div class="form-group">
                        <label>Date</label>
                          <div class="input-group date" id="date" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#date">
                              <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div> -->
                    
                    </div>
                    
                    <div class="col-md-4" style="display:none;">
                      <div class="form-group">
                        <input id="attendance_id" type="text" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Check In</label>
                        <input id="check_in" type="text" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Check Out</label>
                        <input id="check_out" type="text" class="form-control" readonly>
                      </div>
                    </div>
                     
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Requested Check In</label>

                        <div class="input-group date" id="requested_check_in" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#requested_check_in">
                          <div class="input-group-append" data-target="#requested_check_in" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>              
                      </div>
                    </div>
                    {{--
                    <!-- <div class="col-md-4">
                      <div class="form-group">
                        <label>In Status</label>
                        <select name="out_status" class="form-control">
                            @foreach(\App\Models\Attendance::getInStatusOptions() as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>

                        
                      </div>
                    </div> -->

                    --}}

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Requested Check Out</label>

                        <div class="input-group date" id="requested_check_out" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#requested_check_out">
                          <div class="input-group-append" data-target="#requested_check_out" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                          </div>
                        </div>              
                      </div>
                    </div>

                    {{--
                    <!-- 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Out Status</label>
                        <select name="out_status" class="form-control">
                            @foreach(\Uzair3\Attendance\Models\Attendance::getOutStatusOptions() as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div> -->
                    --}}
                    <div class="col-md-4">                    
                      <div class="form-group">
                        <label>Reason</label>
                        <textarea id="correction_reason" class="form-control" rows="3" placeholder="Enter Reason"></textarea>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
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
        $('#attendance_dates').select2({
            placeholder: 'Select Date',
            allowClear: true,
            width: '100%' 
        });

      $('#requested_check_in').datetimepicker({
         format: 'HH:mm',
         icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down'
        },
      });
      $('#requested_check_out').datetimepicker({
         format: 'HH:mm',
         icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down'
        },
      });
      $('#date').datetimepicker({
        format: 'L'
      });

      $('#attendance_dates').on('change', function () {
          let selectedDate = $(this).val();
          $('#check_in').val('');
          $('#check_out').val('');
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          if (selectedDate) {
              $.ajax({
                  url: '/fetch-attendance-data',
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'Accept': 'application/json',
                      'X-CSRF-TOKEN': csrfToken,
                  },
                  data: JSON.stringify({
                      date: selectedDate,
                  }),
                  success: function (response) {
                        $('#attendance_error').text(''); // Clear any previous error
                        $('#correction_reason').val('');
                        $('#requested_check_out input').val('').datetimepicker('clear');
                        $('#requested_check_in input').val('').datetimepicker('clear');  
                      if(response.correction_existence_msg){
                        Swal.mixin({
                          toast: true,
                          position: 'top-end', 
                          showConfirmButton: false,
                          timer: 3000
                        }).fire({
                          icon: 'error',
                          title: response.correction_existence_msg
                        });
                      }
                      else{
                        $('#attendance_id').val(response.attendance_id);
                        $('#check_in').val(response.check_in || 'No data available');
                        $('#check_out').val(response.check_out || 'No data available');
                      }
                      
                    

                  },
                  error: function (xhr) {
                      console.error('Error fetching attendance data:', xhr);
                      const errors = xhr.responseJSON?.errors;
                      if (errors && errors.date) {
                          $('#attendance_error').text(errors.date[0]);
                          $('#check_in').val('');
                          $('#check_out').val('');
                      }
                  }
              });
          } else {
              $('#check_in').val('');
              $('#check_out').val('');
          }
      });

      $(document).on('submit', '#attendance_correction_form', function (e) {
        e.preventDefault();

        const attendanceId = $('#attendance_id').val();
        const date = $('#attendance_dates').val();
        const RequestedCheckIn = $('#requested_check_in input.datetimepicker-input').val();
        const RequestedCheckOut = $('#requested_check_out input.datetimepicker-input').val();
        const reason = $('#correction_reason').val();

        $.ajax({
          url: `{{ route('attendance.correction') }}`,
          type: 'POST',
          data: {
              attendance_id: attendanceId,
              attendance_date: date,
              requested_check_in: RequestedCheckIn,
              requested_check_out: RequestedCheckOut,
              reason: reason,
              _token: $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (response) {
            $('#attendance_error').text('');
            $('#attendance_dates').val(null).trigger('change');
            $('#check_in').val('');
            $('#check_out').val('');
            $('#correction_reason').val('');
            $('#requested_check_out input').val('').datetimepicker('clear');
            $('#requested_check_in input').val('').datetimepicker('clear');
              
            Swal.mixin({
              toast: true,
              position: 'top-end', 
              showConfirmButton: false,
              timer: 3000
            }).fire({
              icon: 'success',
              title: response.message
            });
          },
          error: function (xhr) {

            if (xhr.status === 422) { 
              $('.is-invalid').removeClass('is-invalid');
              const errors = xhr.responseJSON.errors;

              for (let field in errors) 
              {
                const element = $(`[name="${field}"]`);
                if (element.is('div')) {
                    element.addClass('is-invalid')
                    element.find('input').addClass('is-invalid');
                } else {
                    element.addClass('is-invalid');
                }
                element.after(`<div class="invalid-feedback">${errors[field]}</div>`);
              }
              Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              }).fire({
                icon: 'error',
                title: errors.requested_check_in[0]
              });
            } 
            else {
              alert('An error occurred. Please try again.'); // Handle other errors
            }
          },
        });
      });

    });
  </script>
@endpush

  