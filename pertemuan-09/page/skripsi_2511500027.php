`<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Skripsi</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM skripsi_2511500027 WHERE id_skripsi_027='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_2511500027">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_skripsi_2511500027" class="btn btn-primary btn-sm">Tambah Skripsi</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Id Skripsi</th>
                            <th>Judul Skripsi</th>
                            <th>Topik Skripsi</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM skripsi_2511500027");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_skripsi_027']; ?></td>
                                <td><?= $result['judul_skripsi_027']; ?></td>
                                <td><?= $result['topik_skripsi_027']; ?></td>
                                <td><?= $result['semester_027']; ?></td>
                                <td><?= $result['thn_ajaran_027']; ?></td>
                                <td>
                                    <a href="index.php?page=skripsi_2511500027&action=hapus&kd=<?= $result['id_skripsi_027'] ?>" title="">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_skripsi_2511500027&kd=<?= $result['id_skripsi_027'] ?>" title="">
                                        <span class="badge badge-success">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>`