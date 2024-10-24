@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Test Package</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Test Package</li>
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
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-12 col-sm-12">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" aria-labelledby="vert-tabs-profile-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Test Package</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
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
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form id="testpackageForm" action="{{ route('testpackages.store') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $testPackage->id ?? '' }}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                value="{{ $testPackage->title ?? '' }}"
                                                                placeholder="Enter Title">
                                                        </div>
                                                        <!-- Image Field -->
                                                        <div class="form-group">
                                                            <label>Image</label>
                                                            <div style="display: flex">
                                                                @if (isset($testPackage->image))
                                                                    <img src="{{ $testPackage->image }}"
                                                                        alt="{{ $testPackage->title }}" width="200"
                                                                        height="200">
                                                                @endif

                                                                <!-- Option to upload new image -->
                                                                <div class="col-sm-6"><input type="file" name="image"
                                                                        id="image">
                                                                    <p class="text-muted">Upload a new image if you want to
                                                                        replace the existing one.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="{{ $testPackage->price ?? '' }}"
                                                                placeholder="Enter Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control summernote" name="description" placeholder="Enter Description">{{ $testPackage->description ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('testpackages.index') }}'">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./col-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
