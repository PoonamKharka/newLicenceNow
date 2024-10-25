@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Test Package</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Test Package</li>
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
                            <h3 class="card-title">List of All Test Packages</h3>
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
                            <button type="submit" class="btn btn-success"><a href="{{ route('testpackages.create') }}"
                                    style="text-decoration: none; color:aliceblue">Add More</a></button>
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
        $(document).ready(function() {
            $('#y_dataTables').DataTable({
                processing: true,
                serverSide: true,
                order: [],
                ajax: "{{ route('testpackages.index') }}",
                columns: [{
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
                if (confirm('Are you sure you want to delete this test package?')) {
                    // Create a form dynamically
                    var form = $('<form>', {
                        action: "{{ route('testpackages.destroy', '') }}" + '/' + testpackageId,
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
