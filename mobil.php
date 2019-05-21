<?php
session_start();
 ?>
     <script type="text/javascript">
       function Add(){
         document.getElementById("action").value = "insert";
         document.getElementById("id_mobil").value = "";
         document.getElementById("nomor_mobil").value = "";
         document.getElementById("merk").value = "";
         document.getElementById("jenis").value = "";
         document.getElementById("warna").value = "";
         document.getElementById("tahun_pembuatan").value = "";
         document.getElementById("biaya_sewa_phari").value = "";

       }
       function Edit(index){
         document.getElementById("action").value = "update";
         var table = document.getElementById("table_mobil");
         var id_mobil = table.rows[index].cells[0].innerHTML;
         var nomor_mobil = table.rows[index].cells[1].innerHTML;
         var merk = table.rows[index].cells[2].innerHTML;
         var jenis = table.rows[index].cells[3].innerHTML;
         var warna = table.rows[index].cells[4].innerHTML;
         var tahun_pembuatan = table.rows[index].cells[5].innerHTML;
         var biaya_sewa_phari = table.rows[index].cells[6].innerHTML;

         document.getElementById("id_mobil").value = id_mobil;
         document.getElementById("nomor_mobil").value = nomor_mobil;
         document.getElementById("merk").value = merk;
         document.getElementById("jenis").value = jenis;
         document.getElementById("warna").value = warna;
         document.getElementById("tahun_pembuatan").value = tahun_pembuatan;
         document.getElementById("biaya_sewa_phari").value = biaya_sewa_phari;
       }
     </script>
       <div class="card col-sm-12">
         <div class="card-header bg-primary text-white">
           <i><h5 align="center">Daftar Mobil</h5></i>
         </div>
         <div class="card-body" style="overflow:auto">
           <?php if (isset($_SESSION["message"])):  ?>
             <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
               <?php echo $_SESSION["message"]["message"]; ?>
               <?php unset($_SESSION["message"]); ?>
             </div>
           <?php endif; ?>
           <?php
           // membuat koneksi ke database
           $koneksi = mysqli_connect("localhost", "root", "" , "ukl");
           //Local host sebagai = host name
           //root = username untuk akses database
           //"" = unutk akses database
            //crud = nama database
           $sql = "select*from mobil";
           $result = mysqli_query($koneksi,$sql);
           // unutk eksekusi syntax sql
           $count = mysqli_num_rows($result);
           // diguakan untuk menampilkan jumlah data
           ?>
           <?php if ($count == 0): ?>
             <div class="alert alert-danger">
               Data Belum Tersedia !
             </div>
           <?php else: ?>
             <table class="table table-responsive" id="table_mobil">
               <thead>
                 <tr>
                   <th>ID Mobil</th>
                   <th>Nomor Mobil</th>
                   <th>Merk</th>
                   <th>Jenis</th>
                   <th>Warna</th>
                   <th>Tahun Pembuatan</th>
                   <th>Biaya Sewa Per Hari</th>
                   <th>Image</th>
                   <th>Opsi</th>
                 </tr>
               </thead>
               <tbody>
                 <?php foreach ($result as $hasil): ?>
                   <tr>
                     <td><?php echo $hasil["id_mobil"] ?></td>
                     <td><?php echo $hasil["nomor_mobil"] ?></td>
                     <td><?php echo $hasil["merk"] ?></td>
                     <td><?php echo $hasil["jenis"] ?></td>
                     <td><?php echo $hasil["warna"] ?></td>
                     <td><?php echo $hasil["tahun_pembuatan"] ?></td>
                     <td><?php echo $hasil["biaya_sewa_phari"] ?></td>
                     <td>
                        <img src="img_car/<?php echo $hasil["gambar"] ?>" width="100px" height="auto">
                     </td>
                     <td>
                       <button type="button" class="btn btn-info"
                       data-toggle="modal" data-target="#modal"
                       onclick="Edit(this.parentElement.parentElement.rowIndex);">
                       Edit
                     </button>
                     <a href="mobil_proses.php?hapus=mobil&id_mobil=<?php echo $hasil["id_mobil"];?>"
                       onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">

                       <button type="button" class="btn btn-danger">
                         Hapus
                       </button>
                     </a>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               </tbody>
             </table>
           <?php endif; ?>
           <div class="card-footer">
             <button type="button" class="btn btn-success" data-toggle="modal"
             data-target="#modal" onclick="Add()">
             Tambah
           </button>
         </div>
         </div>
       </div>


 <div class="modal fade" id="modal">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <form action="mobil_proses.php" method="post" enctype="multipart/form-data">
         <div class="modal-header">
           <h4>Form Mobil</h4>
         </div>
         <div class="modal-body">
           <input type="hidden" name="action" id="action">
           <!-- //untuk menyimpan aksi yang akan dilakukan insert / update -->
           ID Mobil
           <input type="text" name="id_mobil" id="id_mobil" class="form-control">
           Nomor Mobil
           <input type="text" name="nomor_mobil" id="nomor_mobil" class="form-control">
           Merk
           <input type="text" name="merk" id="merk" class="form-control">
           Jenis
           <input type="text" name="jenis" id="jenis" class="form-control">
           Warna
           <input type="text" name="warna" id="warna" class="form-control">
           Tahun Pembuatan
           <input type="text" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control">
           Biaya Sewa Per Hari
           <input type="text" name="biaya_sewa_phari" id="biaya_sewa_phari" class="form-control">
           Gambar
             <input type="file" name="gambar" id="gambar" class="form-control">
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-success">
             Simpan
           </button>
         </div>
       </form>
     </div>
   </div>
 </div>
