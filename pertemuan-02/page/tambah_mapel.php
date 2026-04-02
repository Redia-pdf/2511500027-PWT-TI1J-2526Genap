<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data mata Pelajaran </h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis
$carikode = mysqli_query($koneksi, "select max(kd_mapel) from mapel") or die(mysqli_error());
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "M-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {$hasilkode = "M-";
$_SESSION["KODE"] = $hasilkode;
if(isset($_POST['tambah'])){
    $kd_mapel = $_POST['kd_mapel'];
    $nm_mapel = $_POST['nm_mapel'];
    $kkm = $_POST['kkm'];
    $insert = mysqli_query($koneksi, "INSERT INTO mapel values ('$kd_mapel','$nm_mapel','$kkm')");
    if($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    }else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Gagal Disimpan</div>';
    }
}
    ?>