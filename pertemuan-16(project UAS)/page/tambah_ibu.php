<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ibu </h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis//
$carikode = mysqli_query($koneksi, "select max(id_ibu) from ibu") or die(mysqli_error($koneksi));
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
    $id_ibu = $_POST['id_ibu'];
    $nm_ibu = $_POST['nm_ibu'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];

    $insert = mysqli_query($koneksi, "INSERT INTO ibu values ('$id_ibu','$nm_ibu','$alamat','$nohp')") or die(mysqli_error($koneksi));
    $insertuser = mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$id_ibu', '1234', 'ibu')") or die(mysqli_error($koneksi));
    if ($insert && $insertuser) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>  
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ibu">';
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
                            <label for="id_ibu">Kode Ibu</label>
                            <input type="text" name="id_ibu" value="<?= $hasilkode; ?>" placeholder="Id Ibu" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_ibu">Nama Ibu</label>
                            <input type="text" name="nm_ibu" id="nm_ibu" placeholder="Nama Ibu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP</label>
                            <input type="number" name="nohp" id="nohp" placeholder="No HP" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan"style="background-color: #e91e63; border-color: #e91e63;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>