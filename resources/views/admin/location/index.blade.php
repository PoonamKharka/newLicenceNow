@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Locations</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Locations</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('location.create') }}" class="btn btn-block btn-sm btn-success"> Add Location </a>
                </h3>
              </div>
              @if (session('status'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                    {{ session('status') }}
                </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table id="y_dataTables" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Country</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
             ajax: "{{ route('location.index') }}",
             columns: [
                      // { data: 'id', name: 'id' },
                      { data: 'street', name: 'street' },
                      { data: 'city', name: 'city' },
                      { data: 'state', name: 'state' },
                      { data: 'postcode', name: 'postcode' },
                      { data: 'latitude', name: 'latitude' },
                      { data: 'longitude', name: 'longitude' },
                      { data: 'country', name: 'country' },
                      { data: 'action', name: 'action', orderable: false, searchable: false},
                   ]
          });
       });


     // Handle delete button click
     $(document).on('click', '.delete-location', function() {
        let locationId = $(this).data('id');
        let deleteUrl = $(this).data('url');
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete this location?')) {
            // Create a form dynamically
            var form = $('<form>', {
                action: deleteUrl,
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
