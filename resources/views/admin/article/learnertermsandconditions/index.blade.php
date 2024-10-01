@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Learner Terms and Conditions</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Learner Terms and Conditions</li>
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
             <h3 class="card-title">List of All Learner Terms and Conditions</h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
             <!-- Display Validation Errors -->
             @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                  </ul>
               </div>
            @endif
            @if (session('success'))
               <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="fas fa-times"></i>
               </button>
                  {{ session('success') }}
               </div>
            @endif
             <button type="submit" class="btn btn-success"><a href="{{ route('learner-terms-and-condition.create') }}" style="text-decoration: none; color:aliceblue">Add Learner Terms and Conditions</a></button>
             <br><br>
             <table id="y_dataTables" class="table table-bordered table-striped">
               <thead>
               <tr>                  
                   <th>Title</th>                   
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
         processing: true, 
         serverSide: true, 
         ajax: "{{ route('learner-terms-and-condition.index') }}",
         columns: [   
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action', orderable: false, searchable: false},            
         ]
      });
 
      // Handle delete button click
      $(document).on('click', '.delete-btn', function() {
        let testpackageId = $(this).data('id');
        
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete this learner terms and conditions?')) {
            // Create a form dynamically
            var form = $('<form>', {
                action: "{{ route('learner-terms-and-condition.destroy', '') }}"+ '/' + testpackageId,
                method: 'POST'
            });
            
            form.append('@csrf');
            form.append('@method("DELETE")');
            
            $('body').append(form);
            form.submit();
        }
      });

   });
 </script>
@endsection