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
                                    aria-selected="true">Profile</a>
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
                                                @method('post')
                                                <input type="hidden" name="form_type" value="personal_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="hidden" class="form-control" name="user_id"
                                                                value="{{ $users->id }}" />
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ $users->name }}" disabled />
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
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Date Of Joining</label>
                                                            <div class="input-group date" id="dateOfJoining"
                                                                data-target-input="nearest">
                                                                <input type="text"
                                                                    class="form-control datetimepicker-input" name="doj"
                                                                    data-target="#dateOfBirth"
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
                                                                name="gender_id">
                                                                <option selected="selected">Select a Gender</option>
                                                                <option value="1">Female</option>
                                                                <option value="2">Male</option>
                                                                <option value="3">Others</option>
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
                                                                name="phoneNo">
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
                                                            <label for="blood_group">Blood Group:</label>
                                                            <input type="text" class="form-control" id="blood_group"
                                                                name="blood_group" placeholder="Enter blood group">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Total Driving Expirence</label>
                                                            <input type="number" class="form-control"
                                                                name="driving_expirence"
                                                                placeholder="Enter Your Total Expirence in Driving">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- textarea -->
                                                        <div class="form-group">
                                                            <label>Correspondence Address</label>
                                                            <textarea class="form-control" rows="3" name="contact_address" placeholder="Enter Correspondence Address"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Profile Picture</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="exampleInputFile" name="picture">
                                                                <label class="custom-file-label"
                                                                    for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Upload</span>
                                                            </div>
                                                        </div>
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
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Bank Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{ route('instructors.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="form_type" value="bank_details">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Nominee</label>
                                                            <input type="hidden" class="form-control" name="user_id" value="{{ $users->id }}" />
                                                            <input type="text" class="form-control" name="name" value="{{ $users->name }}" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryPayMode">Salary Pay Mode</label>
                                                            <input type="text" class="form-control" id="salaryPayMode" name="salaryPayMode"
                                                                placeholder="Enter salary Pay Mode">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBankName">Salary Bank Name</label>
                                                            <input type="text" class="form-control" id="salaryBankName" name="salaryBankName"
                                                                placeholder="Enter Salary Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryBranchName">Salary Branch Name</label>
                                                            <input type="text" class="form-control" id="salaryBranchName" name="salaryBranchName"
                                                                placeholder="Enter Salary Branch Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryIFSCCode">Salary IFSC Code</label>
                                                            <input type="text" class="form-control" id="salaryIFSCCode" name="salaryIFSCCode"
                                                                placeholder="Enter Salary IFSC Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="salaryAccountNumber">Salary Account Number</label>
                                                            <input type="text" class="form-control" id="salaryAccountNumber" name="salaryAccountNumber"
                                                                placeholder="Enter Salary Account Number">
                                                        </div>
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
