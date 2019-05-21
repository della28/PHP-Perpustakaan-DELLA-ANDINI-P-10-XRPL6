
      <script type="text/javascript">
        function Add(){
          //set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputan formnya
          document.getElementById("kode_buku").value = "";
          document.getElementById("judul").value = "";
          document.getElementById("genre").value = "";
          document.getElementById("penulis").value = "";


        }

        function Edit(index){
          // set input action berdasarkan tabel yangg dipilih
          document.getElementById('action').value = "update";
          // set formnya berdarasarkan tabel yang dipilih
          var table = document.getElementById("table_buku");
          // tampung data dari tabel
          var kode_buku = table.rows[index].cells[0].innerHTML;
          var judul = table.rows[index].cells[1].innerHTML;
          var genre = table.rows[index].cells[2].innerHTML;
          var penulis = table.rows[index].cells[3].innerHTML;

          // keluarkan pada formnya
          document.getElementById("kode_buku").value = kode_buku;
          document.getElementById("judul").value = judul;
          document.getElementById("genre").value = genre;
          document.getElementById("penulis").value = penulis;
        }

      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Buku</h4>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION["message"])): ?>
            <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
              <?php echo $_SESSION["message"]["message"]; ?>
              <?php unset($_SESSION["message"]); ?>
            </div>
          <?php endif; ?>
          <?php
          $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
          // localhost = host name
          // root = username untuk akses ke database
          // "" = password untuk diakses database
          // siswa = nama databasenya
          $sql = "select * from buku";
          $result = mysqli_query($koneksi,$sql);
          // digunakan untuk eksekusi sintax sql
          $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <!-- jika data dari database kosong, maka akan muncul informasi -->
            <div class="alert alert-info">
              Data belum Tersedia
            </div>
          <?php else: ?>
            <!-- jika datanya ada, maka akan ditampilkan pada tabel -->
            <table class="table" id="table_buku">
              <thead>
                <tr>
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>Genre</th>
                  <th>Penulis</th>
                  <th>Stok</th>
                  <th>Image</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil ["kode_buku"]; ?></td>
                    <td><?php echo $hasil ["judul"]; ?></td>
                    <td><?php echo $hasil ["genre"]; ?></td>
                    <td><?php echo $hasil ["penulis"]; ?></td>
                    <td><?php echo $hasil ["stok"]; ?></td>
                    <td>
                      <img src="<?php echo "image_book/".$hasil["image"]; ?>"
                      class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="buku proses.php?hapus=buku&kode_buku=<?php echo $hasil["kode_buku"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                        <button type="button" class="btn btn-danger">Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
        <div class="card-footer">
           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="Add()">Tambah</button>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="buku proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Buku</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang aka dilakukan entah itu insert atau update -->
              KODE BUKU
              <input type="text" name="kode_buku" id="kode_buku" class="form-control">
              JUDUL
              <input type="text" name="judul" id="judul" class="form-control">
              GENRE
              <input type="text" name="genre" id="genre" class="form-control">
              PENULIS
              <input type="text" name="penulis" id="penulis" class="form-control">
              STOK
              <input type="number" name="stok" id="stok" class="form-control">
              IMAGE
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
