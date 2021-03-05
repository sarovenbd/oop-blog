<?php
    session_start();
    require 'config/config.php';
    require 'lib/database.php';
    require 'helper/function.php';

    require 'lib/auth_check.php';

    $db = new Database ();
    $q = "SELECT * FROM settings WHERE id = 1";
    $sdata = $db->select($q);
    if ($sdata) {
        $sd = $sdata->fetch_assoc();
    }
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo $sd ? $sd['description'] : 'saroven blog' ?>" />
        <meta name="keywords" content="<?php echo $sd ? $sd['tags'] : 'blog, tech, saroven blog, sarovenbd' ?>">
        <meta name="author" content="saroven">

        <title>Dashboard | <?php echo $sd ? $sd['title'] : 'Saroven Personal Blog' ?></title>

        <link href="inc/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="/admin/index.php"><?php echo $sd ? $sd['title'] : 'Saroven Personal Blog' ?></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar profile icon-->
            <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="/admin/settings.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
