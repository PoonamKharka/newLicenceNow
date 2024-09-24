<aside class="main-sidebar elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('images/icon.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> @include('admin.layouts.title') </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item menu-open">
          <a href="/admin-dashboard" class="nav-link {{ request()->is('admin-dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- Users -->
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript::void(0)" class="nav-link">
            <i class="nav-icon fas fa-map-marked-alt"></i>
            <p>
              Locations
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript::void(0)" class="nav-link">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Lessons
            </p>
          </a>
        </li>
        <!-- Instructors -->
        <li class="nav-item">
          <a href="{{ route('instructors.index') }}" class="nav-link {{ request()->is('instructors*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Instructors
            </p>
          </a>
        </li>
        <!-- Learners -->
        <li class="nav-item">
          <a href="{{ route('learners.index') }}" class="nav-link {{ request()->is('learners*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Learners
            </p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('aboutus*' , 'faqs*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('aboutus*' , 'faqs*') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Pages Content
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('aboutus.create') }}" class="nav-link {{ request()->is('aboutus*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('faqs.index') }}" class="nav-link {{ request()->is('faqs*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Support Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Policies
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="javascript:void(0);" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Privacy Policy</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payment Policy</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
