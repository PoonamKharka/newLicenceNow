@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Instructors Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Instructors</li>
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
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill"
                                    href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                    aria-selected="true">Profile</a>
                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                    href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
                                    aria-selected="false">Bank</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <!-- Profile Tab -->
                                <div class="tab-pane text-left fade show active" id="vert-tabs-profile" role="tabpanel"
                                    aria-labelledby="vert-tabs-profile-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Personal Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.update', $userData->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="form_type" value="personal_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
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
                                                                <input type="text"
                                                                    class="form-control datetimepicker-input" name="dob"
                                                                    data-target="#dateOfBirth"
                                                                    value="{{ $userData->profileDetails->dob }}"
                                                                    placeholder="Enter Date Of Birth" />
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
                                                            <label>Date Of Joining</label>
                                                            <div class="input-group date" id="dateOfJoining"
                                                                data-target-input="nearest">
                                                                <input type="text"
                                                                    class="form-control datetimepicker-input" name="doj"
                                                                    data-target="#dateOfJoining"
                                                                    value="{{ $userData->profileDetails->doj }}"
                                                                    placeholder="Enter Date Of Joining" />
                                                                <div class="input-group-append" data-target="#dateOfJoining"
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
                                                                <input type="text"
                                                                    class="form-control datetimepicker-input"
                                                                    name="dot" data-target="#dateOfResignation"
                                                                    value="{{ $userData->profileDetails->dot }}"
                                                                    placeholder="Enter Date Of Resignation" />
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
                                                            <select class="form-control select2" style="width: 100%;"
                                                                name="genderId">
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
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label>Contact No</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">+61</span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                data-inputmask='"mask": "(999) 999-9999"' data-mask
                                                                name="phoneNo"
                                                                value="{{ $userData->profileDetails->phoneNo }}">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-phone"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Blood Group</label>
                                                            <select class="form-control select2" style="width: 100%;"
                                                                name="bloodGroupId">
                                                                <option value="1"
                                                                    {{ $userData->profileDetails->blood_group == 1 ? 'selected' : '' }}>
                                                                    O+
                                                                </option>
                                                                <option value="2"
                                                                    {{ $userData->profileDetails->blood_group == 2 ? 'selected' : '' }}>
                                                                    A+
                                                                </option>
                                                                <option value="3"
                                                                    {{ $userData->profileDetails->blood_group == 3 ? 'selected' : '' }}>
                                                                    B+
                                                                </option>
                                                                <option value="4"
                                                                    {{ $userData->profileDetails->blood_group == 4 ? 'selected' : '' }}>
                                                                    AB+
                                                                </option>
                                                                <option value="5"
                                                                    {{ $userData->profileDetails->blood_group == 5 ? 'selected' : '' }}>
                                                                    O-
                                                                </option>
                                                                <option value="6"
                                                                    {{ $userData->profileDetails->blood_group == 6 ? 'selected' : '' }}>
                                                                    A-
                                                                </option>
                                                                <option value="7"
                                                                    {{ $userData->profileDetails->blood_group == 7 ? 'selected' : '' }}>
                                                                    B-
                                                                </option>
                                                                <option value="8"
                                                                    {{ $userData->profileDetails->blood_group == 8 ? 'selected' : '' }}>
                                                                    AB-
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="drivingExpirence">Driving Experience</label>
                                                            <input type="number" class="form-control"
                                                                id="drivingExpirence" name="drivingExpirence"
                                                                placeholder="Enter Your Total Experience in Driving"
                                                                value="{{ $userData->profileDetails->driving_expirence }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- textarea -->
                                                        <div class="form-group">
                                                            <label>Correspondence Address</label>
                                                            <textarea class="form-control" rows="3" name="contactAddress" placeholder="Enter Correspondence Address">{{ $userData->profileDetails->contact_address }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="state">State</label>
                                                            <input type="text" class="form-control" id="state"
                                                                name="state" placeholder="Enter State"
                                                                value="{{ $userData->profileDetails->state }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="postalCode">Postal Code</label>
                                                            <input type="text" class="form-control" id="postalCode"
                                                                name="postalCode" placeholder="Enter Postal Code"
                                                                value="{{ $userData->profileDetails->postal_code }}">
                                                        </div>
                                                    </div>

                                                    <!-- Assuming you have the $instructorProfileDetail variable -->
                                                    <div class="col-sm-6">
                                                        <label>Profile Picture</label>
                                                        <!-- File upload field -->
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="picture">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">{{ basename($userData->profileDetails->picture) }}</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>

                                                        </div>
                                                        @if ($userData->profileDetails->picture)
                                                            <div class="mb-3">
                                                                <img src="{{ asset($userData->profileDetails->picture) }}"
                                                                    alt="Profile Picture" class="img-thumbnail"
                                                                    style="max-width: 150px;">
                                                            </div>
                                                        @else
                                                            <p>No profile picture available.</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                    <a href="{{ route('instructors.index') }}"
                                                        class="btn btn-default">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bank Tab -->
                                <div class="tab-pane text-left fade" id="vert-tabs-messages" role="tabpanel"
                                    aria-labelledby="vert-tabs-messages-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Bank Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.update', $userData->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Assuming you are using the PUT method for update -->
                                                <input type="hidden" name="form_type" value="bank_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- Text input -->
                                                        <div class="form-group">
                                                            <label>Nominee</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $userData->name }}" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Salary Pay Mode</label>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBankName">Salary Bank Name</label>
                                                            <input type="text" class="form-control"
                                                                id="salaryBankName" name="salaryBankName"
                                                                value="{{ $userData->bankDetails->salary_bank_name }}"
                                                                placeholder="Enter Salary Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBranchName">Salary Branch Name</label>
                                                            <input type="text" class="form-control"
                                                                id="salaryBranchName" name="salaryBranchName"
                                                                value="{{ $userData->bankDetails->salary_branch_name }}"
                                                                placeholder="Enter Salary Branch Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryIFSCCode">Salary IFSC Code</label>
                                                            <input type="text" class="form-control"
                                                                id="salaryIFSCCode" name="salaryIFSCCode"
                                                                value="{{ $userData->bankDetails->salary_ifsc_code }}"
                                                                placeholder="Enter Salary IFSC Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryAccountNumber">Salary Account Number</label>
                                                            <input type="text" class="form-control"
                                                                id="salaryAccountNumber" name="salaryAccountNumber"
                                                                value="{{ $userData->bankDetails->salary_account_number }}"
                                                                placeholder="Enter Salary Account Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="state">State</label>
                                                            <input type="text" class="form-control" id="state"
                                                                name="state"
                                                                value="{{ $userData->bankDetails->state }}"
                                                                placeholder="Enter State">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="postalCode">Postal Code</label>
                                                            <input type="text" class="form-control" id="postalCode"
                                                                name="postalCode"
                                                                value="{{ $userData->bankDetails->postal_code }}"
                                                                placeholder="Enter Postal Code">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                    <a href="{{ route('instructors.index') }}"
                                                        class="btn btn-default">Cancel</a>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Bank Tab -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <script>
        $(function() {
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
    </script>
    <!-- /.content -->
@endsection
