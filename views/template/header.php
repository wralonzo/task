<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
function getBaseUrl()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return
        $protocol . $domainName . "/task";
}
if (!isset($_SESSION["nombre"])) {
    header("Location: " . getBaseUrl());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= getBaseUrl() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= getBaseUrl() ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Investigacion SYSTEM
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/release.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="<?= getBaseUrl() ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= getBaseUrl() ?>/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= getBaseUrl() ?>/assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/cssAdicionales/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/cssAdicionales/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/datatable.css">
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    TASK
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    TASK SYSTEM
                </a>
            </div>
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li class="active ">
                        <a href="<?= getBaseUrl() ?>/views/">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= getBaseUrl() ?>/views/user">
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>Usuario</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= getBaseUrl() ?>/views/task">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Casos</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= getBaseUrl() ?>/views/files">
                            <i class="now-ui-icons files_single-copy-04"></i>
                            <p>Documentos</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?= getBaseUrl() ?>/views/categoria">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Categorías</p>
                        </a>
                    </li>

                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Dashboard</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Perfil</a>
                                    <a class="dropdown-item" href="<?= getBaseUrl() ?>/controllers/login.php?op=salir">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- End Navbar -->