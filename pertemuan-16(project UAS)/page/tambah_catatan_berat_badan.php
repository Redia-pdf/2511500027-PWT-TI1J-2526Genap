<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Catatan Berat Badan</h1>
            </div>
        </div>
    </div>
</div>
<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(id_pemantauan) FROM pemantauan_berat_badan") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "4" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "4001"; // atau bisa juga default "M-001"
}

$_SESSION['KODE'] = $hasilkode;
$id_ibu = $_SESSION['username'];
if (isset($_POST['simpan'])) {
    $id_pemantauan = $_POST['id_pemantauan'];
    $id_bayi = $_POST['id_bayi'];
    // Simpan data utama
    $insert = mysqli_query($koneksi, " INSERT INTO pemantauan_berat_badan (id_pemantauan, id_bayi) VALUES ('$id_pemantauan','$id_bayi') ");
if(!$insert){
    die(mysqli_error($koneksi));
}
    $tanggal = $_POST['tanggal_pantau'];
    $jumlah  = $_POST['berat_badan'];
    for ($i = 0; $i < count($tanggal); $i++) {
        if ($tanggal[$i] != "" && $jumlah[$i] != "") {
            $detail = mysqli_query ($koneksi, "INSERT INTO detail_pemantauan_berat_badan (id_pemantauan, tanggal_pantau, berat_badan)
            VALUES ('$id_pemantauan', '{$tanggal[$i]}', '{$jumlah[$i]}')
");
        }
    }
    echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">X</button>
          <strong>Berhasil!</strong> Data berhasil disimpan.
          </div>';
    echo '<meta http-equiv="refresh"
          content="1;url=ibu_index.php?page=catatan_asi">';
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>Kode Pemantauan</label>
                        <input type="text" name="id_pemantauan" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Bayi</label>
                        <select name="id_bayi" class="form-control" required>
                            <option value="">-- Pilih Bayi -- </option>
                            <?php
                            $query = mysqli_query($koneksi, " SELECT * FROM bayi WHERE id_ibu='$id_ibu' ORDER BY nm_bayi ");
                            while ($bayi = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?= $bayi['id_bayi']; ?>">
                                    <?= $bayi['nm_bayi']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr>
                    <div id="detail-asi">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label>Tanggal Pemantauan</label>
                                <input type="date" name="tanggal_pantau[]" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label>Berat Badan</label>
                                <input type="text" name="berat_badan[]" class="form-control" placeholder="Contoh: 3.5 kg" required>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-danger btn-block" onclick="HapusBaris(this)"> Hapus</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" onclick="TambahBaris()">+ Tambah Data</button>
                    <hr>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" style="background-color: #e91e63; border-color: #e91e63;">
                </form>
                <script>
                    function TambahBaris() {
                        let container = document.getElementById('detail-asi');
                        let row = container.firstElementChild.cloneNode(true);
                        row.querySelectorAll('input').forEach(input => input.value = '');
                        container.appendChild(row);
                    }

                    function HapusBaris(btn) {
                        let container = document.getElementById('detail-asi');
                        // Minimal harus tersisa satu baris
                        if (container.children.length > 1) { btn.closest('.row').remove();
                        } else {
                            alert("Minimal harus ada satu detail pemberian ASI.");
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</section>