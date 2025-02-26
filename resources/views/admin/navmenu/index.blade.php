@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Navigation</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Navigation</li>
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
                            <button type="submit" class="btn btn-sm btn-success"><a href="{{ route('nav-menu.create') }}"
                                style="text-decoration: none; color:aliceblue">Add Menus</a></button>
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
                            <table id="y_dataTables" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Description</th>
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
    <script>
        $(document).ready(function() {
            $('#y_dataTables').DataTable({
                processing: true,
                serverSide: true,
                order: [],
                ajax: "{{ route('nav-menu.index') }}",
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Handle delete button click
            $(document).on('click', '.delete-btn', function() {
                let testpackageId = $(this).data('id');

                // Show confirmation dialog
                if (confirm('Are you sure you want to delete this nav menu item?')) {
                    // Create a form dynamically
                    var form = $('<form>', {
                        action: "{{ route('nav-menu.destroy', '') }}" + '/' + testpackageId,
                        method: 'POST'
                    });

                    form.append('@csrf');
                    form.append('@method('DELETE')');

                    $('body').append(form);
                    form.submit();
                }
            });

        });
    </script>
@endsection
