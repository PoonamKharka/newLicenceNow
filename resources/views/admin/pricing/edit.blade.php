@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pricing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pricing</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row mx-auto">
                <div class="col-sm-12">
                    <!-- general form elements disabled -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Modify Pricing</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="price-form" method="POST"
                                action="{{ route('price.update', encrypt($priceData->id)) }}" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Hours</label>
                                            <input type="number" class="form-control" name="hours"
                                                value="{{ $priceData->hours }}">
                                            @error('hours')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Price (in Dollar)</label>
                                            <input type="number" class="form-control" name="price" step="any"
                                                value="{{ $priceData->price }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default"
                                        onclick="window.location='{{ route('price.index') }}'">Cancel</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- general form elements disabled -->
                </div>
                <!-- /.col-12-->
            </div>
            <!-- /.raw -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
