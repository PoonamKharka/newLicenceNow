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
        <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List of All Users</h3>
            <div class="card-tools">
              <div class="col-md-8 offset-md-4">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control form-control-sm" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
              @endif
            <button type="submit" class="btn btn-success"><a href="{{ route('users.create') }}" style="text-decoration: none; color:aliceblue">Add More</a></button>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ( $allUsers as $users)
              <tr>
                <td>{{  $users->name }}</td>
                <td>{{  $users->email }}</td>
                @if ( $users->isInstructor === 1 )
                  <td> Instructor </td>
                @endif
                @if ( $users->isLearner === 1 )
                  <td> Learner </td>
                @endif
                @if ( $users->isAdmin === 1 )
                  <td> Admin </td>
                @endif
                <td>{{  ($users->status === 1)? 'Active' : 'Inactive'}}</td>
                <td> 
                  <div class="btn-group btn-group-sm">
                    <a href="{{ route('users.show', encrypt($users->id)) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
             </tbody>
            </table>
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