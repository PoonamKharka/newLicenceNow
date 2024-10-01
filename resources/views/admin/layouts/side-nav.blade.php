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
          <a href="{{ route('location.index')  }}" class="nav-link {{ request()->is('location*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-map-marked-alt"></i>
            <p>
              Locations
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('price.index') }}" class="nav-link {{ request()->is('price*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
              Pricing
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('lessons.index') }}" class="nav-link {{ request()->is('lessons*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Lessons
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('testpackages.index') }}" class="nav-link {{ request()->is('testpackages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-reader"></i>
            <p>
              Test Packages 
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
        <li class="nav-item {{ request()->is('articles*', 'features*','learner-terms-and-condition*','instructor-terms-and-condition*','privacy-policy-articles*','payment-policy-articles*') ? 'menu-open' : '' }}">
          <a href="javascript:void(0)" class="nav-link {{ request()->is('articles*','features*','learner-terms-and-condition*','instructor-terms-and-condition*','privacy-policy-articles*','payment-policy-articles*') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Articles
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            {{-- <li class="nav-item">
              <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.index') ? 'active' : '' }}">
                <i class="far {{ request()->routeIs('articles.index') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>Articles</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('features.index') }}" class="nav-link {{ request()->is('features*') ? 'active' : '' }}">
                <i class="far {{ request()->is('features*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>
                  Features
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('learner-terms-and-condition.index') }}" class="nav-link {{ request()->is('learner-terms-and-condition*') ? 'active' : '' }}">
                <i class="far {{ request()->is('learner-terms-and-condition*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>
                  Learner Terms and Conditions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('instructor-terms-and-condition.index') }}" class="nav-link {{ request()->is('instructor-terms-and-condition*') ? 'active' : '' }}">
                <i class="far {{ request()->is('instructor-terms-and-condition*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>
                  Instructor Terms and Conditions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('privacy-policy-articles.index') }}" class="nav-link {{ request()->is('privacy-policy-articles*') ? 'active' : '' }}">
                <i class="far {{ request()->is('privacy-policy-articles*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>
                  Privacy Policy
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('payment-policy-articles.index') }}" class="nav-link {{ request()->is('payment-policy-articles*') ? 'active' : '' }}">
                <i class="far {{ request()->is('payment-policy-articles*') ? 'fa-check-circle' : 'fa-circle' }}  nav-icon"></i>
                <p>
                  Payment Policy
                </p>
              </a>
            </li>
          </ul>
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
