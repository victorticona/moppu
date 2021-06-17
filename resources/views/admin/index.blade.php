<!DOCTYPE html>
@php
//$url = substr(url()->current(),0, 22);
$url=url('/')."/";

@endphp
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Moppu | delivery comunal</title>
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-toggle.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vuetify.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div id="app" class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-comments mr-2"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="img/person1.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="./img/logo1.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="./img/person1.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-bell mr-3"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="./img/person1.png" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{Auth::user()->name }} </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="./img/person1.png" class="img-circle" alt="User Image">

                            <p>
                                {{session('per_name')." ".session('per_lastname')}}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{  url('miperfil') }}" class="btn btn-default btn-flat">Mi Perfil</a>
                                </div>

                                <div class="col-6 text-center">
                                    <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar session') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="./img/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Moppu</span>
            </a>

            <!-- Sidebar TODO DEL MENU-->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @for ($i = 0; $i < sizeof($da)-1; $i++) @if ($da[$i]['mod_state']==1)
                            @if(strlen($da[$i]['mod_tree'])==strlen($da[$i+1]['mod_tree'])) <li class="nav-item">
                            <a href="{{$url.$da[$i]['mod_url']}}" class="nav-link">
                                @if ($da[$i]['mod_icono']!=null)
                                <i class="nav-icon fa fa-3x">&#x{{$da[$i]['mod_icono']}}</i>
                                @endif

                                <p>
                                    {{$da[$i]['mod_name']}}
                                </p>
                            </a>
                            </li>
                            @else
                            @if (strlen($da[$i]['mod_tree'])<strlen($da[$i+1]['mod_tree'])) <li class="nav-item">
                                <a href="#" class="nav-link">
                                    @if ($da[$i]['mod_icono']!=null)
                                    <i class="nav-icon fa fa-3x">&#x{{$da[$i]['mod_icono']}}</i>
                                    @endif
                                    <p>
                                        {{$da[$i]['mod_name']}}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @else
                                    @if (strlen($da[$i]['mod_tree'])>strlen($da[$i+1]['mod_tree']))
                                    <li class="nav-item">
                                        <a href="{{$url.$da[$i]['mod_url']}}" class="nav-link">
                                            @if ($da[$i]['mod_icono']!=null)
                                            <i class="nav-icon fa fa-3x">&#x{{$da[$i]['mod_icono']}}</i>
                                            @endif
                                            <p>
                                                {{$da[$i]['mod_name']}}
                                            </p>
                                        </a>
                                    </li>
                                    @for ($j = 0; $j <intval((strlen($da[$i]['mod_tree']))/4) ; $j++) </ul> </li>
                                        @endfor @endif @endif @endif @endif @endfor @if(strlen($da[sizeof($da)-1
                                        ]['mod_tree'])<=strlen($da[ sizeof($da)-2 ]['mod_tree'])) <li class="nav-item">
                                        <a href="{{$url.$da[sizeof($da)-1]['mod_url']}}" class="nav-link">
                                            @if ($da[sizeof($da)-1]['mod_icono']!=null)
                                            <i class="nav-icon fa fa-3x">&#x{{$da[sizeof($da)-1]['mod_icono']}}</i>
                                            @endif
                                            <p>
                                                {{$da[sizeof($da)-1]['mod_name']}}
                                            </p>
                                        </a>
                                        </li>
                                        @else

                                        <li class="nav-item">
                                            <a href="{{$url.$da[sizeof($da)-1]['mod_url']}}" class="nav-link">
                                                @if ($da[sizeof($da)-1]['mod_icono']!=null)
                                                <i class="nav-icon fa fa-3x">&#x{{$da[sizeof($da)-1]['mod_icono']}}</i>
                                                @endif
                                                <p>
                                                    {{$da[sizeof($da)-1]['mod_name']}}
                                                </p>
                                            </a>
                                        </li>
                                        @for ($j = 0; $j <intval((strlen($da[sizeof($da)-1]['mod_tree']))/4) ; $j++)
                                            </ul> </li> @endfor @endif <br>

                                </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{$da[0]['nombre']}} </h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    @yield('contenido')
                </div>
                <!--  -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0
            </div>
            <center><a href="mailto:corenginesoft@gmail.com">Moppu&copy; - Todos los derechos reservados</a>
            </center>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->




    <script type="text/javascript" src="{{URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>

    <!-- <script type="text/javascript" src="{{URL::asset('js/vuetify.js')}}"></script>
          <script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
-->


    {{-- <script src="{{URL::asset('js/app.js')}}"></script> --}}
    <script src="js/app.js"></script>

</body>

</html>
