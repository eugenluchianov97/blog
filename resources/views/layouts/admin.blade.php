<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">


    <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
    <!-- summernote -->
{{--    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">--}}

    <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div  class="wrapper">


        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="opacity:0.6">
            <div class="spinner-border text-secondary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-th-large"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <form action="{{ route('logout') }}" method="POST"  class=" dropdown-item d-flex align-items-center">
                            @csrf
                            <i class="fas fa-th-large mr-2"></i>
                            <button type="submit" class="btn p-0">Выйти</button>
                        </form>
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a href="#" class="dropdown-item">--}}
{{--                            <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                            <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a href="#" class="dropdown-item">--}}
{{--                            <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                            <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    @if(Auth::check())
    {{--                    <div class="image">--}}
    {{--                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
    {{--                    </div>--}}
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>

                    @endif

                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('admin.index')}}" class="nav-link @if(Route::current()->getName() == 'admin.index') active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Главная
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->is_admin())
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" class="nav-link @if(Route::current()->getName() == 'admin.users.index') active @endif">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>{{__('admin/main.users')}}</p>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->is_admin())
                            <li class="nav-item" >
                                <a href="{{route('admin.categories.index')}}" class="nav-link @if(Route::current()->getName() == 'admin.categories.index') active @endif">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        {{__('admin/main.categories')}}
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->is_admin())
                            <li class="nav-item" >
                                <a href="{{route('admin.posts.index')}}" class="nav-link @if(Route::current()->getName() == 'admin.posts.index') active @endif">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Посты
                                    </p>
                                </a>
                            </li>
                        @endif




                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @yield('breadcrumbs')

            </div>
            <!-- /.content-header -->

            <section class="content">
                @yield('content')
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
{{--<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>--}}
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>--}}
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>

</script>

@if(session()->has('warning'))
    <script>
        toastr.info('{{ session()->get('warning') }}')
    </script>
@endif

@if(session()->has('success'))
    <script>
        toastr.success('{{ session()->get('success') }}')
    </script>
@endif

@yield('scripts')
</body>
</html>
