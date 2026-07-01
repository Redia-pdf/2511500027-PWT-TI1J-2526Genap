 <?php
    $nis = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nis='$nis'");
    $data = mysqli_fetch_array($query);
    ?>

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Biodata Siswa</h1>
             </div>
         </div>
     </div>
 </div>
 <div class="content">
     <div class="container-fluid">
         <div class="card">
             <div class="card-body">
                <a href="siswa_index.php?page=Edit_Biodata&action=edit&nis=<?= $data['nis']; ?>" class="btn btn-primary btn-sm">Edit Biodata</a>
                 <table class="table table-striped">
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Nama</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nm_siswa']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>NIS</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nis']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Jenis Kelamin</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['jenkel']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>No HP</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['hp']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Kelas</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nm_kelas']; ?></td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
 </div>
 </div>

 </div>