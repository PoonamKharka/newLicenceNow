@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Learners Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Learners</li>
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
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill"
                                    href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                    aria-selected="true">Personal</a>
                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                    href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
                                    aria-selected="false">Payment History</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-profile" role="tabpanel"
                                    aria-labelledby="vert-tabs-profile-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Personal Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('learners.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="form_type" value="personal_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                value="{{ $userData->id }}" />
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $userData->name }}" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date Of Birth</label>
                                                            <div class="input-group date" id="dateOfBirth"
                                                                data-target-input="nearest">
                                                                @if ($userData->learnerProfileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="dob" data-target="#dateOfBirth"
                                                                        placeholder="Enter Date Of Birth"
                                                                        value="{{ $userData->learnerProfileDetails->dob }}" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="dob" data-target="#dateOfBirth"
                                                                        placeholder="Enter Date Of Birth" />
                                                                @endif
                                                                <div class="input-group-append" data-target="#dateOfBirth"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Course start date</label>
                                                            <div class="input-group date" id="courseStartDate"
                                                                data-target-input="nearest">
                                                                @if ($userData->learnerProfileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="csd" data-target="#courseStartDate"
                                                                        value="{{ $userData->learnerProfileDetails->csd }}"
                                                                        placeholder="Enter Start Date Of Course" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="csd" data-target="#dateOfBirth"
                                                                        placeholder="Enter Start Date Of Course" />
                                                                @endif
                                                                <div class="input-group-append"
                                                                    data-target="#courseStartDate"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Course end date</label>
                                                            <div class="input-group date" id="courseEndDate"
                                                                data-target-input="nearest">
                                                                @if ($userData->learnerProfileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="ced" data-target="#courseEndDate"
                                                                        value="{{ $userData->learnerProfileDetails->ced }}"
                                                                        placeholder="Enter End Date Of Course" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="ced" data-target="#courseEndDate"
                                                                        placeholder="Enter End Date Of Course" />
                                                                @endif
                                                                <div class="input-group-append"
                                                                    data-target="#courseEndDate"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            @if ($userData->learnerProfileDetails)
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="genderId">
                                                                    <option value="1"
                                                                        {{ $userData->learnerProfileDetails->gender_id == 1 ? 'selected' : '' }}>
                                                                        Female
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $userData->learnerProfileDetails->gender_id == 2 ? 'selected' : '' }}>
                                                                        Male
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $userData->learnerProfileDetails->gender_id == 3 ? 'selected' : '' }}>
                                                                        Others
                                                                    </option>
                                                                </select>
                                                            @else
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="genderId">
                                                                    <option selected="selected">Select a Gender</option>
                                                                    <option value="1">Female</option>
                                                                    <option value="2">Male</option>
                                                                    <option value="3">Others</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Learner Age</label>
                                                            @if ($userData->learnerProfileDetails)
                                                                <input type="text" class="form-control" name="age"
                                                                    value="{{ $userData->learnerProfileDetails->age }}">
                                                            @else
                                                                <input type="text" class="form-control" name="age"
                                                                    disabled>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Blood Group</label>
                                                            @if ($userData->learnerProfileDetails)
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="bloodGroupId">
                                                                    <option value="1"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 1 ? 'selected' : '' }}>
                                                                        O+
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 2 ? 'selected' : '' }}>
                                                                        A+
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 3 ? 'selected' : '' }}>
                                                                        B+
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 4 ? 'selected' : '' }}>
                                                                        AB+
                                                                    </option>
                                                                    <option value="5"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 5 ? 'selected' : '' }}>
                                                                        O-
                                                                    </option>
                                                                    <option value="6"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 6 ? 'selected' : '' }}>
                                                                        A-
                                                                    </option>
                                                                    <option value="7"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 7 ? 'selected' : '' }}>
                                                                        B-
                                                                    </option>
                                                                    <option value="8"
                                                                        {{ $userData->learnerProfileDetails->blood_group == 8 ? 'selected' : '' }}>
                                                                        AB-
                                                                    </option>
                                                                </select>
                                                            @else
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="bloodGroupId">
                                                                    <option selected="selected">Select a Blood Group
                                                                    </option>
                                                                    <option value="1">O+</option>
                                                                    <option value="2">A+</option>
                                                                    <option value="3">B+</option>
                                                                    <option value="4">AB+</option>
                                                                    <option value="5">O-</option>
                                                                    <option value="6">A-</option>
                                                                    <option value="7">B--</option>
                                                                    <option value="8">AB-</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Contact No</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">+61</span>
                                                            </div>
                                                            @if ($userData->learnerProfileDetails)
                                                                <input type="text" class="form-control"
                                                                    data-inputmask='"mask": "(999) 999-9999"' data-mask
                                                                    name="phoneNo"
                                                                    value="{{ $userData->learnerProfileDetails->phoneNo }}">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    data-inputmask='"mask": "(999) 999-9999"' data-mask
                                                                    name="phoneNo">
                                                            @endif

                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-phone"></i></span>
                                                            </div>
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- textarea -->
                                                        <div class="form-group">
                                                            <label>Corresponding Address</label>
                                                            @if ($userData->learnerProfileDetails)
                                                                <input type="text" class="form-control"
                                                                    name="correspondingAddress"
                                                                    value="{{ $userData->learnerProfileDetails->corresponding_address }}">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    name="correspondingAddress",
                                                                    placeholder="Enter Correspondence Address">
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Profile Picture</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="profilePicture">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
                                                        @if ($userData->learnerProfileDetails)
                                                            <div class="mt-2">
                                                                <img src="{{ asset($userData->learnerProfileDetails->profile_picture) }}"
                                                                    alt="Profile Picture" class="img-thumbnail"
                                                                    style="max-width: 150px;">

                                                                <p>Current Image</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                    aria-labelledby="vert-tabs-messages-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Payment History</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Lesson</th>
                                                    <th>Instructor</th>
                                                    <th>Lesson Start</th>
                                                    <th>Lesson End</th>
                                                    <th>Status</th>
                                                    <th>Payment Status</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>Automatic Driving Lesson</td>
                                                    <td>Karl Turnbull</td>
                                                    <td>01-09-2024</td>
                                                    <td>01-12-2024</td>
                                                    <td><span class="badge bg-warning">on-going</span></td>
                                                    <td>Partially</td>
                                                  </tr>
                                                  <tr>
                                                    <td>2</td>
                                                    <td>Manual Driving Lesson</td>
                                                    <td>Darik</td>
                                                    <td>01-03-2024</td>
                                                    <td>01-06-2024</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>Fully</td>
                                                  </tr>
                                                </tbody>
                                              </table>
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
    <!-- /.content -->
    <script>
        $(function() {
            //bsCustomFileInput.init();

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //courseStartDate
            $('#courseStartDate').datetimepicker({
                format: 'L'
            });

            //courseStartDate
            $('#dateOfBirth').datetimepicker({
                format: 'L'
            });

            $('#courseEndDate').datetimepicker({
                format: 'L'
            });

        });
    </script>
@endsection
