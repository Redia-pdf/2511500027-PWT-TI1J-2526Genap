 <?php
    $id_ibu = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM ibu WHERE id_ibu='$id_ibu'");
    $data = mysqli_fetch_array($query);
    ?>

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Profil Ibu</h1>
             </div>
         </div>
     </div>
 </div>
 <div class="content">
     <div class="container-fluid">
         <div class="card">
             <div class="card-body">
                <a href="ibu_index.php?page=Edit_profil&action=edit&id_ibu=<?= $data['id_ibu']; ?>" class="btn btn-primary btn-sm" style="background-color: #e91e63; border-color: #e91e63;">Edit Profil</a>
                 <table class="table table-striped">
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Nama</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nm_ibu']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>ID Ibu</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['id_ibu']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Alamat</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['alamat']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>No HP</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nohp']; ?></td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
 </div>
 </div>

 </div>