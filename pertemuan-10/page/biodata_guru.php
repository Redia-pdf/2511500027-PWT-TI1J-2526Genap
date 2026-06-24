 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Biodata Guru</h1>
             </div>
         </div>
     </div>
 </div>
    <?php
        $kd_guru = $_SESSION['username'];
        $query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd_guru'");
        $data = mysqli_fetch_array($query);
        ?>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                        <a href="guru_index.php?page=Edit_Biodata_Guru&action=edit&kd_guru=<?= $data['kd_guru']; ?>" class="btn btn-primary btn-sm">Edit Biodata</a>
                    <table class="table table-striped">
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>Nama</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['nm_guru']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>KD Guru</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['kd_guru']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>Jenis Kelamin</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['jenkel']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>Pendidikan Terakhir</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['pend_terakhir']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>No HP</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['hp']; ?></td>
                        </tr>
                            <tr>
                                <td style="text-align: justify; padding-right: 5px;"><b>Alamat</b></td>
                                <td style="padding-right: 10px;">:</td>
                                <td><?= $data['alamat']; ?></td>
                            </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
