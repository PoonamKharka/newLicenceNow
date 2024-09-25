@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Driving Lesson</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Driving Lesson</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
       <div class="row">
         <div class="col-12">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">List of All Driving Lessons</h3>
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
             <button type="submit" class="btn btn-success"><a href="{{ route('lessons.create') }}" style="text-decoration: none; color:aliceblue">Add More</a></button>
             <br><br>
             <table id="y_dataTables" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>Image</th>
                   <th>Title</th>
                   <th>Price</th>
                   <th>Description</th>
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
 <script>
  
     $(document).ready( function () {
      $('#y_dataTables').DataTable({
         processing: true, // true enables DataTables 'Processing' indicator
         serverSide: true, // Enables server-side processing mode
         ajax: {
            url: "{{ route('lessons.index') }}", // Adjust this route if needed
            type: "GET" // Ensure correct HTTP method
         },
         columns: [
            {
               data: 'image', 
               name: 'image',
               render: function(data, type, full, meta) {
                  return '<img src="' + data + '" alt="Image" width="50"/>';
               }
            },
            { data: 'title', name: 'title' },
            { data: 'price', name: 'price' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
            // {
            //    data: 'action', 
            //    name: 'action', 
            //    orderable: false, 
            //    searchable: false,
            //    render: function(data, type, row, meta) {
            //       return '<button class="edit-btn btn btn-primary" data-id="' + row.id + '">Edit</button>' +
            //             '<button class="delete-btn btn btn-danger" data-id="' + row.id + '">Delete</button>';
            //    }
            // }
         ]
      });
 
      // Handle delete button click
      $(document).on('click', '.delete-btn', function() {
         let lessonId = $(this).data('id');
         
         // Show confirmation dialog
         if (confirm('Are you sure you want to delete this lesson?')) {
            $.ajax({
                  url: '/lessons/' + lessonId, // Assuming route('lessons.destroy', lessonId)
                  type: 'DELETE',
                  data: {
                     _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                     if (response.success) {
                        alert('Lesson deleted successfully!');
                        $('#y_dataTables').DataTable().ajax.reload(); // Reload DataTables
                     } else {
                        alert('Failed to delete the lesson.');
                     }
                  },
                  error: function(xhr) {
                     console.error('Error:', xhr);
                     alert('An error occurred.');
                  }
            });
         }
      });

   });
 </script>
@endsection