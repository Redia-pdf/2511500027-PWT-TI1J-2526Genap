<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ibu</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM ibu WHERE id_ibu='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ibu">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ibu" class="btn btn-primary btn-sm"  style="background-color: #e91e63; border-color: #e91e63;">Tambah Data Ibu</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Ibu</th>
                            <th>Nama Ibu</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ibu");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_ibu']; ?></td>
                                <td><?= $result['nm_ibu']; ?></td>
                                <td><?= $result['alamat']; ?></td>
                                <td><?= $result['nohp']; ?></td>
                                <td>
                                    <a href="index.php?page=ibu&action=hapus&kd=<?= $result['id_ibu'] ?>" title="">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_ibu&kd=<?= $result['id_ibu'] ?>" title="">
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