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
    if (isset($_GET['action'])) {
        if ($_GET['action'] == "hapus") {
            $kd = $_GET['kd'];
            $query = mysqli_query($koneksi, "DELETE FROM bayi WHERE id_bayi='$kd'");
            if ($query) {
                echo '<div class="alert alert-warning alert-dismissible">
        Berhasil dihapus!</div>';
                echo '<meta http-equiv="refresh" content="1;url=index.php?page=bayi">';
            }
        }
    }
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="index.php?page=tambah_bayi" class="btn btn-primary btn-sm" style="background-color: #e91e63; border-color: #e91e63;">Tambah Data Bayi</a>
                    <table class="table table-striped">
                        <tread>
                            <tr>
                                <th>No</th>
                                <th>ID Bayi</th>
                                <th>Nama Bayi</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Ibu</th>
                                <th>Aksi</th>
                            </tr>
                        </tread>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM bayi JOIN ibu ON bayi.id_ibu=ibu.id_ibu");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $result['id_bayi']; ?></td>
                                    <td><?= $result['nm_bayi']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($result['tanggal_lahir'])); ?></td>
                                    <td><?= $result['jenis_kelamin']; ?></td>
                                    <td><?= $result['nm_ibu']; ?></td>
                                    <td>
                                        <a href="index.php?page=bayi&action=hapus&kd=<?= $result['id_bayi'] ?>" title="">
                                            <span class="badge badge-danger">Hapus</span>
                                        </a>
                                        <a href="index.php?page=edit_bayi&kd=<?= $result['id_bayi'] ?>" title="">
                                            <span class="badge badge-success">Edit</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>