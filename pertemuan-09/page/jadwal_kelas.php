<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['id_jadwal'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal_kelas" class="btn btn-primary btn-sm">Tambah Jadwal Kelas</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Jadwal</th>
                            <th>ID Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>semester</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas JOIN kelas ON jadwal_kelas.id_kelas=kelas.id_kelas");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_jadwal']; ?></td>
                                <td><?= $result['nm_kelas']; ?></td>
                                <td><?= $result['thn_ajaran']; ?></td>
                                <td><?= $result['semester']; ?></td>
                                <td>
                                    <a href="index.php?page=jadwal_kelas&action=hapus&id_jadwal=<?= $result['id_jadwal'] ?>" title="">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=detail_jadwal&id_jadwal=<?= $result['id_jadwal']; ?>">
                                        <span class="badge badge-success">Detail</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>