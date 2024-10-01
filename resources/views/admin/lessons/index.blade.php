@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Driving Lessons</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Driving Lessons</li>
        </ol>
      </div>
      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('lessons.create') }}" class="btn btn-block btn-sm btn-success"> Add More Lessons </a>
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
                @if (session('warning'))
                  <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="fas fa-times"></i>
                    </button>
                      <i class="icon fas fa-exclamation-triangle"></i>{{ session('warning') }}
                  </div>
                @endif
                <table id="lesson-table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Locations</th>
                    <th>Prices</th>
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
      $('#lesson-table').DataTable({
             processing: false,
             serverSide: true,
             ajax: "{{ route('lessons.index') }}",
             columns: [
                      { data: 'title', name: 'title' },
                      { data: 'description', name: 'description' },
                      { data: 'lesson_status', name: 'lesson_status' },
                      { data: 'locations-list', name: 'locations-list' },
                      { data: 'price-list', name: 'price-list' },
                      { data: 'action', name: 'action', orderable: false, searchable: false},
                   ]
          });
       });


     // Handle delete button click
     $(document).on('click', '.delete-lesson', function() {
        let locationId = $(this).data('id');
        let deleteUrl = $(this).data('url');
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete this lesson?')) {
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

    

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
});

  </script>
@endsection
