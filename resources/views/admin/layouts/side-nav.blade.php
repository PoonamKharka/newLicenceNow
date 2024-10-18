<aside class="main-sidebar elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('images/icon.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="d-block"> @include('admin.layouts.title') </span>
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
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin-dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- Users -->
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Total Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('location.index')  }}" class="nav-link {{ request()->is('admin/location*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-map-marked-alt"></i>
            <p>
              Service Locations
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('price.index') }}" class="nav-link {{ request()->is('admin/price*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
              Our Prices
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('lessons.index') }}" class="nav-link {{ request()->is('admin/lessons*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
            Providing Lessons
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('testpackages.index') }}" class="nav-link {{ request()->is('admin/testpackages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Test Packages 
            </p>
          </a>
        </li>
        <!-- Instructors -->
        <li class="nav-item">
          <a href="{{ route('instructor-request') }}" class="nav-link {{ request()->is('admin/instructor-request*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Instructors Request
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('instructors.index') }}" class="nav-link {{ request()->is('admin/instructors*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Our Instructors
            </p>
          </a>
        </li>
        
        <!-- Learners -->
        <li class="nav-item">
          <a href="{{ route('learners.index') }}" class="nav-link {{ request()->is('admin/learners*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Learners
            </p>
          </a>
        </li>
        <!-- Nav Menu -->
        <li class="nav-item">
          <a href="{{ route('nav-menu.index') }}" class="nav-link {{ request()->is('admin/nav-menu*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Nav Menu
            </p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('admin/aboutus*' , 'admin/faqs*' , 'admin/articles*', 'admin/features*','admin/learner-terms-and-condition*','admin/instructor-terms-and-condition*','admin/privacy-policy-articles*','admin/payment-policy-articles*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('admin/aboutus*' , 'admin/faqs*','admin/articles*','admin/features*','admin/learner-terms-and-condition*','admin/instructor-terms-and-condition*','admin/privacy-policy-articles*','admin/payment-policy-articles*') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Pages Content
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('aboutus.create') }}" class="nav-link {{ request()->is('admin/aboutus*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('faqs.index') }}" class="nav-link {{ request()->is('admin/faqs*') ? 'active' : '' }}">
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
            <li class="nav-item {{ request()->is('admin/articles*', 'admin/features*','admin/learner-terms-and-condition*','admin/instructor-terms-and-condition*','admin/privacy-policy-articles*','admin/payment-policy-articles*') ? 'menu-open' : '' }}">
              <a href="javascript:void(0)" class="nav-link {{ request()->is('admin/articles*','admin/features*','admin/learner-terms-and-condition*','admin/instructor-terms-and-condition*','admin/privacy-policy-articles*','admin/payment-policy-articles*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Articles
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('features.index') }}" class="nav-link {{ request()->is('admin/features*') ? 'active' : '' }}">
                    <i class="far {{ request()->is('admin/features*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                    <p>
                      Features
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('learner-terms-and-condition.index') }}" class="nav-link {{ request()->is('admin/learner-terms-and-condition*') ? 'active' : '' }}">
                    <i class="far {{ request()->is('admin/learner-terms-and-condition*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                    <p>
                      Learner Terms and Conditions
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('instructor-terms-and-condition.index') }}" class="nav-link {{ request()->is('admin/instructor-terms-and-condition*') ? 'active' : '' }}">
                    <i class="far {{ request()->is('admin/instructor-terms-and-condition*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                    <p>
                      Instructor Terms and Conditions
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('privacy-policy-articles.index') }}" class="nav-link {{ request()->is('admin/privacy-policy-articles*') ? 'active' : '' }}">
                    <i class="far {{ request()->is('admin/privacy-policy-articles*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                    <p>
                      Privacy Policy
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('payment-policy-articles.index') }}" class="nav-link {{ request()->is('admin/payment-policy-articles*') ? 'active' : '' }}">
                    <i class="far {{ request()->is('admin/payment-policy-articles*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                    <p>
                      Payment Policy
                    </p>
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
