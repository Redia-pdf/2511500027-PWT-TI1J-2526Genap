<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Detail Jadwal</h1>
            </div>
        </div>
    </div>
</div>
<?php
$id_jadwal = isset($_GET['id_jadwal']) ? $_GET['id_jadwal'] : '';

if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal='$kd'");
        if ($query) {
            echo '<div class="alert alert-warning alert-dismissible">
    Berhasil dihapus!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=detail_jadwal">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_detail_jadwal&id_jadwal=<?= $id_jadwal; ?>" class="btn btn-primary btn-sm">Tambah Detail Jadwal</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Kd Detail Jadwal</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Nama Guru</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT 
                          detail_jadwal.*,
                    guru.nm_guru,
                    mapel.nm_mapel
                FROM detail_jadwal
                JOIN guru ON detail_jadwal.kd_guru = guru.kd_guru
                JOIN mapel ON detail_jadwal.kd_mapel = mapel.kd_mapel
                WHERE detail_jadwal.id_jadwal = '$id_jadwal'
            ");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_jadwal']; ?></td>
                                <td><?= $result['nm_mapel']; ?></td>
                                <td><?= $result['nm_guru']; ?></td>
                                <td><?= $result['hari']; ?></td>
                                <td><?= date('H:i', strtotime($result['jam_mulai'])); ?></td>
                                <td><?= date('H:i', strtotime($result['jam_selesai'])); ?></td>
                                <td>
                                    <a href="index.php?page=detail_jadwal&action=hapus&kd=<?= $result['id_jadwal'] ?>">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_detail_jadwal&id_jadwal=<?= $result['id_jadwal'] ?>" title="">
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