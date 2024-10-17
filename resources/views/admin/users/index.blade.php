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
            <h3 class="card-title">
              <a href="{{ route('users.create') }}" class="btn btn-block btn-sm btn-success"> Add User </a>
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                    {{ session('status') }}
                </div>
              @endif
           
            {{-- <br><br> --}}
            <table id="y_dataTables" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
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
<script type="text/javascript">
  $(function() {
    $(document).ready( function () {
    $('#y_dataTables').DataTable({
           processing: false,
           serverSide: true,
           ajax: "{{ route('users.index') }}",
           columns: [
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'userType_id' , name: 'userType_id'},
                    { data: 'userStatus', name: 'userStatus' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},
                 ]
        });
     });

     // Handle delete button click
    $(document).on('click', '.delete-btn', function() {
        let userId = $(this).data('id');
        let url = $(this).data('url');
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete this user?')) {
            // Create a form dynamically
            var form = $('<form>', {
                action: url,
                method: 'POST'
            });

            // Append CSRF token and DELETE method
            form.append('@csrf');
            form.append('@method("DELETE")');

            // Append the form to the body and submit it
            $('body').append(form);
            form.submit();
        }
    });
  });
</script>
@endsection
