<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Pemberian ASI</h1>
            </div>
        </div>
    </div>
</div>
<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(id_asi) FROM pemberian_asi") or die(mysqli_error($koneksi));
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
if (isset($_POST['simpan'])) {
    $id_asi = $_POST['id_asi'];
    $id_bayi = $_POST['id_bayi'];
    // Simpan data utama
    mysqli_query($koneksi, "INSERT INTO pemberian_asi (id_asi, id_bayi)
                            VALUES ('$id_asi', '$id_bayi')");
    $tanggal = $_POST['tanggal_pengisian'];
    $jumlah  = $_POST['jumlah_pemberian'];
    for ($i = 0; $i < count($tanggal); $i++) {
        if ($tanggal[$i] != "" && $jumlah[$i] != "") {
            $detail = mysqli_query ($koneksi, "INSERT INTO detail_pemberian_asi (id_asi, tanggal_pengisian, jumlah_pemberian)
            VALUES ('$id_asi', '{$tanggal[$i]}', '{$jumlah[$i]}')
");
        }
    }
    echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">X</button>
          <strong>Berhasil!</strong> Data berhasil disimpan.
          </div>';
    echo '<meta http-equiv="refresh"
          content="1;url=index.php?page=asi">';
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>Kode ASI</label>
                        <input type="text" name="id_asi" value="<?= $hasilkode ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Bayi</label>
                        <select name="id_bayi" class="form-control" required>
                            <option value="">-- Pilih Bayi -- </option>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM bayi ORDER BY nm_bayi");

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
                                <label>Tanggal Pengisian</label>
                                <input type="date" name="tanggal_pengisian[]" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label>Jumlah Pemberian</label>
                                <input type="text" name="jumlah_pemberian[]" class="form-control" placeholder="Contoh: 8x pemberian" required>
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
                        if (container.children.length > 1) {
                            btn.closest('.row').remove();
                        } else {
                            alert("Minimal harus ada satu detail pemberian ASI.");
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</section>