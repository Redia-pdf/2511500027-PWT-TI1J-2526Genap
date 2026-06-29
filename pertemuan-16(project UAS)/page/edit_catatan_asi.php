<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pemberian ASI</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id_ibu = $_SESSION['username'];
$id_asi = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi," SELECT * FROM pemberian_asi pa JOIN bayi b ON pa.id_bayi=b.id_bayi WHERE pa.id_asi='$id_asi' AND b.id_ibu='$id_ibu' "));
if (isset($_POST['simpan'])) {
    $id_asi = $_POST['id_asi'];
    $id_bayi = $_POST['id_bayi'];
    $cek = mysqli_query($koneksi," SELECT * FROM bayi WHERE id_bayi='$id_bayi' AND id_ibu='$id_ibu' ");
if(mysqli_num_rows($cek)==0){
    die("Data bayi tidak valid.");
}
    mysqli_query($koneksi, " UPDATE pemberian_asi SET id_bayi='$id_bayi' WHERE id_asi='$id_asi'");
    //hapus seluruh detail lama
    mysqli_query($koneksi, " DELETE FROM detail_pemberian_asi WHERE id_asi='$id_asi' ");
    $tanggal = $_POST['tanggal_pengisian'];
    $jumlah  = $_POST['jumlah_pemberian'];
    for ($i = 0; $i < count($tanggal); $i++) {
        if ($tanggal[$i] != "" && $jumlah[$i] != "") {
            mysqli_query($koneksi, "
            INSERT INTO detail_pemberian_asi
            (id_asi,tanggal_pengisian,jumlah_pemberian)
            VALUES
            (
                '$id_asi',
                '{$tanggal[$i]}',
                '{$jumlah[$i]}'
            )
            ");
        }
    }
    echo "<div class='alert alert-success'>
            Data berhasil diubah
          </div>";
    echo "<meta http-equiv='refresh' content='1;url=ibu_index.php?page=catatan_asi'>";
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>Kode ASI</label>
                        <input type="text" name="id_asi" value="<?= $data['id_asi']; ?>" class="form-control" readonly>
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
                        $detail = mysqli_query($koneksi, "SELECT * FROM detail_pemberian_asi WHERE id_asi='$id_asi' ORDER BY tanggal_pengisian");
                        while ($d = mysqli_fetch_array($detail)) {
                        ?>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label>Tanggal Pengisian</label>
                                    <input
                                        type="date"
                                        name="tanggal_pengisian[]"
                                        class="form-control"
                                        value="<?= $d['tanggal_pengisian']; ?>"
                                        required>
                                </div>
                                <div class="col-md-5">
                                    <label>Jumlah Pemberian</label>
                                    <input
                                        type="text"
                                        name="jumlah_pemberian[]"
                                        class="form-control"
                                        value="<?= $d['jumlah_pemberian']; ?>"
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