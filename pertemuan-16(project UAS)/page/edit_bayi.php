    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Bayi </h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    $kd = $_GET['kd'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bayi WHERE id_bayi='$kd' "));

    if (isset($_POST['tambah'])) {
        $id_bayi = $_POST['id_bayi'];
        $nm_bayi = $_POST['nm_bayi'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $id_ibu = $_POST['id_ibu'];

        $insert = mysqli_query($koneksi, "UPDATE bayi SET nm_bayi='$nm_bayi', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', id_ibu='$id_ibu' WHERE id_bayi='$id_bayi'");
        if ($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=bayi">';
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
                                <label for="id_bayi">ID Bayi</label>
                                <input type="text" name="id_bayi" value="<?= $edit['id_bayi']; ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nm_bayi">Nama Bayi</label>
                                <input type="text" name="nm_bayi" value="<?= $edit['nm_bayi']; ?>" id="nm_bayi" placeholder="Nama Bayi" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="<?= $edit['tanggal_lahir']; ?>" id="tanggal_lahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?= ($edit['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= ($edit['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
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
                                        <option value="<?= $returnibu['id_ibu']; ?>" <?= ($edit['id_ibu'] == $returnibu['id_ibu']) ? 'selected' : ''; ?>><?= $returnibu['nm_ibu']; ?></option>
                                    <?php } ?>
                                </select>
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