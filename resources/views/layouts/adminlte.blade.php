<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Admin LTE files inclusion below -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css' ) }}">
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css' ) }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css' ) }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('uzair3/attendance/adminlte/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Admin LTE files inclusion above -->

    <style>
      div.dataTables_wrapper div.dataTables_length select {
        width:60px;
      }
      .btn_disabled{
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.6;
      }
      .custom-hover:hover{
        color:#2125CA !important;
      }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

    @include('attendance::partials.profile_image_modal')
    <div id="app">
        <main>
            <div class="wrapper">

              <!-- Main Sidebar Container -->
              <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">

                  <img src="{{ asset('uzair3/attendance/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

                  <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                  <div style="overflow:visible" class="user-panel mt-3 pb-3 mb-3 d-flex">
                      <div class="image position-relative">
                        
                          <div class="dropdown profile-dropdown">
                              <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('uzair3/attendance/default-user.png') }}" 
                                   alt="Profile Image" 
                                   class="img-circle elevation-2 profile-img dropdown-toggle"
                                   id="profileDropdown"
                                   data-toggle="dropdown"
                                   aria-expanded="true" 
                                   width="50"
                              >
                            
                              <div style="padding:2px;" class="dropdown-menu" aria-labelledby="profileDropdown">
                                  <a href="#" class="custom-hover dropdown-item" data-toggle="modal" data-target="#uploadProfileImageModal">Upload profile image</a>
                              </div>
                          </div>
                      </div>
                      <div class="info">
                          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                      </div>
                  </div>

                  <!-- SidebarSearch Form -->
                  <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                      <input class="form-control form-control-sidebar" name="search" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->

                      <li class="nav-item">
                        <a href="{{ route('admin.dashboard')}}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Dashboard
                          </p>
                        </a>
                      </li>

                      <li class="nav-item menu-is-opening menu-open">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-calendar-minus"></i>
                          <p>
                            Leave
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                            <a href="{{ route('leave-approval')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Leave approval</p>
                            </a>
                          </li>
                          
                        </ul>
                      </li>

                      <li class="nav-item menu-is-opening menu-open">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-calendar-minus"></i>
                          <p>
                            Attendance
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                          <li class="nav-item">
                            <a href="{{route('attendance-correction')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Attendance Correction</p>
                            </a>
                          </li>
                          
                        </ul>
                      </li>
                      

                      <!-- <li class="nav-item">
                        <a href="{{ route('shifts')}}" class="nav-link">
                          <i class="nav-icon fas fa-clock"></i>
                          <p>
                            Shifts
                          </p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('departments')}}" class="nav-link">
                          <i class="nav-icon fas fa-building"></i>
                          <p>
                            Departments
                          </p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{ route('employees')}}" class="nav-link">
                          <i class="nav-icon fas fa-user-tie"></i>
                          <p>
                            Employees
                          </p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{route('locations')}}" class="nav-link">
                          <i class="nav-icon fas fa-map-marker-alt"></i>
                          <p>
                            Locations
                          </p>
                        </a>
                      </li> -->


                      <li class="nav-item">
                        <a href="{{route('users')}}" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                            Users
                          </p>
                        </a>
                      </li>


                      <li class="nav-header">Reports</li>

                      <li class="nav-item">
                        <a href="{{route('attendance-report')}}" class="nav-link">
                          <i class="nav-icon fas fa-print"></i>
                          <p>
                            Attendance Report
                          </p>
                        </a>
                      </li>


                      <li class="nav-item">
                        <a href="{{route('leave-report')}}" class="nav-link">
                          <i class="nav-icon fas fa-print"></i>
                          <p>
                            Leave Report
                          </p>
                        </a>
                      </li>

                      
                      <li class="nav-header">Logout</li>
                      <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                            Logout
                          </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </li>

                    </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
              </aside>

              @yield('content')
              <!-- Control Sidebar -->
              <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
              </aside>
              <!-- /.control-sidebar -->

              <!-- Main Footer -->
              <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                  <b>Version</b> 3.2.0
                </div>
              </footer>
            </div>
        
        </main>
    </div>

    <!-- Inclusion of AdminLTE Scripts -->
    <!-- jQuery -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    
    <!-- Bootstrap -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr --> 
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- date-range-picker -->
    <!-- <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script> -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/select2/js/select2.full.min.js' ) }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js' ) }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/moment/moment.min.js' ) }}"></script>
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/inputmask/jquery.inputmask.min.js' ) }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/daterangepicker/daterangepicker.js' ) }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js' ) }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ) }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('uzair3/attendance/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js' ) }}"></script>
    <!-- BS-Stepper -->
    <script src="{{-- asset('uzair3/attendance/adminlte/plugins/bs-stepper/js/bs-stepper.min.js' ) --}}"></script>
    <!-- dropzonejs -->
    <script src="{{-- asset('uzair3/attendance/adminlte/plugins/dropzone/min/dropzone.min.js' ) --}}"></script>
    <!-- AdminLTE App -->

    <!-- AdminLTE -->
    <script src="{{ asset('uzair3/attendance/adminlte/dist/js/adminlte.min.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('uzair3/attendance/adminlte/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{--asset('uzair3/attendance/adminlte/dist/js/demo.js')--}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{--asset('uzair3/attendance/adminlte/dist/js/pages/dashboard3.js') --}}"></script>
    <!-- End of Inclusion of AdminLTE Scripts -->

    @stack('scripts')
    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        // $('#reservationdate').datetimepicker({
        //     format: 'L'
        // });

        // //Date picker 2
        // $('#reservationdate2').datetimepicker({
        //     format: 'L'
        // });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          locale: {
            format: 'MM/DD/YYYY hh:mm A'
          }
        })


        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
          format: 'LT'
        })

        //Timepicker
        $('#timepicker2').datetimepicker({
          format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
          $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

      })
      // // BS-Stepper Init
      // document.addEventListener('DOMContentLoaded', function () {
      //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      // })

      // // DropzoneJS Demo Code Start
      // Dropzone.autoDiscover = false

      // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      // var previewNode = document.querySelector("#template")
      // previewNode.id = ""
      // var previewTemplate = previewNode.parentNode.innerHTML
      // previewNode.parentNode.removeChild(previewNode)

      // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      //   url: "/target-url", // Set the url
      //   thumbnailWidth: 80,
      //   thumbnailHeight: 80,
      //   parallelUploads: 20,
      //   previewTemplate: previewTemplate,
      //   autoQueue: false, // Make sure the files aren't queued until manually added
      //   previewsContainer: "#previews", // Define the container to display the previews
      //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
      // })

      // myDropzone.on("addedfile", function(file) {
      //   // Hookup the start button
      //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
      // })

      // // Update the total progress bar
      // myDropzone.on("totaluploadprogress", function(progress) {
      //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
      // })

      // myDropzone.on("sending", function(file) {
      //   // Show the total progress bar when upload starts
      //   document.querySelector("#total-progress").style.opacity = "1"
      //   // And disable the start button
      //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
      // })

      // // Hide the total progress bar when nothing's uploading anymore
      // myDropzone.on("queuecomplete", function(progress) {
      //   document.querySelector("#total-progress").style.opacity = "0"
      // })

      // // Setup the buttons for all transfers
      // // The "add files" button doesn't need to be setup because the config
      // // `clickable` has already been specified.
      // document.querySelector("#actions .start").onclick = function() {
      //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
      // }
      // document.querySelector("#actions .cancel").onclick = function() {
      //   myDropzone.removeAllFiles(true)
      // }
      // // DropzoneJS Demo Code End

      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
        </script>

</body>
</html>
