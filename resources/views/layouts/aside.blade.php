<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->segment(1) == '' ? 'active':'' }} ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('company.index') }}" class="nav-link {{ request()->segment(1) == 'company' ? 'active':'' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Company
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employee.index') }}" class="nav-link {{ request()->segment(1) == 'employee' ? 'active':'' }}">
              <i class="nav-icon fas fa-hospital-user"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('quote.index') }}" class="nav-link {{ request()->segment(1) == 'quotes' ? 'active':'' }}">
              <i class="nav-icon fas fa-hospital-user"></i>
              <p>
                Daily Quotes
              </p>
            </a>
          </li>
          <form id="myform" method="POST" action="{{ route('logout') }}">
            @csrf
            </form>
          <li class="nav-item">
            <a href="#" onclick="event.preventDefault(); document.getElementById('myform').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              Logout
            </a>
          </li>
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
