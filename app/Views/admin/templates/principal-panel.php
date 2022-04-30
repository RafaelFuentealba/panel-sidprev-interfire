<!doctype html>
<html class="no-js " lang="es">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>Panel de control SIDPREV - Interfire</title>

<link rel="icon" href="<?= base_url('public/images/interfire-favicon.png'); ?>" type="image/png"> <!-- Favicon-->

<link rel="stylesheet" href="<?= base_url('public/plugins/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/plugins/charts-c3/plugin.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('public/plugins/morrisjs/morris.min.css') ?>" />
<link rel="stylesheet" href="<?= base_url('public/plugins/sweetalert/sweetalert.css') ?>"/>

<link rel="stylesheet" href="<?= base_url('public/plugins/jquery-datatable/dataTables.bootstrap4.min.css') ?>"> <!-- JQuery DataTable Css -->

<link rel="stylesheet" href="<?= base_url('public/css/style.min.css') ?>">

</head>

<body class="theme-green">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="<?= base_url('public/images/loader.svg') ?>" width="48" height="48"></div>
        <p>Cargando...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
      <input type="search" value="" placeholder="Search..." />
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Right Icon menu Sidebar -->
<div class="navbar-right">
    <ul class="navbar-nav">        
        <li><a href="<?= site_url('auth/logout') ?>" class="mega-menu" title="Cerrar sesión"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
</div>


<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="javascript:void(0);"><img src="<?= base_url('public/images/logo-interfire.png') ?>" width="75"><span class="m-l-10">Panel</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="<?= site_url('admin/perfil') ?>"><img src="<?= base_url('public/uploads/users/'.$userInfo['img_perfil']) ?>"></a>
                    <div class="detail">
                        <h4><?= $userInfo['nombre'] ?></h4>
                        <small><?= $userInfo['tipo_acceso'] ?></small>                        
                    </div>
                </div>
            </li>
            <li class="
                <?php
                if ((uri_string() == 'admin/gestion/usuarios') || uri_string() == 'admin/gestion/usuarios/activos' || uri_string() == 'admin/gestion/usuarios/bloqueados') {
                    echo 'active open';
                } else if ((service('uri')->getSegment(1) == 'admin') && (service('uri')->getSegment(2) == 'gestion') && (service('uri')->getSegment(3) == 'usuario')) {
                    $userID = service('uri')->getSegment(4);
                    $userManageURL = array('admin/gestion/usuario/'.$userID);
                    if(in_array(uri_string(), $userManageURL, true)) echo 'active open';
                }
                ?>
                "><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts-alt"></i><span>Gestionar usuarios</span></a>
                <ul class="ml-menu">
                    <li><a href="<?= site_url('admin/gestion/usuarios') ?>">Todos</a></li>
                    <li><a href="<?= site_url('admin/gestion/usuarios/activos') ?>">Activos</a></li>
                    <li><a href="<?= site_url('admin/gestion/usuarios/bloqueados') ?>">Bloqueados</a></li>
                </ul>
            </li>
            <li class="
                <?php
                if ((uri_string() == 'admin/beta/usuarios') || uri_string() == 'admin/beta/usuarios/activos' || uri_string() == 'admin/beta/usuarios/bloqueados') {
                    echo 'active open';
                } else if ((service('uri')->getSegment(1) == 'admin') && (service('uri')->getSegment(2) == 'beta') && (service('uri')->getSegment(3) == 'usuario')) {
                    $userID = service('uri')->getSegment(4);
                    $userManageURL = array('admin/beta/usuario/'.$userID);
                    if(in_array(uri_string(), $userManageURL, true)) echo 'active open';
                }
                ?>
                "><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts-outline"></i><span>Usuarios beta</span></a>
                <ul class="ml-menu">
                    <li><a href="<?= site_url('admin/beta/usuarios') ?>">Todos</a></li>
                    <li><a href="<?= site_url('admin/beta/usuarios/activos') ?>">Activos</a></li>
                    <li><a href="<?= site_url('admin/beta/usuarios/bloqueados') ?>">Bloqueados</a></li>
                </ul>
            </li>
            <!--<li class="<?php if(uri_string()=='admin/estadisticas') echo 'active open' ?>"><a href="javascript:void(0);"><i class="zmdi zmdi-chart"></i><span>Estadísticas</span></a></li>-->
        </ul>
    </div>
</aside>


<!-- Jquery Core Js --> 
<script src="<?= base_url('public/bundles/libscripts.bundle.js') ?>"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="<?= base_url('public/bundles/vendorscripts.bundle.js') ?>"></script> <!-- slimscroll, waves Scripts Plugin Js -->
<script src="<?= base_url('public/bundles/mainscripts.bundle.js') ?>"></script>
<script src="<?= base_url('public/js/pages/index.js') ?>"></script>

<script src="<?= base_url('public/bundles/jvectormap.bundle.js') ?>"></script> <!-- JVectorMap Plugin Js -->
<script src="<?= base_url('public/bundles/sparkline.bundle.js') ?>"></script> <!-- Sparkline Plugin Js -->
<script src="<?= base_url('public/bundles/c3.bundle.js') ?>"></script>

<script src="<?= base_url('public/plugins/jquery-validation/jquery.validate.js') ?>"></script> <!-- Jquery Validation Plugin Css -->
<script src="<?= base_url('public/plugins/sweetalert/sweetalert.min.js') ?>"></script> <!-- SweetAlert Plugin Js --> 
<script src="<?= base_url('public/js/pages/ui/sweetalert.js') ?>"></script>

<!-- Jquery DataTable Plugin Js --> 
<script src="<?= base_url('public/bundles/datatablescripts.bundle.js') ?>"></script>
<script src="<?= base_url('public/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('public/js/pages/tables/jquery-datatable.js') ?>"></script>


</body>


</html>