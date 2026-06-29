 <?php
    $id_ibu = $_SESSION['username'];
    $query = mysqli_query($koneksi, " SELECT * FROM bayi JOIN ibu ON bayi.id_ibu = ibu.id_ibu WHERE bayi.id_ibu='$id_ibu' ");
    ?>

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Profil Bayi</h1>
             </div>
         </div>
     </div>
 </div>
 <div class="content">
     <div class="container-fluid">
        <?php while($data = mysqli_fetch_array($query)){ ?>
         <div class="card">
             <div class="card-body">
                 <table class="table table-striped">
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Nama</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['nm_bayi']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>ID Bayi</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['id_bayi']; ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Tanggal Lahir</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= date('d-m-Y', strtotime($data['tanggal_lahir'])); ?></td>
                     </tr>
                     <tr>
                         <td style="text-align: justify; padding-right: 5px;"><b>Jenis Kelamin</b></td>
                         <td style="padding-right: 10px;">:</td>
                         <td><?= $data['jenis_kelamin']; ?></td>
                     </tr>
                        <tr>
                            <td style="text-align: justify; padding-right: 5px;"><b>Nama Ibu</b></td>
                            <td style="padding-right: 10px;">:</td>
                            <td><?= $data['nm_ibu']; ?></td>
                 </table>
             </div>
         </div>
         <?php } ?>
     </div>
 </div>
 </div>

 </div>