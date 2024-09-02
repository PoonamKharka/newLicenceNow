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
                                    aria-selected="false">Bank</a>
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
                                            <form action="{{ route('instructors.store') }}" method="POST"
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
                                                                @if ($userData->profileDetails)
                                                                    <input type="text"
                                                                        class="form-control datetimepicker-input" name="dob"
                                                                        data-target="#dateOfBirth"
                                                                        placeholder="Enter Date Of Birth" value="{{ $userData->profileDetails->dob }}"/>
                                                                @else
                                                                    <input type="text"
                                                                    class="form-control datetimepicker-input" name="dob"
                                                                    data-target="#dateOfBirth"
                                                                    placeholder="Enter Date Of Birth"/>
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
                                                            <label>Date Of Joining</label>
                                                            <div class="input-group date" id="dateOfJoining"
                                                                data-target-input="nearest">
                                                                @if ($userData->profileDetails)
                                                                    <input type="text"
                                                                    class="form-control datetimepicker-input" name="doj"
                                                                    data-target="#dateOfJoining"
                                                                    value="{{ $userData->profileDetails->doj }}"
                                                                    placeholder="Enter Date Of Joining" />
                                                                @else
                                                                    <input type="text"
                                                                    class="form-control datetimepicker-input" name="doj"
                                                                    data-target="#dateOfBirth"
                                                                    placeholder="Enter Date Of Joining" /> 
                                                                @endif
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
                                                            @if ($userData->profileDetails)
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
                                                        <label>Contact No</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">+61</span>
                                                            </div>
                                                            @if ($userData->profileDetails)
                                                                <input type="text" class="form-control"
                                                                data-inputmask='"mask": "(999) 999-9999"' data-mask
                                                                name="phoneNo" value="{{ $userData->profileDetails->phoneNo }}">  
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
                                                            @if ($userData->profileDetails)
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
                                                            @else
                                                                <select class="form-control select2" style="width: 100%;"
                                                                name="bloodGroupId">
                                                                    <option selected="selected">Select a Blood Group</option>
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
                                                        <div class="form-group">
                                                            <label>Total Driving Expirence</label>
                                                            @if ( $userData->profileDetails )
                                                                <input type="text" class="form-control"
                                                                name="drivingExpirence"
                                                                value="{{ $userData->profileDetails->driving_expirence }}">
                                                            @else
                                                                <input type="text" class="form-control" name="drivingExpirence" placeholder="Enter Your Total Expirence in Driving">
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
                                                                <input type="text" class="form-control" name="contactAddress" value="{{$userData->profileDetails->contact_address  }}"> 
                                                            @else
                                                                <input type="text" class="form-control" name="contactAddress", placeholder="Enter Correspondence Address">
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{-- <label for="exampleInputFile">Profile Picture</label> --}}
                                                        {{-- <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="picture">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="input-group">
                                                            <div class="custom-file">
                                                              <input type="file" class="custom-file-input" id="exampleInputFile">
                                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                              <span class="input-group-text">Upload</span>
                                                            </div>
                                                          </div>
                                                        @if ($userData->profileDetails)
                                                            <div class="mb-3">
                                                                <img src="{{ asset($userData->profileDetails->picture) }}"
                                                                    alt="Profile Picture" class="img-thumbnail"
                                                                    style="max-width: 150px;">
                                                            </div>
                                                        @else
                                                            <p>No profile picture available.</p>
                                                        @endif --}}

                                                        <div class="form-group">
                                                            <label for="profilePic">File input</label>
                                                            <div class="input-group">
                                                              <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="profilePic">
                                                                <label class="custom-file-label" for="profilePic">Choose file</label>
                                                              </div>
                                                              <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                    <button type="reset" class="btn btn-default" onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
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
                                            <h3 class="card-title">Bank Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST"
                                                enctype="multipart/form-data">
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
                                                                    <option selected="selected">Select a Salary Mode</option>
                                                                    <option value="1">Direct Deposit ( EFT/NEFT )</option>
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
                                                                id="salaryBankName" name="salaryBankName"
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
                                                    <button type="reset" class="btn btn-default" onclick="window.location='{{ route('instructors.index') }}'">Cancel</button>
                                                </div>
                                                <!-- /.card-footer -->
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
    <!-- /.content -->
    <script>
        $(function() {
            //bsCustomFileInput.init();

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
@endsection
