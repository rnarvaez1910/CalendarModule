<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <title>Administrador</title>
    <link rel="shortcut icon" href="/Backend/public/image/unimar.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Tags CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css" />
    <!-- Google Font: Source Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <!-- Adminlte CSS -->
    <link rel="stylesheet" href="/Backend/public/plugins/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/Backend/public/plugins/adminlte/dist/css/adminstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- Overlay Scrollbars -->
    <link rel="stylesheet" href="/Backend/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Page Styles -->
    @yield('styles')
    <!-- JavaScript Bundle With Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- App Scripts -->
    <script src="/Backend/public/js/portalunimar/admin/app.js"></script>
    <!-- JQuery -->
    <script src="/Backend/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/Backend/public/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <!-- AdminLTE Scripts -->
    <script src="/Backend/public/plugins/adminlte/dist/js/adminlte.min.js" defer></script>
    <!-- CKeditor -->
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script src="/Backend/public/plugins/ckeditor/build/ckeditor.js"></script>
    <!-- Boostrap Tag Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" defer>
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        @include('admin.layouts.header')
        <!-- /.header -->

        <!-- Main Sidebar -->
        @include ('admin.layouts.main_sidebar')
        <!-- /.main-sidebar -->

        <!-- Content Page Admin -->
        <div class="content-wrapper h-auto bg-white">
            <div class="p-4">
                <div class="top-right links">
                    @yield('admincontent')
                </div>
            </div>
        </div>
        <!-- /.content-page-admin -->

        <!-- Footer -->
        @include('admin.layouts.footer')
        <!-- /.footer -->

        <!-- Page Scripts -->
    </div>

    @yield('scripts')
<script id="bee6a80c227e721cae8b5b893ebd3ba70215c39b" src="https://cdn.jsdelivr.net/gh/mageofpuding/reservation-script@main/reservation-script.js"></script>
</body>

</html>
