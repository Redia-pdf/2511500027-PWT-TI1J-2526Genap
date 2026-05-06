<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pengumuman</h1>
            </div>
        </div>
    </div>
</div>
<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM pengumuman WHERE id_pengumuman='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=pengumuman">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_pengumuman" class="btn btn-primary btn-sm">Tambah Pengumuman</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Judul Pengumuman</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query= mysqli_query($koneksi, "SELECT 
                        pengumuman.*,
                        guru.nm_guru AS dibuat_oleh
                    FROM pengumuman
                    LEFT JOIN guru ON pengumuman.id_guru = guru.kd_guru
                    ");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $result['judul_pengumuman']; ?></td>
                                    <td><?= $result['deskripsi']; ?></td>
                                    <td><?= $result['tanggal']; ?></td>
                                    <td><?= $result['dibuat_oleh']; ?></td>
                                    <td>
                                    <a href="index.php?page=pengumuman&action=hapus&kd=<?= $result['id_pengumuman']
                                                                                    ?>" title="">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_pengumuman&kd=<?= $result['id_pengumuman'] ?>" title="">
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
    