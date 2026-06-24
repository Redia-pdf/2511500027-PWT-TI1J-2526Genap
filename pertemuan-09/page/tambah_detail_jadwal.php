<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Detail Jadwal </h1>
            </div>
        </div>
    </div>
</div>
<?php
$id_jadwal = $_GET['id_jadwal'];

if (isset($_POST['tambah'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $kd_mapel = $_POST['kd_mapel'];
    $kd_guru = $_POST['kd_guru'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];


    $insert = mysqli_query($koneksi, "INSERT INTO detail_jadwal values ('$id_jadwal','$kd_mapel','$kd_guru','$hari','$jam_mulai','$jam_selesai')");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=detail_jadwal&id_jadwal=' . $id_jadwal . '">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" arial-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
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
                            <label for="id_jadwal">Kode Jadwal</label>
                            <input type="text" name="id_jadwal" value="<?= $id_jadwal; ?>" placeholder="Id Jadwal" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kd_mapel">Kode Mata Pelajaran</label>
                            <select class="form-control" name="kd_mapel" required>
                                <option value="">--Pilih Mata Pelajaran--</option>
                                <?php
                                $getmapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                while ($returnmapel = mysqli_fetch_array($getmapel)) {
                                ?>
                                    <option value="<?= $returnmapel['kd_mapel']; ?>"><?= $returnmapel['nm_mapel']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kd_guru">Pembimbing 1</label>
                            <select class="form-control" name="kd_guru" required>
                                <option value="">--Pilih Guru--</option>
                                <?php
                                $getguru = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($returnguru = mysqli_fetch_array($getguru)) {
                                ?>
                                    <option value="<?= $returnguru['kd_guru']; ?>"><?= $returnguru['nm_guru']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select class="form-control" name="hari" required>
                                <option value="">--Pilih Hari--</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-group
">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" class="form-control" required>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>