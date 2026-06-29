<style>
.small-box{
    border-radius:15px;
    box-shadow:0 8px 18px rgba(0,0,0,.12);
}

.card-header{
    background:#fff0f6;
    color:#e91e63;
    font-weight:bold;
    font-size:22px;
}
.table th{
    background:#fce4ec;
    color:#e91e63;
}

.table td{
    vertical-align:middle;
}
.nav-sidebar .nav-link.active{
    background:#ff4f8b!important;
    color:white!important;
    border-radius:8px;
}

.small-box{
    transition: .3s;
}

.small-box:hover{
    transform: translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
</style>
<?php
$username = $_SESSION['username'];

// Data ibu
$ibu = mysqli_fetch_array(mysqli_query($koneksi, " SELECT * FROM ibu WHERE id_ibu='$username' "));

// Total bayi milik ibu
$qBayi = mysqli_query($koneksi, " SELECT COUNT(*) AS total FROM bayi WHERE id_ibu='$username' ");
$totalBayi = mysqli_fetch_array($qBayi);

// Total pemberian ASI
$qAsi = mysqli_query($koneksi, " SELECT COUNT(*) AS total FROM pemberian_asi pa JOIN bayi b ON pa.id_bayi=b.id_bayi WHERE b.id_ibu='$username' ");
$totalAsi = mysqli_fetch_array($qAsi);
// Total pemantauan BB
$qBB = mysqli_query($koneksi, " SELECT COUNT(*) AS total FROM pemantauan_berat_badan pb JOIN bayi b ON pb.id_bayi=b.id_bayi WHERE b.id_ibu='$username'");
$totalBB = mysqli_fetch_array($qBB);
?>
<h3 class="mb-4 text-pink">
    Selamat Datang,
    <b><?= $ibu['nm_ibu']; ?></b> 👋
</h3>
<p class="text-muted">
    <?= date('l, d F Y'); ?>
</p>
<p class="text-muted">
    Selamat datang di Sistem Pemantauan ASI Posyandu.
    Silakan melakukan pencatatan pemberian ASI dan pemantauan berat badan bayi Anda secara rutin.
</p>
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-pink">
            <div class="inner">
                <h3><?= $totalBayi['total']; ?></h3>
                <p>Data Bayi</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalAsi['total']; ?></h3>
                <p>Riwayat Pemberian ASI</p>
            </div>
            <div class="icon">
                <i class="fas fa-tint"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalBB['total']; ?></h3>
                <p>Pemantauan Berat Badan</p>
            </div>
            <div class="icon">
                <i class="fas fa-weight"></i>
            </div>
        </div>
    </div>
</div>
    <a href="ibu_index.php?page=catatan_asi" class="btn btn-lg text-white mr-2 mb-2" Style="background:#ff5c8d;border-radius:10px;">
        <i class="fas fa-tint mr-2"></i>Catat ASI</a>

    <a href="ibu_index.php?page=catatan_berat_badan" class="btn btn-lg text-white mr-2 mb-2" Style="background:#ff5c8d;border-radius:10px;">
        <i class="fas fa-weight mr-2"></i>Catat Berat Badan</a>
<br>
<div class="row">
    <div class="col-md-7">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h5 class="card-title">Data Bayi</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr style="background:#f8f9fa">
                        <th>Nama Bayi</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                    <?php
                    $data = mysqli_query($koneksi, " SELECT * FROM bayi WHERE id_ibu='$username' ");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?= $d['nm_bayi']; ?></td>
                            <td><?= $d['jenis_kelamin']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h5 class="card-title">
                    Tips Hari Ini
                </h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>Berikan ASI eksklusif sampai usia 6 bulan.</li>
                    <li>Lakukan penimbangan berat badan setiap bulan.</li>
                    <li>Catat setiap pemberian ASI agar perkembangan bayi mudah dipantau.</li>
                    <li>Datang ke Posyandu sesuai jadwal.</li>
                </ul>
            </div>
        </div>
    </div>
</div>