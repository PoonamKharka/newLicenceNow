


@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Locations</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Locations</li>
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
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Update Location</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" action="{{ route('location.update' , encrypt($locationData->id)) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Street</label>
                          <input type="text" class="form-control" placeholder="Enter Street" name="street" value="{{ $locationData->street }}">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>City</label>
                          <select class="form-control" name="city">
                            <option value="Sydney" {{ $locationData->city == "Sydney" ? 'selected' : '' }}>Sydney</option>
                            <option value="Melbourne" {{ $locationData->city == "Melbourne" ? 'selected' : '' }}>Melbourne</option>
                            <option value="Brisbane" {{ $locationData->city == "Brisbane" ? 'selected' : '' }}>Brisbane</option>
                            <option value="Perth" {{ $locationData->city == "Perth" ? 'selected' : '' }} >Perth</option>
                            <option value="Adelaide"{{ $locationData->city == "Adelaide" ? 'selected' : '' }} >Adelaide</option>
                            <option value="Hobart"{{ $locationData->city == "Hobart" ? 'selected' : '' }} >Hobart</option>
                            <option value="Canberra" {{ $locationData->city == "Canberra" ? 'selected' : '' }} >Canberra</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control" name="state">
                                  <option value="Queensland" {{ $locationData->state == "Queensland" ? 'selected' : '' }}>Queensland</option>
                                  <option value="Victoria" {{ $locationData->state == "Victoria" ? 'selected' : '' }}>Victoria</option>
                                  <option value="New South Wales" {{ $locationData->state == "New South Wales" ? 'selected' : '' }}>New South Wales</option>
                                  <option value="Western Australia" {{ $locationData->state == "Western Australia" ? 'selected' : '' }}>Western Australia</option>
                                  <option value="South Australia" {{ $locationData->state == "South Australia" ? 'selected' : '' }}>South Australia</option>
                                  <option value="Tasmania" {{ $locationData->state == "Tasmania" ? 'selected' : '' }}>Tasmania</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label>Postcode</label>
                            <input type="text" class="form-control" placeholder="Enter Postcode" name="postcode" value="{{ $locationData->postcode }}">
                            @error('postcode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info">Submit</button>
                      <button type="reset" class="btn btn-default" onclick="window.location='{{ route('location.index') }}'">Cancel</button>
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
