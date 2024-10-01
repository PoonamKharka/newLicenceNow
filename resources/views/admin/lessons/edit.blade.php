
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
                  <h3 class="card-title">Modify Lessons</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
              <form action="{{ route('lessons.update', encrypt($findData->id)) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control"  placeholder="Enter title" name="title" value="{{ $findData->title }}">
                    @error('title')
                            <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter description" name="description" value="{{ $findData->description }}"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Status</label>
                    <select class="custom-select" name="status">
                        <option value = 1  {{ $findData->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value = 0 {{ $findData->status == 0 ? 'selected' : '' }}>Inative</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Location</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="location_id[]">
                      @foreach ( $findData->lessonLocations as $item)
                        @foreach ($locations as $loc)
                            <option value="{{ $loc->id }}" {{ $loc->id == $item->locations->id ? 'selected' : '' }}>{{ $loc->street }} , {{ $loc->postcode }}</option>
                        @endforeach
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Price</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="pricing_id[]">
                        @foreach ( $findData->lessonPrice as $val)
                            @foreach ($prices as $price)
                            <option value="{{ $price->id }}" {{ $price->id == $val->prices->id ? 'selected' : '' }}>{{ $price->hours }}hrs  -  ${{ $price->price }}</option>
                            @endforeach
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
