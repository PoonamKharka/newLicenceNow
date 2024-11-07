@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($userData)
                        <h1 class="m-0">Instructors Details: {{ $userData->first_name . ' ' . $userData->last_name }}</h1>
                    @else
                        <h1 class="m-0">Instructors Details</h1>
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Instructors</li>
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
                                <a class="nav-link" id="vert-tabs-vehicle-tab" data-toggle="pill" href="#vert-tabs-vehicle"
                                    role="tab" aria-controls="vert-tabs-vehicle" aria-selected="false">Vehicle</a>
                                <a class="nav-link" id="vert-tabs-suburbs-tab" data-toggle="pill" href="#vert-tabs-suburbs"
                                    role="tab" aria-controls="vert-tabs-suburbs" aria-selected="false">Suburbs</a>
                                <a class="nav-link" id="vert-tabs-bank-tab" data-toggle="pill" href="#vert-tabs-bank"
                                    role="tab" aria-controls="vert-tabs-bank" aria-selected="false">Bank</a>
                                <a class="nav-link" id="vert-tabs-price-tab" data-toggle="pill" href="#vert-tabs-price"
                                    role="tab" aria-controls="vert-tabs-price" aria-selected="false">Prices</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                {{-- profile starts --}}
                                <div class="tab-pane text-left fade show active" id="vert-tabs-profile" role="tabpanel"
                                    aria-labelledby="vert-tabs-profile-tab">
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
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Personal Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">

                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="personal_details">
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
                                                                value="{{ $userData->first_name . ' ' . $userData->last_name }}"
                                                                disabled />

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date Of Birth</label>
                                                            <div class="input-group date" id="dateOfBirth"
                                                                data-target-input="nearest">
                                                                @if ($userData->profileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_birth" data-target="#dateOfBirth"
                                                                        placeholder="Enter Date Of Birth"
                                                                        value="{{ Carbon\Carbon::parse($userData->profileDetails->date_of_birth)->format('d/m/Y') }}" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_birth" data-target="#dateOfBirth"
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
                                                        <div class="form-group">
                                                            <label>Transmission</label>
                                                            <div class="form-check">
                                                                @if ($userData->profileDetails)
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="text" name="isAuto" value=true
                                                                        {{ $userData->profileDetails->isAuto == 1 ? 'checked' : '' }}>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox"
                                                                        checked id="text" name="isAuto" value=true>
                                                                @endif

                                                                <label class="form-check-label">Automatic</label>
                                                            </div>
                                                            <div class="form-check">
                                                                @if ($userData->profileDetails)
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="text" name="isManual" value=true
                                                                        {{ $userData->profileDetails->isManual == 1 ? 'checked' : '' }}>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="text" name="isManual" value=true>
                                                                @endif

                                                                <label class="form-check-label">Manual</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Spoken Languages</label>
                                                            <div class="form-check">
                                                                @if ($userData->profileDetails && strpos($userData->profileDetails->languages, 'English') !== false)
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="English" checked>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="English">
                                                                @endif
                                                                <label class="form-check-label">English</label>
                                                            </div>
                                                            <div class="form-check">
                                                                @if ($userData->profileDetails && strpos($userData->profileDetails->languages, 'Mandarin') !== false)
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="Mandarin" checked>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="Mandarin">
                                                                @endif

                                                                <label class="form-check-label">Mandarin</label>
                                                            </div>
                                                            <div class="form-check">
                                                                @if ($userData->profileDetails && strpos($userData->profileDetails->languages, 'Italian') !== false)
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="Italian" checked>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="languages[]" value="Italian">
                                                                @endif

                                                                <label class="form-check-label">Italian</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Date Of Joining</label>
                                                            <div class="input-group date" id="dateOfJoining"
                                                                data-target-input="nearest">
                                                                @if ($userData->profileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_joining"
                                                                        data-target="#dateOfJoining"
                                                                        value="{{ Carbon\Carbon::parse($userData->profileDetails->date_of_joining)->format('d/m/Y') }}"
                                                                        placeholder="Enter Date Of Joining" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_joining" data-target="#dateOfBirth"
                                                                        placeholder="Enter Date Of Joining" />
                                                                @endif
                                                                <div class="input-group-append"
                                                                    data-target="#dateOfJoining"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date Of Resignation</label>
                                                            <div class="input-group date" id="dateOfResignation"
                                                                data-target-input="nearest">
                                                                @if ($userData->profileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_termination"
                                                                        data-target="#dateOfResignation"
                                                                        value="{{ Carbon\Carbon::parse($userData->profileDetails->date_of_termination)->format('d/m/Y') }}"
                                                                        placeholder="Enter Date Of Resignation" />
                                                                @else
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input"
                                                                        name="date_of_termination"
                                                                        data-target="#dateOfResignation"
                                                                        placeholder="Enter Date Of Resignation" />
                                                                @endif
                                                                <div class="input-group-append"
                                                                    data-target="#dateOfResignation"
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
                                                            @if ($userData->profileDetails)
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="gender_id">
                                                                    <option value="1"
                                                                        {{ $userData->profileDetails->gender_id == 1 ? 'selected' : '' }}>
                                                                        Female
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $userData->profileDetails->gender_id == 2 ? 'selected' : '' }}>
                                                                        Male
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $userData->profileDetails->gender_id == 3 ? 'selected' : '' }}>
                                                                        Others
                                                                    </option>
                                                                </select>
                                                            @else
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="gender_id">
                                                                    <option selected="selected" value="">Select a
                                                                        Gender</option>
                                                                    <option value="1">Female</option>
                                                                    <option value="2">Male</option>
                                                                    <option value="3">Others</option>
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
                                                            <input type="hidden" name="existing_phoneNo"
                                                                value="{{ $userData->profileDetails->phoneNo ?? '' }}">

                                                            @if ($userData->profileDetails)
                                                                <input type="text" class="form-control"
                                                                    data-inputmask='"mask": "(999) 999-9999"' data-mask
                                                                    name="phoneNo"
                                                                    value="{{ $userData->profileDetails->phoneNo }}">
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
                                                        <div class="form-group">
                                                            <label>Blood Group</label>
                                                            <select class="form-control select2" style="width: 100%;"
                                                                name="blood_group_id">
                                                                @if ($userData->profileDetails)
                                                                    <option value="1"
                                                                        {{ $userData->profileDetails->blood_group_id == 1 ? 'selected' : '' }}>
                                                                        O+
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $userData->profileDetails->blood_group_id == 2 ? 'selected' : '' }}>
                                                                        A+
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $userData->profileDetails->blood_group_id == 3 ? 'selected' : '' }}>
                                                                        B+
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $userData->profileDetails->blood_group_id == 4 ? 'selected' : '' }}>
                                                                        AB+
                                                                    </option>
                                                                    <option value="5"
                                                                        {{ $userData->profileDetails->blood_group_id == 5 ? 'selected' : '' }}>
                                                                        O-
                                                                    </option>
                                                                    <option value="6"
                                                                        {{ $userData->profileDetails->blood_group_id == 6 ? 'selected' : '' }}>
                                                                        A-
                                                                    </option>
                                                                    <option value="7"
                                                                        {{ $userData->profileDetails->blood_group_id == 7 ? 'selected' : '' }}>
                                                                        B-
                                                                    </option>
                                                                    <option value="8"
                                                                        {{ $userData->profileDetails->blood_group_id == 8 ? 'selected' : '' }}>
                                                                        AB-
                                                                    </option>
                                                                @else
                                                                    <option selected="selected" value="">Select a
                                                                        Blood Group
                                                                    </option>
                                                                    <option value="1">O+</option>
                                                                    <option value="2">A+</option>
                                                                    <option value="3">B+</option>
                                                                    <option value="4">AB+</option>
                                                                    <option value="5">O-</option>
                                                                    <option value="6">A-</option>
                                                                    <option value="7">B--</option>
                                                                    <option value="8">AB-</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Total Driving Experience (in Years)</label>
                                                            @if ($userData->profileDetails)
                                                                <input type="number" class="form-control"
                                                                    name="driving_expirence"
                                                                    value="{{ $userData->profileDetails->driving_expirence }}">
                                                            @else
                                                                <input type="number" class="form-control"
                                                                    name="driving_expirence"
                                                                    placeholder="Enter Your Total Expirence in Driving">
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- textarea -->
                                                        <div class="form-group">
                                                            <label>Present Address</label>
                                                            @if ($userData->profileDetails)
                                                                {{-- <input type="textarea" class="form-control"> --}}
                                                                <textarea class="form-control" rows="3" name="contact_address">
                                                                    {{ $userData->profileDetails->contact_address }}
                                                                </textarea>
                                                            @else
                                                                {{-- <input type="textarea" class="form-control" name="contactAddress"> --}}
                                                                <textarea class="form-control" rows="3" name="contact_address" placeholder="Enter Your Present Address"></textarea>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Profile Picture</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="existing_profile_picture"
                                                                    value="{{ $userData->profileDetails->profile_picture ?? '' }}">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="profile_picture">
                                                                @if ($userData->profileDetails && $userData->profileDetails->profile_picture)
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">{{ $userData->profileDetails->profile_picture }}</label>
                                                                @else
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">Choose file</label>
                                                                @endif

                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
                                                        @if ($userData->profileDetails && $userData->profileDetails->profile_picture)
                                                            <div class="mt-2">
                                                                <img src="{{ $userData->profileDetails->profile_picture }}"
                                                                    alt="Profile Picture" class="img-thumbnail"
                                                                    style="max-width: 150px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                {{-- profile ends --}}
                                {{-- vehicle starts --}}
                                <div class="tab-pane fade" id="vert-tabs-vehicle" role="tabpanel"
                                    aria-labelledby="vert-tabs-vehicle-tab">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Vehicle Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="vehicle_details">
                                                @csrf
                                                <input type="hidden" name="form_type" value="vehicle_details">
                                                <input type="hidden" class="form-control" name="instructor_id"
                                                    value="{{ $userData->id }}" />
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Vehicle Brand/Name</label>
                                                            @if ($userData->instructorVehicle)
                                                                <input type="text" class="form-control"
                                                                    name="vehicle_name" placeholder="Vehicle brand/name"
                                                                    value="{{ $userData->instructorVehicle->vehicle_name }}" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    name="vehicle_name"
                                                                    placeholder="Vehicle brand/name" />
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Vehicle Number</label>
                                                            @if ($userData->instructorVehicle)
                                                                <input type="text" class="form-control"
                                                                    name="vehicle_no" placeholder="Vehicle Number"
                                                                    value="{{ $userData->instructorVehicle->vehicle_no }}" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    name="vehicle_no" placeholder="Vehicle Number" />
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBankName">ANCAP Rating</label>
                                                            @if ($userData->instructorVehicle)
                                                                <input type="number" class="form-control"
                                                                    name="ancap_rating" placeholder="ANCAP Rating"
                                                                    min="1" max="5"
                                                                    value="{{ $userData->instructorVehicle->ancap_rating }}">
                                                            @else
                                                                <input type="number" class="form-control"
                                                                    name="ancap_rating" placeholder="ANCAP Rating"
                                                                    min="1" max="5">
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Vehicle Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="hidden" name="existing_vehicle_image"
                                                                    value="{{ $userData->instructorVehicle->vehicle_image ?? '' }}">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="vehicle_image">

                                                                @if ($userData->instructorVehicle)
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">{{ $userData->instructorVehicle->vehicle_image }}</label>
                                                                @else
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">Choose file</label>
                                                                @endif

                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
                                                        @if ($userData->instructorVehicle && $userData->instructorVehicle->vehicle_image)
                                                            <div class="mt-2">
                                                                <img src="{{ $userData->instructorVehicle->vehicle_image }}"
                                                                    alt="vehicleImg" class="img-thumbnail"
                                                                    style="max-width: 150px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                {{-- vehicle ends --}}
                                {{-- suburbs starts --}}
                                <div class="tab-pane fade" id="vert-tabs-suburbs" role="tabpanel"
                                    aria-labelledby="vert-tabs-suburbs-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Suburbs Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="suburbs_details">
                                                @csrf
                                                <input type="hidden" name="form_type" value="suburbs_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Select Suburbs</label>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                value="{{ $userData->id }}" />
                                                            <select id="location_ids" class="select2" multiple="multiple"
                                                                data-placeholder="Select a Location" style="width: 100%;"
                                                                name="location_id[]">


                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                {{-- suburbs ends --}}
                                {{-- bank starts --}}
                                <div class="tab-pane fade" id="vert-tabs-bank" role="tabpanel"
                                    aria-labelledby="vert-tabs-bank-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Bank Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="bank_details">
                                                @csrf
                                                <input type="hidden" name="form_type" value="bank_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Account Holder</label>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                value="{{ $userData->id }}" />
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $userData->name }}" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Salary Pay Mode</label>
                                                            @if ($userData->bankDetails)
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="salaryPayModeId">
                                                                    <option value="" disabled>Select a Salary Mode
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 1 ? 'selected' : '' }}>
                                                                        Direct Deposit ( EFT/NEFT )</option>
                                                                    <option value="2"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 2 ? 'selected' : '' }}>
                                                                        Cheque</option>
                                                                    <option value="3"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 3 ? 'selected' : '' }}>
                                                                        Cash</option>
                                                                    <option value="4"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 4 ? 'selected' : '' }}>
                                                                        Payroll Cards</option>
                                                                    <option value="5"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 5 ? 'selected' : '' }}>
                                                                        Superannuation Contributions</option>
                                                                    <option value="6"
                                                                        {{ $userData->bankDetails->salary_pay_mode_id == 6 ? 'selected' : '' }}>
                                                                        BPAY</option>
                                                                </select>
                                                            @else
                                                                <select class="form-control select2" style="width: 100%;"
                                                                    name="salaryPayModeId">
                                                                    <option selected="selected">Select a Salary Mode
                                                                    </option>
                                                                    <option value="1">Direct Deposit ( EFT/NEFT )
                                                                    </option>
                                                                    <option value="2">Cheque</option>
                                                                    <option value="3">Cash</option>
                                                                    <option value="4">Payroll Cards</option>
                                                                    <option value="5">Superannuation Contributions
                                                                    </option>
                                                                    <option value="6">BPAY</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBankName">Bank Name</label>
                                                            @if ($userData->bankDetails)
                                                                <input type="text" class="form-control"
                                                                    id="salaryBankName" name="salaryBankName"
                                                                    value="{{ $userData->bankDetails->salary_bank_name }}"
                                                                    placeholder="Enter Salary Bank Name">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    id="salaryBankName" name="salaryBankName"
                                                                    placeholder="Enter Salary Bank Name">
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBranchName">Branch</label>
                                                            @if ($userData->bankDetails)
                                                                <input type="text" class="form-control"
                                                                    id="salaryBranchName" name="salaryBranchName"
                                                                    value="{{ $userData->bankDetails->salary_branch_name }}"
                                                                    placeholder="Enter Salary Bank Name">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    id="salaryBranchName" name="salaryBranchName"
                                                                    placeholder="Enter Salary Branch Name">
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryIFSCCode">IFSC Code</label>
                                                            @if ($userData->bankDetails)
                                                                <input type="text" class="form-control"
                                                                    id="salaryIFSCCode" name="salaryIFSCCode"
                                                                    value="{{ $userData->bankDetails->salary_ifsc_code }}"
                                                                    placeholder="Enter Salary IFSC Code">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    id="salaryIFSCCode" name="salaryIFSCCode"
                                                                    placeholder="Enter Salary IFSC Code">
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryAccountNumber">Account Number</label>
                                                            @if ($userData->bankDetails)
                                                                <input type="text" class="form-control"
                                                                    id="salaryAccountNumber" name="salaryAccountNumber"
                                                                    value="{{ $userData->bankDetails->salary_account_number }}"
                                                                    placeholder="Enter Salary Account Number">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    id="salaryAccountNumber" name="salaryAccountNumber"
                                                                    placeholder="Enter Salary Account Number">
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                {{-- bank ends --}}

                                {{-- price starts --}}
                                <div class="tab-pane fade" id="vert-tabs-price" role="tabpanel"
                                    aria-labelledby="vert-tabs-price-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Price Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data" id="price_details">
                                                @csrf
                                                <input type="hidden" name="form_type" value="price_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Select Prices</label>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                value="{{ $userData->id }}" />
                                                            <select id="price_id" class="select2" multiple="multiple"
                                                                data-placeholder="Select a Price" style="width: 100%;"
                                                                name="price_id[]">
                                                                @if ($allPrices)
                                                                    @foreach ($allPrices as $price)
                                                                        <option value="{{ $price->id }}"
                                                                            @if (in_array($price->id, $selectedPriceIds)) selected @endif>
                                                                            {{ $price->hours . 'hours  - ' . $price->price . '$' }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default"
                                                        onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                {{-- price ends --}}



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
    <style>
        .select2-results__option.select2-results__option--disabled {
            color: #ccc;
            /* Change text color to indicate disabled */
            background-color: #f9f9f9;
            /* Light background */
            pointer-events: none;
            /* Prevent clicking */
        }
    </style>
    <script>
        $(function() {
            //bsCustomFileInput.init();
            //Initialize Select2 Elements
            //$('.select2').select2()
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //dateOfJoining
            $('#dateOfJoining').datetimepicker({
                format: 'L'
            });

            //dateOfJoining
            $('#dateOfBirth').datetimepicker({
                format: 'L'
            });

            $('#dateOfResignation').datetimepicker({
                format: 'L'
            });

        });
        $(document).ready(function() {
            $('#location_ids').select2({
                placeholder: "Select a Locations",
                minimumInputLength: 0,
                ajax: {
                    url: '/admin/locations/search',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(location) {
                                return {
                                    id: location.id,
                                    text: location.suburb + ' , ' + location.stateCode + ' ' +
                                        location.postcode
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Pre-select existing options
            let preSelectedOptions = {!! json_encode($selectedLocationIds) !!};

            preSelectedOptions.forEach(id => {
                $.ajax({
                    url: '/admin/locations/' + id,
                    method: 'GET',
                    success: function(location) {
                        // Append existing options
                        if ($('#location_ids').find(`option[value="${location.id}"]`).length ===
                            0) {
                            let option = new Option(location.suburb + ' , ' + location
                                .stateCode + ' ' + location.postcode, location.id, true,
                                true);
                            $('#location_ids').append(option).trigger(
                                'change'); // Add and trigger change
                        }
                    },
                    error: function() {
                        console.log(`Could not fetch location with ID ${id}`);
                    }
                });
            });

            // Form validation
            $("#suburbs_details").validate({
                rules: {
                    'location_id[]': {
                        required: true // This ensures the field is required
                    }
                },
                messages: {
                    'location_id[]': {
                        required: "Please select at least one suburb."
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Submit form if valid
                }
            });

            $('#location_ids').on('select2:select select2:unselect', function() {
                var selectedOptions = $('#location_ids').val();
                console.log("Currently selected options: ", selectedOptions);
                $("#suburbs_details").valid(); // Validate the form
            });
        });
    </script>

@endsection
