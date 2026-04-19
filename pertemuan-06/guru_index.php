<?php
session_start();
require_once("config/koneksi.php");

// proteksi login guru
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'guru') {
    header("Location:login.php");
    exit;
}

// ambil data guru
$username = $_SESSION['username'];

$query = mysqli_query($koneksi, "
  SELECT * FROM guru 
  WHERE kd_guru='$username'
");

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Guru</title>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Guru</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?= $data['nm_guru']; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Biodata</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>Biodata Guru</h1>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            
                            <p><b>Kode Guru:</b> <?= $data['kd_guru']; ?></p>
                            <p><b>Nama:</b> <?= $data['nm_guru']; ?></p>
                            <p><b>Jenis Kelamin:</b> <?= $data['jenkel']; ?></p>
                            <p><b>Pendidikan Terakhir:</b> <?= $data['pend_terakhir']; ?></p>
                            <p><b>No HP:</b> <?= $data['hp']; ?></p>
                            <p><b>Alamat:</b> <?= $data['alamat']; ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>