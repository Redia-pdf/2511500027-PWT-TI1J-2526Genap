<h4 class="mb-4 text-pink">
    Selamat Datang di Sistem Pemantauan ASI Posyandu
</h4>
<?php
$ibu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM ibu"));
$bayi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM bayi"));
$asi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pemberian_asi"));
$pemantauan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pemantauan_berat_badan"));
?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $ibu['total']; ?></h3>
                <p>Data Ibu</p>
            </div>
            <div class="icon">
                <i class="fas fa-female"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $bayi['total']; ?></h3>
                <p>Data Bayi</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $asi['total']; ?></h3>
                <p>Pemberian ASI</p>
            </div>
            <div class="icon">
                <i class="fas fa-tint"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $pemantauan['total']; ?></h3>
                <p>Pemantauan BB</p>
            </div>
            <div class="icon">
                <i class="fas fa-weight"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background:#e91e63;color:white;">
                <h3 class="card-title" style="color:white;">
                    <i class="fas fa-history"></i>
                    Aktivitas Terbaru
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Aktivitas</th>
                            <th>Kode</th>
                            <th>Nama Bayi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $aktivitas = mysqli_query($koneksi, " SELECT pa.id_asi AS kode, b.nm_bayi, dpa.tanggal_pengisian AS tanggal, 'pemberian asi' AS aktivitas
                        FROM pemberian_asi pa JOIN bayi b ON pa.id_bayi = b.id_bayi JOIN detail_pemberian_asi dpa ON pa.id_asi = dpa.id_asi UNION ALL
                        SELECT pb.id_pemantauan AS kode,b.nm_bayi, dpb.tanggal_pantau AS tanggal,'pemantauan berat badan' AS aktivitas FROM pemantauan_berat_badan pb JOIN bayi b ON pb.id_bayi = b.id_bayi JOIN detail_pemantauan_berat_badan dpb ON pb.id_pemantauan = dpb.id_pemantauan
                        ORDER BY tanggal DESC LIMIT 5") or die(mysqli_error($koneksi));
                        while($a=mysqli_fetch_array($aktivitas)){
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $a['aktivitas']; ?></td>
                                <td><?= $a['kode']; ?></td>
                                <td><?= $a['nm_bayi']; ?></td>
                                <td><?= date('d-m-Y', strtotime($a['tanggal'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</div>
