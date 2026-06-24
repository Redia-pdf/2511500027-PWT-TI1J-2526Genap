<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Kelas</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis//
$carikode = mysqli_query($koneksi, "select max(id_jadwal) from jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "1" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "1001";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $id_kelas = $_POST['id_kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $semester = $_POST['semester'];

    $insert = mysqli_query($koneksi, "INSERT INTO jadwal_kelas values ('$id_jadwal','$id_kelas','$tahun_ajaran','$semester')");
    
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>  
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="id_jadwal">ID Jadwal</label>
                            <input type="text" name="id_jadwal" value="<?= $hasilkode; ?>" placeholder="ID Jadwal" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">ID Kelas</label>
                            <select class="form-control" name="id_kelas" required>
                                <option value="" disabled selected>--Pilih Kelas--</option>
                                <?php
                                $getkelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($returnkelas = mysqli_fetch_array($getkelas)) {
                                ?>
                                    <option value="<?= $returnkelas['id_kelas']; ?>"><?= $returnkelas['nm_kelas']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <select class="form-control" name="tahun_ajaran" required>
                                <option value="" disabled selected>--Pilih Tahun Ajaran--</option>
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2022/2023</option>
                                    <option value="2023/2024">2023/2024</option>
                                    <option value="2024/2025">2024/2025</option>
                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>