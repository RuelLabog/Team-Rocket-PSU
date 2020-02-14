<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('home')}}" class="brand-link" style="padding-top: 8px !important;">
      <img src="images/trlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8; margin-top: 3px;">
      <span class="brand-text font-weight-bold" style="font-variant: small-caps; font-size: 25px; text-shadow: 2px 2px 4px maroon;">nms inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{url('profile')}}" class="d-block">
                <div class="image">
                <img src="images/{{ Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
                </div>

            {{auth()->user()->fname.' '.auth()->user()->lname}}
            </a>
        </div>

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('items')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Items
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('categories')}}" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Categories
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('receipt')}}" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Receipt
              </p>
            </a>
          </li>
          @if(auth()->user()->usertype == "superAdmin")
          <li class="nav-item">
            <a href="{{url('users_page')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                {{ __('Logout') }}
                </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
