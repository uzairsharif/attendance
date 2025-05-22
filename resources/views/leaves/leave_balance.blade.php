@extends('attendance::layouts.user')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leave Balance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leave Balance</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="row-12">
              <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Leave Balance</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <th colspan="2" style="font-size: 18px;">Casual leaves</th>
                              </tr>
                              <tr>
                                <td width="50%">Total Available:</td>
                                <th>25</th>
                              </tr>
                              <tr>
                                <td>Total Availed:</td>
                                <th>{{ $leave_data['availed_casual_leaves'] }}</th>
                              </tr>
                              <tr>
                                <td>Remaining Leaves:</td>
                                <th>{{ $leave_data['remaining_casual_leaves'] }}</th>
                              </tr>
                              <tr>
                                <td>Leave Update Type:</td>
                                <th>Per Year Update</th>
                              </tr>
                            </tbody>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <th colspan="2" style="font-size: 18px;">Medical Leaves</th>
                              </tr>
                              <tr>
                                <td width="50%">Total Available:</td>
                                <th>25</th>
                              </tr>
                              <tr>
                                <td>Total Availed:</td>
                                <th>{{ $leave_data['availed_medical_leaves'] }}</th>
                              </tr>
                              <tr>
                                <td>Remaining Leaves:</td>
                                <th>{{ $leave_data['remaining_medical_leaves'] }}</th>
                              </tr>
                              <tr>
                                <td>Leave Update Type:</td>
                                <th>Per Year Update</th>
                              </tr>
                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </div>
          </div>
        </div>
      </div>
          
    </section>
  
@endsection

@push('scripts')
  
@endpush
  
