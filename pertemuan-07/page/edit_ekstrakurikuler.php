<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakurikuler </h1>
            </div>
        </div>
    </div>
</div>
<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ektrakurikuler WHERE kd_ekskul='$kd' "));

if (isset($_POST['tambah'])) {
    $kd_ekskul = $_POST['kd_ekskul'];
    $nm_ekskul = $_POST['nm_ekskul'];
    $pembimbing_1 = $_POST['pembimbing_1']?: '-';
    $pembimbing_2 = $_POST['pembimbing_2']?: '-';

    $insert = mysqli_query($koneksi, "UPDATE ektrakurikuler SET nm_ekskul='$nm_ekskul', pembimbing_1='$pembimbing_1', pembimbing_2='$pembimbing_2' WHERE kd_ekskul='$kd_ekskul'");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstrakurikuler">';
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
                            <label for="kd_ekskul">Kode Ekstrakurikuler</label>
                            <input type="text" name="kd_ekskul" value="<?= $edit['kd_ekskul']; ?>" class="form-control" readonly>  
                        </div>
                        <div class="form-group">
                            <label for="nm_ekskul">Nama Ekstrakurikuler</label>
                            <input type="text" name="nm_ekskul" value="<?= $edit['nm_ekskul']; ?>" id="nm_ekskul" placeholder="Nama Ekstrakurikuler" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pembimbing_1">Pembimbing 1</label>
                            <select class="form-control" name="pembimbing_1" required>
                                <option value="">--Pilih Pembimbing 1--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>" <?= ($edit['pembimbing_1'] == $returnguru['kd_guru']) ? 'selected' : ''; ?>><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                                <option value="">-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing_2">Pembimbing 2</label>
                            <select class="form-control" name="pembimbing_2" required>
                                <option value="">--Pilih Pembimbing 2--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>" <?= ($edit['pembimbing_2'] == $returnguru['kd_guru']) ? 'selected' : ''; ?>><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                                <option value="">-</option>
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
