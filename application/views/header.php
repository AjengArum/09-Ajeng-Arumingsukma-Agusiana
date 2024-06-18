<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Ang Lesson</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="" href="<?= base_url() ?>">

    <link href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />


</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">
    
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
            <div class="text-center">
                    <a href="<?= base_url() ?>" class="logo"><img src="assets/file/logo_pjg.png" alt="Image" class="img-fluid"></a>
            </div>
            </div>

            <div class="sidebar-inner slimscrollleft">

                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="<?= base_url('dashboard') ?>" class="waves-effect">
                                <i class="mdi mdi-home"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('jadwal') ?>" class="waves-effect">
                                <i class="mdi mdi-calendar"></i>
                                <span> Penjadwalan </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('layanan') ?>" class="waves-effect">
                                <i class="mdi mdi-view-list"></i>
                                <span> Layanan </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('member') ?>" class="waves-effect">
                                <i class="mdi mdi-account-circle"></i>
                                <span> Murid </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('tagihan') ?>" class="waves-effect">
                                <i class="mdi mdi-currency-usd"></i>
                                <span> Tagihan </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('pembayaran') ?>" class="waves-effect">
                                <i class="mdi mdi-database"></i>
                                <span> Riwayat Pembayaran </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('absensi') ?>" class="waves-effect">
                                <i class="mdi mdi-check"></i>
                                <span> Absensi Tentor </span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?= base_url('rekap') ?>" class="waves-effect">
                                <i class="mdi mdi-note"></i>
                                <span> Rekap Absensi </span>
                            </a>
                        </li> -->
                    </ul>
                </div>


                
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="<?= base_url() ?>assets/file/AJENG.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <!-- <a class="dropdown-item" href="<?= base_url('about') ?>"><i
                                            class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a> -->
                                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i 
                                            class="mdi mdi-power-settings m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>

                        </ul>

                        <div class="clearfix"></div>

                    </nav>

                </div>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">

                    <div class="container-fluid">