<nav class="main-header navbar navbar-expand navbar-pink navbar-light" style="background: #D70F64">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" style="color: white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"  style="color: white">
        <i class="far fa-user"></i>
        {{session('name')}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
        {{session('email')}}
        </span>
        <div class="dropdown-divider"></div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" onclick="document.getElementById('admin-logout').submit()"><i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="admin-logout" action="{{route('admin.logout')}}" method="post" style="display: none">
          @csrf
        </form>
        </div>
      </li>
    </ul>
  </nav>
