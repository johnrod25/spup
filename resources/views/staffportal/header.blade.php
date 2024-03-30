<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPUP</title>
    <link rel="icon" href="{{ asset('images/SPUP LOGO.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

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
        <li>
            <a href="{{ route('borrows') }}"  class="btn btn-default btn-flat rounded mx-3">
                <i class="fa fa-solid fa-bell text-success" style="font-size:20px;"></i>
                <span class="text-primary" id="notif_count">{{ session('notif'); }}</span>
            </a>        
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('assets/dist/img/user-solid.svg') }}" class="user-image img-circle elevation-2" alt="User Image">      
              <span class="d-none d-md-inline text-capitalize">{{ auth()->user()->name }}</span>
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary d-flex justify-content-center align-items-center flex-column">
              <img src="{{ asset('assets/dist/img/user-solid.svg') }}" class="user-image img-circle elevation-2 bg-white" alt="User Image"> 
                <p class="text-capitalize">{{ auth()->user()->name }}</p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <a href="{{ route('change_password') }}" class="btn btn-default btn-flat">Change Password</a>
                <a href="#" class="btn btn-default btn-flat float-right"  onclick="document.getElementById('logoutForm').submit()">Sign out</a>
                <form method="post" id="logoutForm" action="{{ route('logout') }}">
                            @csrf
                        </form>
              </li>
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> -->
    </ul>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4 bg-success">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-transparent">
      <!-- <img src="{{ asset('assets/dist/img/logo.jpg') }}" alt="RBASASHS" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <img src="{{ asset('images/library.png') }}" class="w-100 h-100 rounded elevation-3" style="opacity: .8;">
      <!-- <span class="brand-text font-weight-light">SPUP Laboratory</span> -->
    </a>
    <!-- Sidebar -->
    <div class="sidebar py-5">
      
      <!-- SidebarSearch Form -->
      <div class="form-inline pt-2">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar text-white bg-white" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar bg-white">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 pt-2 text-white">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-white">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-book"></i>
                        <p class="text-white">Inventory<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 14) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Chemistry</p>
                            </a>
                        </li>
                    </ul>   
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 12) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Medicine/Med. Tech</p>
                            </a>
                        </li>
                    </ul>   
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 11) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Pharmacy</p>
                            </a>
                        </li>
                    </ul> 
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 15) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Physics</p>
                            </a>
                        </li>
                    </ul> 
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 16) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Chemicals/Reagents</p>
                            </a>
                        </li>
                    </ul> 
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.views', 17) }}" class="nav-link text-white">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="text-white">Glassware</p>
                            </a>
                        </li>
                    </ul> 
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p class="text-white">Transactions</p>
                    </a>
                </li>
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>
@yield('content')


  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; 2024 <a href="https://adminlte.io">SPUP</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
      $(document).ready(function() {

        setInterval(function () {
            $.ajax({
                type: 'get',
                url: "/notification",
                success: function(response){
                    console.log(response.notif)
                    document.getElementById('notif_count').innerText =  response.notif;
                    // $('#notif_count').val() = response.notif;
                    // window.location.href = "borrows";
                }
            });              
        }, 5000);
        
    $('#example').DataTable();
    let notif = JSON.parse(localStorage.getItem('Notif'));
    if(notif != null){
      Command: toastr[notif.response](notif.message)
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        localStorage.clear();
    }
  } );

  function errorToast(message){
    Command: toastr["error"](message)
      toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }
  }
</script>