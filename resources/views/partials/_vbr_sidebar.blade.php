<aside class="main-sidebar sidebar-light-pink elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)">
        <img style="width: 250px; height: 56px;" src="{{asset('logo/food_panda_logo.jpg')}}" alt="logo">
{{--        <span class="brand-text font-weight-light">&nbsp; VBR</span>--}}
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="admin Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)" text-uppercase class="d-block">{{session('role')}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(Session::get('page')=="vbr_dashboard")
                    <?php $active="active"; ?>
                @else
                    <?php $active=""; ?>
                @endif

                <li class="nav-item">
                    <a href="{{url('vbr/dashboard')}}" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Session::get('page')=="adminPasswordChange")
                    <?php $active="active"; ?>
                @else
                    <?php $active=""; ?>
                @endif

                <li class="nav-item">
                    <a href="{{url('/vbr/password/change')}}" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-user-cog" style="color: #00008B"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>

                @if(Session::get('page')=="mycustomer")
                    <?php $active="active"; ?>
                @else
                    <?php $active=""; ?>
                @endif
                <li class="nav-item">
                    <a href="{{route('mycustomer')}}" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-user text-green"></i>
                        <p>My Customers</p>
                    </a>
                </li>
                @if(Session::get('page')=="couponGenerate")
                    <?php $active="active"; ?>
                @else
                    <?php $active=""; ?>
                @endif
                <li class="nav-item">
                    <a href="{{route('coupon.generate')}}" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-plus-circle" style="color: #4169E1"></i>
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
