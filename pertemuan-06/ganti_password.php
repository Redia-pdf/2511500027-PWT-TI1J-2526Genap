<?php
session_start();
include "config/koneksi.php";

// cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['ganti'])) {
    $username = $_SESSION['username'];
    $password_baru = $_POST['password'];

    if (empty($password_baru)) {
        $error = "Password tidak boleh kosong";
    } else {
        mysqli_query($koneksi, "UPDATE users SET password='$password_baru' WHERE username='$username'");

        // ambil role
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'"));
        $role = $data['role'];

        if ($role == 'admin') {
            header("Location: index.php");
        } elseif ($role == 'siswa') {
            header("Location: siswa_index.php");
        } elseif ($role == 'guru') {
            header("Location: guru_index.php");
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ganti Password</title>

  <!-- CSS AdminLTE -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <b>Ganti</b> Password
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan ganti password Anda</p>

      <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error; ?></div>
      <?php } ?>

      <form method="post">
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password Baru">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" name="ganti" class="btn btn-primary btn-block">
              Simpan Password
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>