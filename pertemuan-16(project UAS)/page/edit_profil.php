<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profil </h1>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $nis = $_GET['id_ibu'];
        $query = mysqli_query($koneksi, "SELECT * FROM ibu WHERE id_ibu='$nis'");
        $data = mysqli_fetch_array($query);
    }
}
if (isset($_POST['edit'])) {
    $nis = $_POST['id_ibu'];
    $nm_ibu = $_POST['nm_ibu'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];

    $update = mysqli_query($koneksi, "UPDATE ibu SET nm_ibu='$nm_ibu', alamat='$alamat', nohp='$nohp' WHERE id_ibu='$nis'");
    if ($update) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=ibu_index.php?page=profil">';
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
                            <label for="id_ibu">ID Ibu</label>
                            <input type="text" name="id_ibu" value="<?= $data['id_ibu']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group
">
                            <label for="nm_ibu">Nama Ibu</label>
                            <input type="text" name="nm_ibu" value="<?= $data['nm_ibu']; ?>" id="nm_ibu" placeholder="Nama Ibu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" value="<?= $data['alamat']; ?>" id="alamat" placeholder="Alamat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="text" name="nohp" value="<?= $data['nohp']; ?>" id="nohp" placeholder="No HP" class="form-control">
                        </div>
                        <div class="card-group">
                            <button type="submit" name="edit" class="btn btn-primary" style="background-color: #e91e63; border-color: #e91e63;">Simpan</button>
                            <a href="ibu_index.php?page=profil" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>