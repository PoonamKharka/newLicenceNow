@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Detail</li>
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
                                <a href="{{ route('users.show', encrypt($user->id)) }}"
                                    class="btn btn-block btn-sm btn-success"> Edit User </a>
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
                            <div class="container p-3">
                                <div class="card shadow-sm mb-4">

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                                                <p><strong>Email:</strong> <a
                                                        href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Phone:</strong> <a
                                                        href="tel:{{ $user->contact_no ?? 'N/A' }}">{{ $user->contact_no ?? 'N/A' }}</a>
                                                </p>
                                                <p><strong>Post Code:</strong> {{ $user->postcode ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Description:</strong> {{ $user->description ?? 'N/A' }}</p>
                                                <p><strong>Dob:</strong> {{ $user->dob ?? 'N/A' }}</p>

                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                @if ($user->profile_image)
                                                    <p><strong>Profile Picture:</strong>
                                                        <img src="{{ Storage::url($user->profile_image) }}"
                                                            alt="Attachment" class="img-fluid img-thumbnail mb-2"
                                                            style="max-height: 150px;">
                                                @endif
                                                </< /div>
                                            </div>
                                        </div>
                                    </div>

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
