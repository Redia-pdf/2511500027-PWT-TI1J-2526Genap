<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Ibu </h1>
            </div>
        </div>
    </div>
</div>
<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ibu WHERE id_ibu='$kd' "));

if(isset($_POST['tambah'])){
    $id_ibu = $_POST['id_ibu'];
    $nm_ibu = $_POST['nm_ibu'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];

    $insert = mysqli_query($koneksi, "UPDATE ibu SET nm_ibu='$nm_ibu', alamat='$alamat', nohp='$nohp' WHERE id_ibu='$id_ibu'");
    if($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ibu">';
    }else{
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
                                <input type="text" name="id_ibu" value="<?= $edit['id_ibu']; ?>" class="form-control" readonly>
                            </div>                                              
                            <div class="form-group">
                                <label for="nm_ibu">Nama Ibu</label>
                                <input type="text" name="nm_ibu" value="<?= $edit['nm_ibu']; ?>" id="nm_ibu" placeholder="Nama Ibu" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"><?= $edit['alamat']; ?></textarea>
                            </div>
                                                        <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="text" name="nohp" value="<?= $edit['nohp']; ?>" id="nohp" placeholder="No HP" class="form-control">
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="Simpan" style="background-color: #e91e63; border-color: #e91e63;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </section>

