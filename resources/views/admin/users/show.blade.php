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
                @php
                   dd($userData->name)
                @endphp
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" value="">
                  </div>
                  
                  <div class="form-group">
                    <label for="inputClientCompany">User Name</label>
                    <input type="text" id="inputClientCompany" class="form-control" value="Deveint Inc">
                  </div>
                  <div class="form-group">
                    <label for="inputProjectLeader">Project Leader</label>
                    <input type="text" id="inputProjectLeader" class="form-control" value="Tony Chicken">
                  </div>
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