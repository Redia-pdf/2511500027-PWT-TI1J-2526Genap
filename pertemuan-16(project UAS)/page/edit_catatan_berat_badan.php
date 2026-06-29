<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Catatan Pemantauan Berat Badan</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id_ibu = $_SESSION['username'];
$id_pemantauan = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi," SELECT * FROM pemantauan_berat_badan pb JOIN bayi b ON pb.id_bayi=b.id_bayi WHERE pb.id_pemantauan='$id_pemantauan' AND b.id_ibu='$id_ibu' "));
if (isset($_POST['simpan'])) {
    $id_pemantauan = $_POST['id_pemantauan'];
    $id_bayi = $_POST['id_bayi'];
    $cek = mysqli_query($koneksi," SELECT * FROM bayi WHERE id_bayi='$id_bayi' AND id_ibu='$id_ibu' ");
if(mysqli_num_rows($cek)==0){
    die("Data bayi tidak valid.");
}
    mysqli_query($koneksi, " UPDATE pemantauan_berat_badan SET id_bayi='$id_bayi' WHERE id_pemantauan='$id_pemantauan'");
    //hapus seluruh detail lama
    mysqli_query($koneksi, " DELETE FROM detail_pemantauan_berat_badan WHERE id_pemantauan='$id_pemantauan' ");
    $tanggal = $_POST['tanggal_pantau'];
    $berat = $_POST['berat_badan'];
    for ($i = 0; $i < count($tanggal); $i++) {
        if ($tanggal[$i] != "" && $berat[$i] != "") {
            mysqli_query($koneksi, " INSERT INTO detail_pemantauan_berat_badan (id_pemantauan,tanggal_pantau,berat_badan) VALUES
            ('$id_pemantauan', '{$tanggal[$i]}', '{$berat[$i]}') ");
        }
    }
    echo "<div class='alert alert-success'> Data berhasil diubah </div>";
    echo "<meta http-equiv='refresh' content='1;url=ibu_index.php?page=catatan_berat_badan'>";
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>Kode Pemantauan</label>
                        <input type="text" name="id_pemantauan" value="<?= $data['id_pemantauan']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Bayi</label>
                        <select name="id_bayi" class="form-control">
                            <?php
                           $q = mysqli_query($koneksi," SELECT * FROM bayi WHERE id_ibu='$id_ibu' ORDER BY nm_bayi ");
                            while ($b = mysqli_fetch_array($q)) {
                            ?>
                                <option value="<?= $b['id_bayi']; ?>"
                                    <?= ($b['id_bayi'] == $data['id_bayi']) ? 'selected' : ''; ?>>
                                    <?= $b['nm_bayi']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr>
                    <div id="detail-asi">
                        <?php
                        $detail = mysqli_query($koneksi, "SELECT * FROM detail_pemantauan_berat_badan WHERE id_pemantauan='$id_pemantauan' ORDER BY tanggal_pantau");
                        while ($d = mysqli_fetch_array($detail)) {
                        ?>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label>Tanggal Pemantauan</label>
                                    <input
                                        type="date"
                                        name="tanggal_pantau[]"
                                        class="form-control"
                                        value="<?= $d['tanggal_pantau']; ?>"
                                        required>
                                </div>
                                <div class="col-md-5">
                                    <label>Berat Badan</label>
                                    <input
                                        type="text"
                                        name="berat_badan[]"
                                        class="form-control"
                                        value="<?= $d['berat_badan']; ?>"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-block" onclick="HapusBaris(this)"> Hapus </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button
                        type="button"
                        class="btn btn-success"
                        onclick="TambahBaris()">
                        + Tambah Data
                    </button>
                    <hr>
                    <input
                        type="submit"
                        name="simpan"
                        value="Simpan Perubahan"
                        class="btn btn-primary" style="background-color: #e91e63; border-color: #e91e63; font-weight: bold;">
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    function TambahBaris() {
        let container = document.getElementById('detail-asi');
        let row = container.firstElementChild.cloneNode(true);
        row.querySelectorAll('input').forEach(function(input) {
            if (input.type == "date")
                input.value = "";
            if (input.type == "text")
                input.value = "";
        });
        container.appendChild(row);
    }

    function HapusBaris(btn) {
        let container = document.getElementById('detail-asi');
        if (container.children.length > 1) {
            btn.closest('.row').remove();
        } else {
            alert("Minimal harus ada satu detail.");
        }
    }
</script>