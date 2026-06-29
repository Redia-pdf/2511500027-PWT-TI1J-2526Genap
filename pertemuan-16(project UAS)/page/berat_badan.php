<?php
if (isset($_GET['hapus'])) {
    $id_pemantauan = $_GET['hapus'];

    // Hapus detail pemantauan berat badan
    mysqli_query($koneksi, "DELETE FROM detail_pemantauan_berat_badan WHERE id_pemantauan='$id_pemantauan'");

    // Hapus data utama
    $hapus = mysqli_query($koneksi, "DELETE FROM pemantauan_berat_badan WHERE id_pemantauan='$id_pemantauan'");

    if ($hapus) {
        echo "<div class='alert alert-success alert-dismissible fade show'>
        <strong>Berhasil!</strong> Data pemantauan berat badan berhasil dihapus.
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
                <h1 class="m-0 text-dark">Data Pemantauan Berat Badan</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <a href="index.php?page=tambah_berat_badan"
                    class="btn btn-primary btn-sm"
                    style="background:#e91e63;border-color:#e91e63;">
                    Tambah Data Pemantauan Berat Badan
                </a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID Pemantauan</th>
                            <th>Nama Bayi</th>
                            <th>Detail Pemantauan Berat Badan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $query = mysqli_query($koneksi, "
                            SELECT *
                            FROM pemantauan_berat_badan pbb
                            JOIN bayi b
                            ON pbb.id_bayi=b.id_bayi
                        ");

                        while ($row = mysqli_fetch_assoc($query)) {

                            echo "<tr>

                                <td>{$row['id_pemantauan']}</td>

                                <td>{$row['nm_bayi']}</td>

                                <td>
                                    <ul>";

                            $detail = mysqli_query($koneksi, "
                                SELECT *
                                FROM detail_pemantauan_berat_badan
                                WHERE id_pemantauan='{$row['id_pemantauan']}'
                                ORDER BY tanggal_pantau
                            ");

                            while ($d = mysqli_fetch_assoc($detail)) {
                                $tgl = date('d-m-Y', strtotime($d['tanggal_pantau']));

                                echo "<li>{$tgl} - {$d['berat_badan']}</li>";
                            }
                            echo "</ul>
                               </td>
                                   <td>
                                    <a href='index.php?page=edit_berat_badan&id={$row['id_pemantauan']}'
                                    class='btn btn-warning btn-sm'>
                                    Edit
                                    </a>

                                    <a href='index.php?page=berat_badan&hapus={$row['id_pemantauan']}'
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