
@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Driving Lessons</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Driving Lessons</li>
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
                  <h3 class="card-title">Add Lessons</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
              <form id="lessons" action="{{ route('lessons.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control"  placeholder="Enter title" name="title">
                    @error('title')
                            <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter description" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                    <select class="custom-select" name="status">
                        <option value = 1  selected>Active</option>
                        <option value = 0>Inative</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Location</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="location_id[]">
                      @foreach ($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->street }} , {{ $loc->postcode }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Price</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="pricing_id[]">
                        @foreach ($prices as $price)
                          <option value="{{ $price->id }}">{{ $price->hours }}hrs  -  ${{ $price->price }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-default" onclick="window.location='{{ route('lessons.index') }}'">Cancel</button>
                </div>
              </form>
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>
@endsection
