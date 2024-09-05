@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">FAQ's</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Faqs</li>
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
                                        <h3 class="card-title">FAQ's</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $faqs->id ?? '' }}">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Question</label>
                                                        <input type="text" class="form-control" name="question"
                                                            value="{{ $faqs->question ?? '' }}" placeholder="Enter Question">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Answer</label>
                                                        <input type="text" class="form-control" name="answer"
                                                            value="{{ $faqs->answer ?? '' }}" placeholder="Enter Answer">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Submit</button>
                                                <button type="reset" class="btn btn-default" onclick="window.location='{{ route('faqs.index') }}'">Cancel</button>
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
