<?php
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  $sql = "select * from buku";
  $result = mysqli_query($koneksi,$sql);
 ?>

 <div class="row">
   <?php foreach ($result as $hasil): ?>
     <div class="card col-sm-4">
       <div class="card-body">
         <img src="image_book/<?php echo $hasil["image"]; ?>" class="img" width="100%" height="300">
       </div>
       <div class="card-footer bg-primary">
         <h5 class="text-center"><?php echo $hasil["judul"]; ?></h5>
         <h6 class="text-center"><?php echo $hasil["penulis"]; ?></h6>
         <h6 class="text-center">Stok: <?php echo $hasil["stok"]; ?></h6>
         <a href="db_pinjam.php?pinjam=true&kode_buku=<?php echo $hasil["kode_buku"]; ?>"><button type="button" class="btn btn-info btn-block">PINJAM</button></a>
       </div>
     </div>
   <?php endforeach; ?>
 </div>
