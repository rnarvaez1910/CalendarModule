<!-- Top Header -->
<nav class="main-header navbar navbar-expand navbar-blue-u justify-content-between" style="z-index: 100">
    <!-- Left Section -->
    <ul class="navbar-nav">
        <!-- Mobile Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="color: #ffffff"></i>
            </a>
        </li>
        <!-- /.mobile-menu -->
    </ul>
    <!-- /.left-section -->

    <!-- Rigth Section -->
    <ul class="navbar-nav text-end">
        <!-- User Info -->
        <div class="user-panel d-inline-flex align-items-center">
            <div class="image">
                <img src="{{URL::asset('image/user.png')}}" class="img-circle elevation-2" alt="Usuario">
            </div>
            <div class="info">
                @auth
                    <h6 style="margin: 0">{{ auth()->user()->name }}</h6>
                @else
                    <h6 style="margin: 0">Bienvenid@</h6>
                @endauth
            </div>
        </div>
        <!-- /.user-info -->
    </ul>
    <!-- /.right-section -->
</nav>
<!-- /.top-header -->