@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">FAQ's</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Faq's</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title">List Of Faq's</h3>
                  <a href="{{ route('faqs.create') }}" class="btn btn-sm btn-success ml-auto">
                  <i class="fas fa-plus"></i>
                  <span>Add FAQ</span>
                  </a>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
               </div>
               <section class="content">
                  <div class="row">
                     <div class="col-12" id="accordion">
                        @foreach ($faqs as $faq)
                        <div class="card card-primary card-outline">
                           <a class="d-block w-100" data-toggle="collapse"
                              href="#collapse{{ $loop->index }}">
                              <div class="card-header">
                                 <h4
                                    class="card-title w-100 d-flex justify-content-between align-items-center">
                                    <span>{{ $loop->index + 1 }}. {{ $faq->question }}</span>
                           <a href="{{ route('faqs.edit', $faq->id) }}"
                              class="btn btn-sm btn-info">
                           <i class="fas fa-pencil-alt"></i>
                           </a>
                           </h4>
                           </div>
                           </a>
                           <div id="collapse{{ $loop->index }}"
                              class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordion">
                              <div class="card-body">
                                 {{ $faq->answer }}
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
            </div>
            </section>
         </div>
      </div>
   </div>
   </div>
</section>
@endsection