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
            } elseif ($role == 'ibu') {
                header("Location: ibu_index.php");
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
        <img src="dist/img/POSYANDU1.png" alt="Logo Posyandu" class="logo-login"  style="filter: brightness(0) saturate(100%)
                invert(24%) sepia(95%)
                saturate(2255%)
                hue-rotate(315deg)
                brightness(99%)
                contrast(105%);">
        <br>
        <a href="#" style="color:#e91e63;" style="font-size: 50px; font-weight: bold;">
            <b>Sistem Pemantauan ASI</b>
        </a>
        <p style="font-size:16px;color:#777;">
            Posyandu Sehat Ibu & Bayi
        </p>
    </div>
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
            <input type="password" name="password" id="password" class="form-control" placeholder="Password Baru">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
                <div class="input-group-text">
                <span id="toggle-password" class="fas fa-eye" style="cursor: pointer;"></span>
                </div>
            </div>
            </div>
            <div id="password-error" class="text-danger" style="display: none;">Password minimal 8 karakter</div>

            <div class="row">
            <div class="col-12">
                <button type="submit" name="ganti" class="btn btn-primary btn-block" style="background-color: #e91e63; border-color: #e91e63;">
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

    <script>
    $(document).ready(function() {
        $('#password').on('input', function() {
            var password = $(this).val();
            if (password.length < 8) {
                $('#password-error').show();
            } else {
                $('#password-error').hide();
            }
        });

        $('form').on('submit', function(e) {
            var password = $('#password').val();
            if (password.length < 8) {
                e.preventDefault();
                $('#password-error').show();
            }
        });

        $('#toggle-password').on('click', function() {
            var passwordInput = $('#password');
            var icon = $(this);
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
    </script>

    </body>
    </html>