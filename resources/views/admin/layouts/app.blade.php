<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed" style="background-image: url('{{ asset('images/banner.png') }}')">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.top-nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.layouts.side-nav')

  <!-- Content Wrapper. Contains page content -->qqqqi         xz
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->
</body>
@yield('script')
</html>
