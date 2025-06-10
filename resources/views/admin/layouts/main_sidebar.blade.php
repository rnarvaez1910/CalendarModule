<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
        <img src="{{URL::asset('image/logo-unimar-127.png')}}" alt="UNIMAR logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"><img class="portal-title" src="{{URL::asset('image/texto-unimar.jpg')}}"></span>
    </a>
    <!-- /.brand-logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                @if((auth()->user()->is_employee()))
                <!-- Employees Sub Menu -->
                <li class="nav-item" id="empleados">
                    <a href="#" class="nav-link" id="btn-nav">
                        <i class="fas fa-id-badge nav-icon grape"></i>
                        <p>
                            Empleados
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Employees Example 1 -->
                        <li class="nav-item" id="ejemplo-empleados">
                            <a href="#" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Ejemplo Empleados</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.employees-sub-menu -->
                @endif

                @if((auth()->user()->is_student()))
                <!-- Students Sub Menu -->
                <li class="nav-item" id="estudiantes">
                    <a href="#" class="nav-link" id="btn-nav">
                        <i class="fas fa-user-graduate nav-icon grape" id="navicon"></i>
                        <p>
                            Estudiantes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Students Example 1 -->
                        <li class="nav-item" id="ejemplo-estudiantes-1">
                            <a href="#" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Ejemplo Estudiantes 1</p>
                            </a>
                        </li>
                        <!-- Students Example 2 -->
                        <li class="nav-item" id="ejemplo-estudiantes-2">
                            <a href="#" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Ejemplo Estudiantes 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.students-sub-menu -->
                @endif

                @if((auth()->user()->is_teacher()))
                <!-- Teachers Sub Menu -->
                <li class="nav-item" id="profesores">
                    <a href="#" class="nav-link" id="btn-nav">
                        <i class="fas fa-chalkboard-teacher nav-icon grape"></i>
                        <p>
                            Profesores
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Teachers Example 1 -->
                        <li class="nav-item" id="ejemplo-profesores-1">
                            <a href="#" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Ejemplo Profesores 1</p>
                            </a>
                        </li>
                        <!-- Teachers Example 2 -->
                        <li class="nav-item" id="ejemplo-profesores-2">
                            <a href="#" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Ejemplo Profesores 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.teachers-sub-menu -->
                @endif

                <!-- Other Admin Sections -->
                <li class="nav-item" id="cuenta">
                    <a href="#" class="nav-link" id="btn-nav">
                        <i class="fas fa-id-badge nav-icon grape"></i>
                        <p>
                            Cuenta
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Home -->
                        <li class="nav-item" id="inicio">
                            <a href="{{url('/home')}}" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <!-- Profile -->
                        <li class="nav-item" id="perfil">
                            <a href="{{route('user_profile')}}" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Perfil</p>
                            </a>
                        </li>
                        <!-- Logout -->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" id="btn-nav">
                                <i class="fas fa-circle-notch nav-icon grape"></i>
                                <p>Cerrar Sesión</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.other-admin-sections -->
                @endauth
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>