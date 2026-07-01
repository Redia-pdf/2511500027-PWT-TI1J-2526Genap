<?php
include "config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Sistem Pemantauan ASI</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
   <link rel="icon" type="image/png" href="dist/img/POSYANDU2.png">
  <style>
.login-page::before{
    content:"";
    position:absolute;

    width:300px;
    height:300px;

    top:50%;
    left:50%;

    transform:translate(-50%,-50%);

    background:url('dist/img/POSYANDU1.png') center no-repeat;
    background-size:contain;

    opacity:0.12;
}

.login-page{
    background: linear-gradient(
        135deg,
        #eae5e7,
        #ffd6e7
    );
}

.login-card-body{
    border-radius:20px;
}

.login-box{
    width:420px;
}

.card{
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.logo-login{
    width:110px;
    height:auto;
    margin-bottom:5px;
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo text-center">
    <img src="dist/img/POSYANDU1.png" alt="Logo Posyandu" class="logo-login"  style="filter: brightness(0) saturate(100%) invert(24%) sepia(95%) saturate(2255%) hue-rotate(315deg) brightness(99%) contrast(105%);">
    <br>
    <a href="#" style="color:#e91e63;" style="font-size: 50px; font-weight: bold;">
        <b>Sistem Pemantauan ASI</b>
    </a>
    <p style="font-size:16px;color:#777;">
        Posyandu Sehat Ibu & Bayi
    </p>
</div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan Login untuk masuk ke sistem</p>
      
      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
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
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Masuk" style="background-color: #e91e63; border-color: #e91e63;">
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
        elseif($user['role'] == 'ibu'){
            header("Location: ibu_index.php");
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