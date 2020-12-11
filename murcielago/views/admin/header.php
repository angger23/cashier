
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/web/images/') ?>favicon.png">
    <title><?php echo $title ?></title>
    <link href="<?php echo base_url() ?>assets_admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_admin/plugins/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_admin/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url()?>assets_admin/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets_admin/plugins/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>assets_admin/plugins/summernote/dist/summernote-bs4.css" rel="stylesheet"/  >
    <link href="<?php echo base_url() ?>assets_admin/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets_admin/plugins/dropify/dist/css/dropify.min.css">
    <link href="<?php echo base_url() ?>assets_admin/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_admin/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_admin/css/colors/megna2.css" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
.dropify-wrapper .dropify-message p {
    margin: 5px 0 0;
    text-align: center;
}
    .btn-circle.right-side-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 25px;
        z-index: 10;
        display: none;
    }
    .sidebar-nav > ul > li > a.active {
        font-weight: 400;
        background: #e3e3e3 !important;
    }
    .slimScrollBar {
        z-index: 10!important;
        background: #870a30 !important;
        opacity: 1 !important;
    }
</style>
</head>


<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar" style="z-index: 999;">
            <style type="text/css">
                .topbar .navbar-header {
                    background: #870A30 !important;
                }
            </style>
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <p style="color: #fff;margin: 0px 10px 0px 30px;font-weight: 700;letter-spacing: 1px;text-align: center;">Admin S1 Keperawatan Stikes Banyuwangi</p>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets_admin/images/') ?>user-512.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li><a href="<?php echo base_url('auth/logout') ?>"> <i class="fa fa-power-off"></i> Keluar </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="profile-text">
                        <img src="<?php echo base_url('assets_admin/images/') ?>logo_stikes.png" alt="homepage" class="dark-logo" style="width: 91px;" />
                        <h5 style="margin-top: 20px;font-weight: 700;"><?php echo $users->first_name; ?></h5>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">MENU UTAMA</li> 
                        <li> <a class="waves-effect waves-dark" href="<?php echo base_url('admin'); ?>"><i class="mdi mdi-home"></i>Beranda </a></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Profil</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url('admin/tentang') ?>">Tentang Kami</a></li>
                                <li><a href="<?php echo base_url('admin/struktur_organisasi') ?>">Struktur Organisasi</a></li>
                                <li><a href="<?php echo base_url('admin/visi_misi') ?>">Visi Misi</a></li>
                                <li><a href="<?php echo base_url('admin') ?>">Tugas & Fungsi</a></li>
                                <li><a href="<?php echo base_url('admin/admin_dosen') ?>">Profil Dosen</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Akademik</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url('admin') ?>">Tentang Kami</a></li>
                                <li><a href="<?php echo base_url('admin') ?>">Struktur Organisasi</a></li>
                                <li><a href="<?php echo base_url('admin') ?>">Visi Misi</a></li>
                                <li><a href="<?php echo base_url('admin') ?>">Tugas & Fungsi</a></li>
                                <li><a href="<?php echo base_url('admin') ?>">Profil Dosen</a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="<?php echo base_url('admin/berita'); ?>"><i class="mdi mdi-home"></i>Berita </a></li>
                    </ul>
                </nav>
            </div>
        </aside>
