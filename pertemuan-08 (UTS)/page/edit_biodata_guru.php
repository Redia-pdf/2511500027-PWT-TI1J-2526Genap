<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Biodata Guru </h1>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $kd_guru = $_GET['kd_guru'];
        $query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd_guru'");
        $data = mysqli_fetch_array($query);
    }
}
if (isset($_POST['edit'])) {
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE guru SET nm_guru='$nm_guru', jenkel='$jenkel', pend_terakhir='$pend_terakhir', hp='$hp', alamat='$alamat' WHERE kd_guru='$kd_guru'");
    if ($update) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=guru_index.php?page=biodata_guru">';
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
                            <label for="kd_guru">KD Guru</label>
                            <input type="text" name="kd_guru" value="<?= $data['kd_guru']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_guru">Nama Guru</label>
                            <input type="text" name="nm_guru" value="<?= $data['nm_guru']; ?>" id="nm_guru" placeholder="Nama Guru" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <select name="jenkel" id="jenkel" class="form-control">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-laki" <?= $data['jenkel'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jenkel'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pend_terakhir">Pendidikan Terakhir</label>
                            <input type="text" name="pend_terakhir" value="<?= $data['pend_terakhir']; ?>" id="pend_terakhir" placeholder="Pendidikan Terakhir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hp">No HP</label>
                            <input type="text" name="hp" value="<?= $data['hp']; ?>" id="hp" placeholder="No HP" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"><?= $data['alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                            <a href="guru_index.php?page=biodata_guru" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>