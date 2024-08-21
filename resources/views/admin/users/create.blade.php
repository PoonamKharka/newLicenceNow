@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Users</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Register New User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="Enter Name">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="Enter Email">
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" placeholder="Enter Username">
                            </div>
                          </div>
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                            <label>Select User Type</label>
                            <select class="form-control">
                                <option>Instructor</option>
                                <option>Learner</option>
                            </select>
                            </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="Enter Password">
                            </div>
                          </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="submit" class="btn btn-default">Cancel</button>
                  </div>
                  <!-- /.card-footer -->
              </div>
              <!-- /.card -->
              <!-- general form elements disabled -->
        </div>
        <!-- /.col-12-->
      </div>
      <!-- /.raw -->
  </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection