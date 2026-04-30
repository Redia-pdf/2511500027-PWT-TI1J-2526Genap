<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>
<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM ektrakurikuler WHERE kd_ekskul='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstrakurikuler">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstrakurikuler" class="btn btn-primary btn-sm">Tambah Ekstrakurikuler</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Kd Ekstrakurikuler</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query= mysqli_query($koneksi, "SELECT 
                        ektrakurikuler.*,
                        g1.nm_guru AS pembimbing1,
                        g2.nm_guru AS pembimbing2
                    FROM ektrakurikuler
                    LEFT JOIN guru g1 ON ektrakurikuler.pembimbing_1 = g1.kd_guru
                    LEFT JOIN guru g2 ON ektrakurikuler.pembimbing_2 = g2.kd_guru
                    ");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['kd_ekskul']; ?></td>
                                <td><?= $result['nm_ekskul']; ?></td>
                                <td><?= $result['pembimbing1']; ?></td>
                                <td><?= $result['pembimbing2']; ?></td>
                                <td>
                                    <a href="index.php?page=ekstrakurikuler&action=hapus&kd=<?= $result['kd_ekskul']
                                                                                    ?>" title="">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_ekstrakurikuler&kd=<?= $result['kd_ekskul'] ?>" title="">
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
    