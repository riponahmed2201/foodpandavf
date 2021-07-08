<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
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
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><i class="fas fa-users mr-2"></i> Profile Profile
        </a>
        </div>
      </li>
    </ul>
  </nav>