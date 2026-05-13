<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Skripsi </h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis//
$carikode = mysqli_query($koneksi, "select max(id_skripsi_027) from skripsi_2511500027") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "SK".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {$hasilkode = "SK"; }
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $id_skripsi_027 = $_POST['id_skripsi_027'];
    $judul_skripsi_027 = $_POST['judul_skripsi_027'];
    $topik_skripsi_027 = $_POST['topik_skripsi_027'];
    $semester_027 = $_POST['semester_027'];
    $thn_ajaran_027 = $_POST['thn_ajaran_027'];

    $insert = mysqli_query($koneksi, "INSERT INTO skripsi_2511500027 values ('$id_skripsi_027','$judul_skripsi_027','$topik_skripsi_027','$semester_027','$thn_ajaran_027')");
    if($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_2511500027">';
    }else{
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
                                <label for="id_skripsi_027">Id Skripsi</label>
                                <input type="text" name="id_skripsi_027" value="<?= $hasilkode; ?>" placeholder="Id Skripsi" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="judul_skripsi_027">Judul Skripsi</label>
                                <input type="text" name="judul_skripsi_027" id="judul_skripsi_027" placeholder="Judul Skripsi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="topik_skripsi_027">Topik Skripsi</label>
                                <input type="text" name="topik_skripsi_027" id="topik_skripsi_027" placeholder="Topik Skripsi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="semester_027">Semester</label>
                                <select name="semester_027" id="semester_027" class="form-control" required>
                                    <option value="" disabled selected>Pilih Semester</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thn_ajaran_027">Tahun Ajaran</label>
                                <select name="thn_ajaran_027" id="thn_ajaran_027" class="form-control" required>
                                    <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2022/2023</option>
                                    <option value="2023/2024">2023/2024</option>
                                    <option value="2024/2025">2024/2025</option>
                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>
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
    