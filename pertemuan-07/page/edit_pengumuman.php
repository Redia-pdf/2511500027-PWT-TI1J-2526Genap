<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pengumuman</h1>
            </div>
        </div>
    </div>
</div>
<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id_pengumuman='$kd' "));

if (isset($_POST['tambah'])) {
    $id_pengumuman = $_POST['id_pengumuman'];
    $judul_pengumuman = $_POST['judul_pengumuman'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $id_guru = $_POST['id_guru'];

    $insert = mysqli_query($koneksi, "UPDATE pengumuman SET judul_pengumuman='$judul_pengumuman', deskripsi='$deskripsi', tanggal='$tanggal', id_guru='$id_guru' WHERE id_pengumuman='$id_pengumuman'");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pengumuman">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
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
                            <input type="text" name="id_pengumuman" value="<?= $edit['id_pengumuman']; ?>" class="form-control" readonly>  
                        </div>
                        <div class="form-group">
                            <label for="judul_pengumuman">Judul Pengumuman</label>
                            <input type="text" name="judul_pengumuman" value="<?= $edit['judul_pengumuman']; ?>" id="judul_pengumuman" placeholder="Judul Pengumuman" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control"><?= $edit['deskripsi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="<?= $edit['tanggal']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_guru">Dibuat Oleh</label>
                            <select class="form-control" name="id_guru" required>
                                <option value="">--Pilih Guru--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>" <?= ($edit['id_guru'] == $returnguru['kd_guru']) ? 'selected' : ''; ?>><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                                <option value="">-</option>
                                <option value="">Anonim</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
