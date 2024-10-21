@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-sm-6">
        <h1 class="m-0 text-primary">Instructors Request</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#" class="text-secondary">Home</a></li>
          <li class="breadcrumb-item active text-secondary">Instructors Request</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-header ">
                <h3 class="card-title">
                  <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">Add Instructors</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="y_dataTables" class="table table-bordered table-striped">
                  <thead class="table-primary">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Postcode</th>                    
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <!-- Data will be populated here -->
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
<!-- Modal Structure -->
<div class="modal fade" id="instructorModal" tabindex="-1" role="dialog" aria-labelledby="instructorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="instructorModalLabel">Instructor Request Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content will be loaded via AJAX -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function() { 
  $(document).ready( function () {
      $('#y_dataTables').DataTable({
             processing: false,
             serverSide: true,
             ajax: "{{ route('instructor-request') }}",
             columns: [
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'phoneNo', name: 'phoneNo' },
                { data: 'postcode', name: 'postcode' },                
                { data: 'status', name: 'status', orderable: false, searchable: false},
                { data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
       });
});

  </script>
  <script>
    $(document).ready(function() {
        // Handle Pending button click
        $(document).on('click', '#pending', function() {
            var instructorId = $(this).data('id');
            updateInstructorStatus(instructorId, 'pending');
        });
    
        // Handle Approve button click
        $(document).on('click', '#approve', function() {
            var instructorId = $(this).data('id');
            updateInstructorStatus(instructorId, 'approve');
        });
    
        // Handle Hold button click
        $(document).on('click', '#hold', function() {
            var instructorId = $(this).data('id');
            updateInstructorStatus(instructorId, 'hold');
        });
    
        // Handle Reject button click
        $(document).on('click', '#reject', function() {
            var instructorId = $(this).data('id');
            updateInstructorStatus(instructorId, 'rejected');
        });
    
        // AJAX function to update instructor status
        function updateInstructorStatus(instructorId, status) {
            $.ajax({
                url: '{{ route('instructor-request.update-status') }}', 
                method: 'POST',
                data: {
                    id: instructorId,
                    status: status,
                    _token: '{{ csrf_token() }}' 
                },
                success: function(response) {
                    if (response.success) {
                      toastr.success('Status updated to '+status, 'Success', { timeOut: 5000 });
                        $('#y_dataTables').DataTable().ajax.reload(null, false);
                    } else {
                      toastr.error('Failed to update status.', 'Error', { timeOut: 5000 });
                        alert('Failed to update status');
                    }
                },
                error: function(xhr, status, error) {
                  toastr.error('Failed to update status!'+error, 'Error', { timeOut: 5000 });
                }
            });
        }
    });
    $(document).on('click', '.view-btn', function() {
      var instructorId = $(this).data('id');

      $.ajax({
          url: "/admin/instructor-request-show/" + instructorId, 
          method: 'GET',
          success: function(response) { 
                       
              $('#instructorModal .modal-body').html(response);
          },
          error: function(xhr) {
            toastr.error('Unable to load instructor details. Please try again later.', 'Error', { timeOut: 5000 });
          }
      });
    });
    </script>

@endsection
