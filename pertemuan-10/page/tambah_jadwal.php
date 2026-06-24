<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>
<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "7" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "7001"; // atau bisa juga default "M-001"
}

$_SESSION['KODE'] = $hasilkode;

if(isset($_POST['tambah'])){
    $id_jadwal = $_POST['id_jadwal'];
    $id_kelas = $_POST['id_kelas'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $semester = $_POST['semester'];
    $kd_mapel = $_POST['kd_mapel'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $kd_guru = $_POST['kd_guru'];
   
    //insert ke tabel jadwal_kelas
    $insertjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_kelas VALUES ('$id_jadwal', '$id_kelas', '$thn_ajaran', '$semester')");
    if(!$insertjadwal){
        echo "Gagal insert ke tabel jadwal_kelas: " . mysqli_error($koneksi);
        die;
    }

    //insert ke tabel detail_jadwal
    $allSuccess = true;
    for ($i = 0; $i < count($kd_mapel); $i++) {
        $insert= mysqli_query($koneksi, "INSERT INTO detail_jadwal (id_jadwal, kd_mapel, hari,jam_mulai, kd_guru) VALUES ('$id_jadwal', '{$kd_mapel[$i]}', '{$hari[$i]}', '{$jam_mulai[$i]}', '{$kd_guru[$i]}')");
        if (!$insert) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($koneksi);
        }
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=jadwal">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal menyimpan sebagian atau seluruh data detail.</h4></div>';
    }
}

?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
              
            <h3>Tambah Jadwal</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Kode Jadwal</label>
                    <input type="text" name="id_jadwal" value="<?= $hasilkode ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="id_kelas" class="form-control">
                        <option value="">--Pilih Kelas--</option>
                        <?php
                        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                        while ($k = mysqli_fetch_assoc($kelas)) {
                            echo "<option value='{$k['id_kelas']}'>{$k['nm_kelas']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Semester</label>
                    <select name="semester" class="form-control" required>
                        <option selected disabled>--Pilih Semester--</option>
                        <option>ganjil</option>
                        <option>genap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <select name="thn_ajaran" class="form-control" required>
                        <option selected disabled>--Pilih Tahun Ajaran--</option>
                        <option>2023/2024</option>
                        <option>2024/2025</option>
                         <option>2025/2026</option>
                    </select>
                </div>
                <hr>
                <h5>Detail Jadwal</h5>
                <div id ="detail-jadwal">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select name="kd_mapel[]" class="form-control">
                                <option value="">--Pilih Mata Pelajaran--</option>
                                <?php
                                $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                while ($m = mysqli_fetch_assoc($mapel)) {
                                    echo "<option value='{$m['kd_mapel']}'>{$m['nm_mapel']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="hari[]" class="form-control" required>
                                <option selected disabled>--Pilih Hari--</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                            </select>
                    </div>
                    <div class="col-md-3">
                        <select name="jam_mulai[]" class="form-control" required>
                            <option selected disabled>--Plih Jam--</option>
                            <option>08.00-10.00</option>
                            <option>08.00-09.30</option>
                            <option>10.30-12.00</option>
                            <option>12.30-14.00</option>
                        </select>
                </div>
                <div class="col-md-3">
                    <select name="kd_guru[]" class="form-control" required>
                        <option value="">--Pilih Guru--</option>
                        <?php
                        $guru = mysqli_query($koneksi, "SELECT * FROM guru");
                        while ($g = mysqli_fetch_assoc($guru)) {
                            echo "<option value='{$g['kd_guru']}'>{$g['nm_guru']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-info" onclick="TambahBaris()">+ Tambah Mapel</button>
        <br><br>
        <input type="submit" name="tambah" value="Simpan Jadwal" class="btn btn-primary">
    </form>

    <script>
        function TambahBaris() {
            let container = document.getElementById('detail-jadwal');
            let row = container.firstElementChild.cloneNode(true);
            row.querySelectorAll('input').forEach(input => input.value = '');
            container.appendChild(row);
        }
    </script>
            </div>
        </div>
    </div>
</div>

