 <aside class="main-sidebar sidebar-light-purple elevation-4">
  <!-- Brand Logo -->
  <a href="admin_dashboard.html" class="brand-link">
    <img src="{{asset('logo/food_panda_logo.jpg')}}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">&nbsp; VBR</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="admin Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{session('role')}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{url('vbr/dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('mycustomer')}}" class="nav-link">
              <i class="nav-icon fas fa-user text-green"></i>
            <p>My Customers</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('coupon.generate')}}" class="nav-link">
              <i class="nav-icon fas fa-list text-green"></i>
            <p>Generate Coupon</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="document.getElementById('admin-logout').submit()">
              <i class="nav-icon fas fa-arrow-circle-right text-danger"></i>
              <p>Logout</p>
            </a>
            <form id="admin-logout" action="{{route('admin.logout')}}" method="post" style="display: none">
              @csrf
           </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>