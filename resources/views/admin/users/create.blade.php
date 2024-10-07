
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
                  <form method="POST" action="{{ route('users.store') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                      <div class="col-sm-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="John" name="first_name">
                          @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="col-sm-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Deo" name="last_name">
                          @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label>Select User Type</label>
                          <select class="form-control select" name="userType_id">
                            <option value = 1>Admin</option>
                            <option value = 2 selected>Instructor</option>
                          </select>
                        </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="test@yopmail.com" name="email">
                          @error('email')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="****" name="password">
                              @error('password')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Confirm Password</label>
                              <input type="password" class="form-control" name="password_confirmation" placeholder="****">
                              @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info">Submit</button>
                      <button type="reset" class="btn btn-default" onclick="window.location='{{ route('users.index') }}'">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                  </form>
                </div>
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
