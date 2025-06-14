@extends('attendance::layouts.user')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                            <h3 class="card-title">Attendance</h3>
                        </div>
                        <div class="card-body">
                        @if($on_leave)
                            <h5>You are on leave today.</h5>
                        @else
                            @if($todays_attendance->isNotEmpty() && $todays_attendance->first()->check_out == null)
                                <button class="btn btn-block btn-primary" id="checkOutBtn">Check Out</button>
                            @elseif($todays_attendance->isNotEmpty() && $todays_attendance->first()->check_out != null)
                                <h5>Attendance has already been marked and checked out</h5>
                            @else
                            <video id="camera" autoplay></video>
                            <canvas id="snapshotCanvas" style="display: none;"></canvas>
                            <img id="capturedImage" style="display: none; width: 100px; height: 100px;">
                            <div class="mt-2">
                                <button class="btn btn-block btn-success" id="captureBtn">Capture Image & Check In</button>
                                <!-- <button class="btn btn-block btn-success" id="checkInBtn">Check In</button> -->
                                <button class="btn btn-block btn-primary" id="checkOutBtn" disabled>Check Out</button>
                            </div>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    let video = document.getElementById('camera');
    let canvas = document.getElementById('snapshotCanvas');
    let capturedImage = document.getElementById('capturedImage');
    // let checkInBtn = document.getElementById('checkInBtn');
    let captureBtn = document.getElementById('captureBtn');
    let checkOutBtn = document.getElementById('checkOutBtn');
    let capturedPhoto = null;

    if (video) {
        navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => video.srcObject = stream)
        .catch(err => console.error("Camera access denied:", err));
    }

    if (captureBtn) {
        document.getElementById('captureBtn').addEventListener('click', function () {
            let context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Convert canvas to image
            capturedImage.src = canvas.toDataURL('image/png');
            capturedImage.style.display = "block";
            
            canvas.toBlob(blob => {
                if (!blob) {
                    Swal.mixin({
                        toast: true,
                        position: 'top-end', 
                        showConfirmButton: false,
                        timer: 3000
                    }).fire({
                        icon: 'warning',
                        title: 'Please capture an image first!'
                    });
                    return;
                }

                capturedPhoto = new File([blob], "attendance.png", { type: "image/png" });

                let formData = new FormData();
                formData.append('attendance_image', capturedPhoto);

                fetch("{{ route('attendance.checkin') }}", {
                    method: "POST",
                    body: formData,
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end', 
                            showConfirmButton: false,
                            timer: 3000
                        }).fire({
                            icon: 'error',
                            title: data.error
                        });
                    } else {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end', 
                            showConfirmButton: false,
                            timer: 3000
                        }).fire({
                            icon: 'success',
                            title: data.message
                        });

                        captureBtn.disabled = true;
                        // checkInBtn.disabled = true;
                        captureBtn.classList.remove('btn-success');
                        captureBtn.classList.add('btn-primary');
                        checkOutBtn.disabled = false;
                    }
                })
                .catch(error => console.error("Error:", error));
            }, 'image/png');
            {{--
            // canvas.toBlob(blob => {
            //     capturedPhoto = new File([blob], "attendance.png", { type: "image/png" });
            // }, 'image/png');
            // if (!capturedPhoto){
            //     Swal.mixin({
            //           toast: true,
            //           position: 'top-end', 
            //           showConfirmButton: false,
            //           timer: 3000
            //         }).fire({
            //           icon: 'warning',
            //           title: 'Please capture an image first!'
            //         });
            //         return;
            // } 

            // let formData = new FormData();
            // formData.append('attendance_image', capturedPhoto);

            // fetch("{{ route('attendance.checkin') }}", {
            //     method: "POST",
            //     body: formData,
            //     headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if(data.error){
            //         Swal.mixin({
            //           toast: true,
            //           position: 'top-end', 
            //           showConfirmButton: false,
            //           timer: 3000
            //         }).fire({
            //           icon: 'error',
            //           title: data.error
            //         });
            //     }
            //     else{
            //         Swal.mixin({
            //           toast: true,
            //           position: 'top-end', 
            //           showConfirmButton: false,
            //           timer: 3000
            //         }).fire({
            //           icon: 'success',
            //           title: data.message
            //         });
            //         captureBtn.disabled = true;
            //         checkInBtn.disabled = true;
            //         checkInBtn.removeClass = 'btn-success';
            //         checkInBtn.addClass = 'btn-primary'
            //         checkOutBtn.disabled = false;
            //     }
            // })
            // .catch(error => console.error("Error:", error)); 
            --}}
        });
    }

    {{--
    // if(checkInBtn){
    //     checkInBtn.addEventListener('click', function () {
    //         if (!capturedPhoto){
    //             Swal.mixin({
    //                   toast: true,
    //                   position: 'top-end', 
    //                   showConfirmButton: false,
    //                   timer: 3000
    //                 }).fire({
    //                   icon: 'warning',
    //                   title: 'Please capture an image first!'
    //                 });
    //                 return;
    //         } 

    //         let formData = new FormData();
    //         formData.append('attendance_image', capturedPhoto);

    //         fetch("{{ route('attendance.checkin') }}", {
    //             method: "POST",
    //             body: formData,
    //             headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if(data.error){
    //                 Swal.mixin({
    //                   toast: true,
    //                   position: 'top-end', 
    //                   showConfirmButton: false,
    //                   timer: 3000
    //                 }).fire({
    //                   icon: 'error',
    //                   title: data.error
    //                 });
    //             }
    //             else{
    //                 Swal.mixin({
    //                   toast: true,
    //                   position: 'top-end', 
    //                   showConfirmButton: false,
    //                   timer: 3000
    //                 }).fire({
    //                   icon: 'success',
    //                   title: data.message
    //                 });
    //                 captureBtn.disabled = true;
    //                 checkInBtn.disabled = true;
    //                 checkInBtn.removeClass = 'btn-success';
    //                 checkInBtn.addClass = 'btn-primary'
    //                 checkOutBtn.disabled = false;
    //             }
    //         })
    //         .catch(error => console.error("Error:", error));
    //     });
    // }

    --}}

    if(checkOutBtn){
        checkOutBtn.addEventListener('click', function () {
            // if (!capturedPhoto) return alert("Please capture an image first!");

            let formData = new FormData();
            // formData.append('attendance_image', capturedPhoto);

            fetch("{{ route('attendance.checkout') }}", {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            })
            .then(response => response.json())
            .then(data => {
                Swal.mixin({
                      toast: true,
                      position: 'top-end', 
                      showConfirmButton: false,
                      timer: 3000
                    }).fire({
                      icon: 'success',
                      title: data.message
                    });
                checkOutBtn.disabled = true;
            })
            .catch(error => console.error("Error:", error));
        });
    }
</script>
@endpush
