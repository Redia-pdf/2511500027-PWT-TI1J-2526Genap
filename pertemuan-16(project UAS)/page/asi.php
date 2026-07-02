<?php
if (isset($_GET['hapus'])) {
    $id_asi = $_GET['hapus'];

    // Hapus detail pemberian ASI
    mysqli_query($koneksi, "DELETE FROM detail_pemberian_asi WHERE id_asi='$id_asi'");

    // Hapus data utama
    $hapus = mysqli_query($koneksi, "DELETE FROM pemberian_asi WHERE id_asi='$id_asi'");

    if ($hapus) {
        echo "<div class='alert alert-success alert-dismissible fade show'>
        <strong>Berhasil!</strong> Data pemberian ASI berhasil dihapus.
        <button type='button' class='close' data-dismiss='alert' arial-label='close'>
        <span>&times;</span>
        </button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show'>
        <strong>Gagal!</strong> Data tidak dapat dihapus.
        <button type='button' class='close' data-dismiss='alert'>
        <span>&times;</span>
        </button>
        </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pemberian ASI</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <a href="index.php?page=tambah_asi"
                    class="btn btn-primary btn-sm"
                    style="background:#e91e63;border-color:#e91e63;">
                    Tambah Data Pemberian ASI
                </a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID ASI</th>
                            <th>Nama Bayi</th>
                            <th>Detail Pemberian ASI</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $query = mysqli_query($koneksi, " SELECT * FROM pemberian_asi pa JOIN bayi b ON pa.id_bayi=b.id_bayi");
                        while ($row = mysqli_fetch_assoc($query)) {

                            echo "<tr>
                                <td>{$row['id_asi']}</td>
                                <td>{$row['nm_bayi']}</td>
                                <td>
                                    <ul>";
                            $detail = mysqli_query($koneksi, " SELECT * FROM detail_pemberian_asi WHERE id_asi='{$row['id_asi']}' ORDER BY tanggal_pengisian");

                            while ($d = mysqli_fetch_assoc($detail)) {
                                $tgl = date('d-m-Y', strtotime($d['tanggal_pengisian']));

                                echo "<li>{$tgl} - {$d['jumlah_pemberian']}</li>";
                            }
                            echo "</ul>
                               </td>
                                   <td>
                                    <a href='index.php?page=edit_asi&id={$row['id_asi']}'
                                     class='btn btn-warning btn-sm'>Edit</a>

                                    <a href='index.php?page=asi&hapus={$row['id_asi']}'
                                    onclick='return confirm(\"Yakin ingin menghapus data?\")'
                                    class='btn btn-danger btn-sm'>
                                    Hapus
                                    </a>

                                </td>

                            </tr>";
                         }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>