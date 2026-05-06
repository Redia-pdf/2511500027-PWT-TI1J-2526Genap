<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakurikuler </h1>
            </div>
        </div>
    </div>
</div>
<?php
//Kode Otomatis untuk Kd Ekstrakurikuler//
$carikode = mysqli_query($koneksi, "select max(kd_ekskul) from ektrakurikuler") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "E-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "E-";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $kd_ekskul = $_POST['kd_ekskul'];
    $nm_ekskul = $_POST['nm_ekskul'];
    $pembimbing_1 = $_POST['pembimbing_1']?: '-';
    $pembimbing_2 = $_POST['pembimbing_2']?: '-';

    $insert = mysqli_query($koneksi, "INSERT INTO ektrakurikuler values ('$kd_ekskul','$nm_ekskul','$pembimbing_1','$pembimbing_2')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstrakurikuler">';
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
                            <label for="kd_ekskul">Kode Ekstrakurikuler</label>
                            <input type="text" name="kd_ekskul" value="<?= $hasilkode; ?>" placeholder="Id Kat" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_ekskul">Nama Ekstrakurikuler</label>
                            <input type="text" name="nm_ekskul" id="nm_ekskul" placeholder="Nama Ekstrakurikuler" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing_1">Pembimbing 1</label>
                            <select class="form-control" name="pembimbing_1" required>
                                <option value="">--Pilih Pembimbing 1--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>"><?= $returnguru['nm_guru']; ?></option>
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
                                    <option value="<?= $returnguru['kd_guru']; ?>"><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                                   <option value="">-</option>
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