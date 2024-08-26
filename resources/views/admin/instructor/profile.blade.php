@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Instructors Details</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Instructors</li>
        </ol>
      </div>
      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Instructor Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form>
                        <div class="row">
                          <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" placeholder="Enter ..." disabled>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <div class="input-group date" id="dateOfBirth" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-target="#dateOfBirth" placeholder="Enter Date Of Birth"/>
                                  <div class="input-group-append" data-target="#dateOfBirth" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Date Of Joining</label>
                                <div class="input-group date" id="dateOfJoining" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#dateOfBirth" placeholder="Enter Date Of Joining"/>
                                    <div class="input-group-append" data-target="#dateOfJoining" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Date Of Resignation</label>
                                <div class="input-group date" id="dateOfResignation" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-target="#dateOfResignation" placeholder="Enter Date Of Resignation"/>
                                  <div class="input-group-append" data-target="#dateOfResignation" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                              <label>Correspondence Address</label>
                              <textarea class="form-control" rows="3" placeholder="Enter Correspondence Address"></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Total Driving Expirence</label>
                              <input type="number" class="form-control" placeholder="Enter Your Total Expirence in Driving">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- general form elements disabled -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(function () { 
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //dateOfJoining
        $('#dateOfJoining').datetimepicker({
            format: 'L'
        });

        //dateOfJoining
        $('#dateOfBirth').datetimepicker({
            format: 'L'
        });

        $('#dateOfResignation').datetimepicker({
            format: 'L'
        });
    });
</script>
@endsection
