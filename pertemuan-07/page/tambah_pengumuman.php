<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pengumuman</h1>
            </div>
        </div>
    </div>
</div>
<?php
//Kode Otomatis untuk Kd Pengumuman//
$carikode = mysqli_query($koneksi, "select max(id_pengumuman) from pengumuman") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "1" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "1";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_pengumuman = $_POST['id_pengumuman'];
    $judul_pengumuman = $_POST['judul_pengumuman'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $id_guru = $_POST['id_guru'];

    $insert = mysqli_query($koneksi, "INSERT INTO pengumuman values ('$id_pengumuman','$judul_pengumuman','$deskripsi','$tanggal','$id_guru')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pengumuman">';
    } else {
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div';
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
                            <label for="id_pengumuman">Kode Pengumuman</label>
                            <input type="text" name="id_pengumuman" value="<?= $hasilkode; ?>" placeholder="Id Pengumuman" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="judul_pengumuman">Judul Pengumuman</label>
                            <input type="text" name="judul_pengumuman" id="judul_pengumuman" placeholder="Judul Pengumuman" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_guru">Dibuat Oleh</label>
                            <select class="form-control" name="id_guru" required>
                                <option value="">--Pilih Guru--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>"><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                                   <option value="">-</option>
                                   <option value="">Anonim</option>
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