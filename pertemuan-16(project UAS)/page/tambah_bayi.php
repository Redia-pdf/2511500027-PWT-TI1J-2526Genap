<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Bayi</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis//
$carikode = mysqli_query($koneksi, "select max(id_bayi) from bayi") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "3" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "3001";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_bayi = $_POST['id_bayi'];
    $nm_bayi = $_POST['nm_bayi'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id_ibu = $_POST['id_ibu'];

    $insert = mysqli_query($koneksi, "INSERT INTO bayi values ('$id_bayi','$nm_bayi','$tanggal_lahir','$jenis_kelamin','$id_ibu')");
    
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>  
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=bayi">';
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
                            <label for="id_bayi">ID Bayi</label>
                            <input type="text" name="id_bayi" value="<?= $hasilkode; ?>" placeholder="ID Bayi" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_bayi">Nama Bayi</label>
                            <input type="text" name="nm_bayi" id="nm_bayi" placeholder="Nama Bayi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_ibu">ID Ibu</label>
                            <select class="form-control" name="id_ibu" required>
                                <option value="" disabled selected>--Pilih Ibu--</option>
                                <?php
                                $getibu = mysqli_query($koneksi, "SELECT * FROM ibu");
                                while ($returnibu = mysqli_fetch_array($getibu)) {
                                ?>
                                    <option value="<?= $returnibu['id_ibu']; ?>"><?= $returnibu['nm_ibu']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan" style="background-color: #e91e63; border-color: #e91e63;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>