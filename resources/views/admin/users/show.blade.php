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
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="user-update" method="POST"
                                action="{{ route('users.update', encrypt($userData->id)) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name"
                                        value="{{ $userData->first_name }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name"
                                        value="{{ $userData->last_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" class="form-control" name="email"
                                        value="{{ $userData->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Status</label>
                                    <select class="form-control" name="status">
                                        <option value=1 {{ $userData->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value=0 {{ $userData->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_image">
                                            @error('profile_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">

                                        <!-- Show existing image if editing -->
                                        @if (!empty($userData->profile_image))
                                            <div class="form-group">
                                                <label>Current Profile Picture</label>
                                                <div>
                                                    <img src="{{ $userData->profile_image }}"
                                                        alt="Profile Image" width="100">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                    <button type="reset" class="btn btn-default"
                                        onclick="window.location='{{ route('users.index') }}'">Cancel</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                            <!-- /form -->
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
