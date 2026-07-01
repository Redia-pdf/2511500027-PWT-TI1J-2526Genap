              <?php
              session_start();
              require_once("config/koneksi.php");
             // proteksi login ibu
              if (!isset($_SESSION['username']) || $_SESSION['role'] != 'ibu') {
                  header("Location:login.php");
                  exit;
              }

              // ambil data ibu
              $username = $_SESSION['username'];

              $query = mysqli_query($koneksi, " SELECT * FROM ibu WHERE id_ibu='$username'");
              $data = mysqli_fetch_array($query);
              ?>
                <!DOCTYPE html>
                <!--
              This is a starter template page. Use this page to start your new project from
              scratch. This page gets rid of all links and provides the needed markup only.
              -->
                <html lang="en">

                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <title>Sistem Pemantauan ASI</title>

                  <!-- Google Font: Source Sans Pro -->
                  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                  <!-- Font Awesome Icons -->
                  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
                  <!-- Theme style -->
                  <link rel="stylesheet" href="dist/css/adminlte.min.css">

                  <link rel="icon" type="image/png" href="dist/img/POSYANDU2.png">
                  <style>
                    .main-sidebar {
                      background: #E91E63 !important;
                    }

                    .brand-link,
                    .brand-link span {
                      color: white !important;
                    }

                    .user-panel .info a {
                      color: white !important;
                    }

                    .nav-sidebar .nav-link {
                      color: white !important;
                    }

                    .nav-sidebar .nav-icon {
                      color: white !important;
                    }

                    .nav-sidebar .nav-link:hover {
                      background: rgba(255, 255, 255, 0.15) !important;
                    }

                    .nav-sidebar .nav-link.active {
                      background: rgba(255, 255, 255, 0.25) !important;
                      color: white !important;
                    }

                    .navbar {
                      background: #F8BBD0 !important;
                    }

                    .content-header h1 {
                      color: #EC407A;
                      font-weight: bold;
                    }

                    .card-title {
                      color: #EC407A;
                      font-weight: bold;
                    }

                    .brand-image {
                      width: 40px !important;
                      height: 40px !important;
                      object-fit: cover;
                      margin-top: 5px;
                      margin-left: -10px;
                    }

                    .image img {
                      width: 43px !important;
                      height: 43px !important;
                      object-fit: cover;
                    }

                    .info a {
                      font-size: 20px !important;
                      margin-top: -14px !important;
                    }

                    .brand-link {
                      border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
                    }

                    .user-panel {
                      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                    }

                    .content-wrapper {
                      background: #FFF5F8;
                    }
                  </style>
                </head>

                <body class="hold-transition sidebar-mini">
                  <div class="wrapper">

                    <!-- Navbar -->
                    <nav class="main-header navbar navbar-expand navbar-light"
                      style="background:#EC407A;">
                      <!-- Left navbar links -->
                      <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                      </ul>

                      <!-- Right navbar links -->
                      <ul class="navbar-nav ml-auto">
                        <!-- Navbar Search -->
                        <li class="nav-item">
                          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                          </a>
                          <div class="navbar-search-block">
                            <form class="form-inline">
                              <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                  <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                  </button>
                                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </li>


                      </ul>
                    </nav>
                    <!-- /.navbar -->

                    <!-- Main Sidebar Container -->
                    <aside class="main-sidebar elevation-4" style="background:#EC407A;">
                      <!-- Brand Logo -->
                      <a href="ibu_index.php" class="brand-link text-white">
                        <img src="dist/img/POSYANDU1.png"
                          alt="Logo Posyandu"
                          class="brand-image">
                        <span class="brand-text font-weight-light">
                          Posyandu
                        </span>
                      </a>

                      <!-- Sidebar -->
                      <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                          <div class="image">
                            <img src="dist/img/avatar3.png" class="img-circle elevation-4" alt="User Image">
                          </div>
                          <div class="info">
                            <a href="#" class="brand-link text-white"><?= $data['nm_ibu']; ?></a>
                          </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                          <ul class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                              <a href="ibu_index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                              </a>
                            </li>
                                <li class="nav-item">
                                  <a href="ibu_index.php?page=profil" class="nav-link">
                                    <i class="fas fa-female nav-icon"></i>
                                    <p>Profil Ibu</p>
                                  </a>
                                </li>

                                <li class="nav-item">
                                  <a href="ibu_index.php?page=profil_bayi" class="nav-link">
                                    <i class="fas fa-baby nav-icon"></i>
                                    <p>Data Bayi Saya</p>
                                  </a>
                                </li>

                                <li class="nav-item">
                                  <a href="ibu_index.php?page=catatan_asi" class="nav-link">
                                    <i class="fas fa-tint nav-icon"></i>
                                    <p> Catatan Pemberian ASI</p>
                                  </a>
                                </li>

                                <li class="nav-item">
                                  <a href="ibu_index.php?page=catatan_berat_badan" class="nav-link">
                                    <i class="fas fa-weight nav-icon"></i>
                                    <p>Catatan Pemantauan BB</p>
                                  </a>
                                </li>

                            <li class="nav-item">
                              <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                              </a>
                            </li>

                          </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                      </div>
                      <!-- /.sidebar -->
                    </aside>

                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                      <!-- Content Header (Page header) -->
                      <div class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">
                            <div class="col-sm-6">
                              <h1 class="m-0">Sistem Pemantauan ASI</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="ibu_index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Halaman Sistem</li>
                              </ol>
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                      </div>
                      <!-- /.content-header -->

                      <!-- Main content -->
                      <div class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card shadow-sm border-0">
                                <div class="card-body">

                                  <p class="card-text">
                                    <?php
                                    if (isset($_GET['page'])) {
                                      $page = $_GET['page'];
                                    } else {
                                      $page = "";
                                    }
                                    if ($page == "") {
                                      include "page/dasboard_ibu.php";
                                    } elseif (!file_exists("page/$page.php")) {
                                      echo "File Tidak Ditemukan";
                                    } else {
                                      include "page/$page.php";
                                    }
                                    ?>
                                  </p>

                                </div>
                              </div>
                            </div>
                            <!-- /.col-md-6 -->
                          </div>
                          <!-- /.row -->
                        </div><!-- /.container-fluid -->
                      </div>
                      <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    <!-- /.control-sidebar -->

                    <!-- Main Footer -->
                    <footer class="main-footer text-center">
                      Sistem Pemantauan ASI © 2026
                    </footer>
                  </div>
                  <!-- ./wrapper -->

                  <!-- REQUIRED SCRIPTS -->

                  <!-- jQuery -->
                  <script src="plugins/jquery/jquery.min.js"></script>
                  <!-- Bootstrap 4 -->
                  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                  <!-- AdminLTE App -->
                  <script src="dist/js/adminlte.min.js"></script>
                </body>

                </html>