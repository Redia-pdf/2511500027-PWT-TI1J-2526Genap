    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard Siswa</h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    $nis = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
    $data = mysqli_fetch_array($query);
    ?>          

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title-extra-bold mb-2; font-weight-bold">HALO, <?= $data['nm_siswa']; ?> 👋 </h5>
                    <p class="card-text mb-0">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $jam = date('H:i');
                        if ($jam >= '05:00' && $jam < '11:00') {
                            echo "Selamat Pagi";
                        } elseif ($jam >= '11:00' && $jam < '15:00') {
                            echo "Selamat Siang";
                        } elseif ($jam >= '15:00' && $jam < '18:00') {
                            echo "Selamat Sore";
                        } else {
                            echo "Selamat Malam";
                        }
                        ?>, Selamat Datang di Website Sekolah.</p>
                        <p class="mb-0">Terus Semangat Belajar dan Semoga Harimu Menyenangkan!</p>
                </div>
            </div>
        </div>
    </div>          
