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
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">User Details</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form method="POST" action="">
                    @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" value="{{ $userData->name }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" value="{{ $userData->username }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" value="{{ $userData->email }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="email">Status</label>
                        <select class="form-control" name="status">
                          <option value="1" selected> {{ ($userData->status == 1) ? "Active" : "Inactive" }}</option>
                        </select>
                    {{-- <input type="text" id="email" class="form-control" value="{{ $userData->status }}"> --}}
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                  </div>
                  <!-- /.card-footer -->
                  </form>
                  <!-- /form -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
        {{-- /.col-12 --}}
      </div>
      <!-- /.raw -->
  </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection