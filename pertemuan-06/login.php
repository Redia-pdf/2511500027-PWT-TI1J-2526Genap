<?php
include "config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
          </div>
          <!-- /.col -->
        </div>
      </form>

    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<?php
if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo "Data tidak boleh kosong";
  } else {

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_array($query);

    if($user){
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // cek password default
        if($user['password'] == '1234'){
            header("Location: ganti_password.php");
            exit;
        }

        // redirect sesuai role
        if($user['role'] == 'admin'){
            header("Location: index.php");
        }
        elseif($user['role'] == 'siswa'){
            header("Location: siswa_index.php");
        }
        elseif($user['role'] == 'guru'){
            header("Location: guru_index.php");
        }
        exit;

    } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">x</button>
                Login gagal
              </div>';
    }
  }
}
?>