<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Biodata Siswa </h1>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $nis = $_GET['nis'];
        $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
        $data = mysqli_fetch_array($query);
    }
}
if (isset($_POST['edit'])) {
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];

    $update = mysqli_query($koneksi, "UPDATE siswa SET nm_siswa='$nm_siswa', jenkel='$jenkel', hp='$hp' WHERE nis='$nis'");
    if ($update) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=siswa_index.php?page=biodata">';
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
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" value="<?= $data['nis']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group
">
                            <label for="nm_siswa">Nama Siswa</label>
                            <input type="text" name="nm_siswa" value="<?= $data['nm_siswa']; ?>" id="nm_siswa" placeholder="Nama Siswa" class="form-control">
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
                            <label for="hp">No HP</label>
                            <input type="text" name="hp" value="<?= $data['hp']; ?>" id="hp" placeholder="No HP" class="form-control">
                        </div>
                        <div class="card-group">
                            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                            <a href="siswa_index.php?page=biodata" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>