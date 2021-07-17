<!DOCTYPE html>
<?php
//$url = substr(url()->current(),0, 22);
$url = url('/') . '/';

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Moppu | delivery comunal</title>
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome.css')); ?>">
    
    
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/vuetify.min.css')); ?>">
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
                        <span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="./img/person1.png" class="img-circle" alt="User Image">

                            <p>
                                <?php echo e(session('per_name') . ' ' . session('per_lastname')); ?>

                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="<?php echo e(url('miperfil')); ?>" class="btn btn-default btn-flat">Mi Perfil</a>
                                </div>

                                <div class="col-6 text-center">
                                    <a class="btn btn-default btn-flat float-right" href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Cerrar session')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo csrf_field(); ?>
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
                <div class="user-panel  ">
                    <div class="info">
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?php
                        $sw=0;
                        ?>
                        <?php for($i = 0; $i < sizeof($da)-1; $i++): ?> <?php if($da[$i]['mod_state']==1): ?>
                            <?php if(strlen($da[$i]['mod_tree'])==strlen($da[$i+1]['mod_tree'])): ?>
                            <?php if($da[0]['nombre']==$da[$i]['mod_name']): ?> <li class="nav-item menu-open">
                            <a href="<?php echo e($url.$da[$i]['mod_url']); ?>" class="nav-link active">

                                <?php else: ?>
                                <li class="nav-item">
                                    <a href="<?php echo e($url.$da[$i]['mod_url']); ?>" class="nav-link">
                                        <?php endif; ?>
                                        <?php if($da[$i]['mod_icono']!=null): ?>
                                        <i class="nav-icon fa fa-3x">
                                            &#x<?php echo e($da[$i]['mod_icono']); ?>

                                        </i>
                                        <?php endif; ?>
                                        <p><?php echo e($da[$i]['mod_name']); ?></p>
                                    </a>
                                </li>
                                <?php else: ?>
                                <?php if(strlen($da[$i]['mod_tree'])<strlen($da[$i+1]['mod_tree'])): ?>
                                    <?php if($da[0]['padre']==$da[$i]['mod_id']): ?> <li class="nav-item menu-open">
                                    <a href="#" class="nav-link active">

                                        <?php else: ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <?php endif; ?>

                                                <?php if($da[$i]['mod_icono']!=null): ?>
                                                <i class="nav-icon fa fa-3x">
                                                    &#x<?php echo e($da[$i]['mod_icono']); ?>

                                                </i>
                                                <?php endif; ?>
                                                <p>
                                                    <?php echo e($da[$i]['mod_name']); ?>

                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php else: ?>
                                                <?php if(strlen($da[$i]['mod_tree'])>strlen($da[$i+1]['mod_tree'])): ?>
                                                <?php if($da[0]['nombre']==$da[$i]['mod_name']): ?>
                                                <li class="nav-item menu-open">
                                                    <a href="<?php echo e($url.$da[$i]['mod_url']); ?>" class="nav-link active">

                                                        <?php else: ?>
                                                <li class="nav-item">
                                                    <a href="<?php echo e($url.$da[$i]['mod_url']); ?>" class="nav-link">
                                                        <?php endif; ?>

                                                        <?php if($da[$i]['mod_icono']!=null): ?>
                                                        <i class="nav-icon fa fa-3x">
                                                            &#x<?php echo e($da[$i]['mod_icono']); ?>

                                                        </i>
                                                        <?php endif; ?>
                                                        <p>
                                                            <?php echo e($da[$i]['mod_name']); ?>

                                                        </p>
                                                    </a>
                                                </li>
                                                <?php for($j = 0; $j <intval((strlen($da[$i]['mod_tree']))/4) ; $j++): ?> </ul>
                                                    </li> <?php endfor; ?> <?php endif; ?> <?php endif; ?> <?php endif; ?> <?php endif; ?> <?php endfor; ?>
                                                    <?php if(strlen($da[sizeof($da)-1]['mod_tree'])<=strlen($da[sizeof($da)-2]['mod_tree'])): ?>
                                                    <?php if($da[0]['nombre']==$da[sizeof($da)-1]['mod_name']): ?> <li
                                                    class="nav-item menu-open">
                                                    <a href="<?php echo e($url.$da[sizeof($da)-1]['mod_url']); ?>"
                                                        class="nav-link active">
                                                        <?php else: ?>
                                                        <li class="nav-item">
                                                            <a href="<?php echo e($url.$da[sizeof($da)-1]['mod_url']); ?>"
                                                                class="nav-link">
                                                                <?php endif; ?>

                                                                <?php if($da[sizeof($da)-1]['mod_icono']!=null): ?>
                                                                <i class="nav-icon fa fa-3x">
                                                                    &#x<?php echo e($da[sizeof($da)-1]['mod_icono']); ?>

                                                                </i>
                                                                <?php endif; ?>
                                                                <p>
                                                                    <?php echo e($da[sizeof($da)-1]['mod_name']); ?>

                                                                </p>
                                                            </a>
                                                        </li>
                                                        <?php else: ?>
                                                        <li class="nav-item">
                                                            <a href="<?php echo e($url.$da[sizeof($da)-1]['mod_url']); ?>"
                                                                class="nav-link">
                                                                <?php if($da[sizeof($da)-1]['mod_icono']!=null): ?>
                                                                <i class="nav-icon fa fa-3x">
                                                                    &#x<?php echo e($da[sizeof($da)-1]['mod_icono']); ?>

                                                                </i>
                                                                <?php endif; ?>
                                                                <p>
                                                                    <?php echo e($da[sizeof($da)-1]['mod_name']); ?>

                                                                </p>
                                                            </a>
                                                        </li>
                                                        <?php for($j = 0; $j
                                                        <intval((strlen($da[sizeof($da)-1]['mod_tree']))/4) ; $j++): ?>
                                                            </ul> </li> <?php endfor; ?> <?php endif; ?> <br>
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
                            <h1><?php echo e($da[0]['nombre']); ?> </h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <?php echo $__env->yieldContent('contenido'); ?>
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




    <script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/toastr.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/popper.min.js')); ?>"></script>

    <!-- <script type="text/javascript" src="<?php echo e(URL::asset('js/vuetify.js')); ?>"></script>
          <script type="text/javascript" src="<?php echo e(URL::asset('js/popper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>


    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
-->


    
    <script src="js/app.js"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravel-vuetify-master\resources\views/admin/index.blade.php ENDPATH**/ ?>