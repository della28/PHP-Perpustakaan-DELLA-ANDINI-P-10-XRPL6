
      <script type="text/javascript">
        function Add() {
          // set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputannya
          document.getElementById("nip").value = "";
          document.getElementById("nama").value = "";
          document.getElementById("kontak").value = "";
        }

        function Edit(index) {
          // set input action menjadi update
          document.getElementById('action').value = "update";
          // set formnya berdasarkan tabel yang dipilih
          var table = document.getElementById("table_pustakawan");
          // tampung data dari tabel
          var nip = table.rows[index].cells[0].innerHTML;
          var nama = table.rows[index].cells[1].innerHTML;
          var kontak = table.rows[index].cells[2].innerHTML;

          // keluarkan pada formnya
          document.getElementById("nip").value = nip;
          document.getElementById("nama").value = nama;
          document.getElementById("kontak").value = kontak;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Pustakawan</h4>
        </div>
        <div class="card-body">
          <?php
            // koneksi ke database
            $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
            // localhost = host name
            // root = username untuk akses databsenya
            // "" = pasword untuk akses databse
            // siswa = nama databasenya
            $sql = "select * from pustakawan";
            $result = mysqli_query($koneksi,$sql);
            // digunakan untuk eksekusi sintax sql
            $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <!-- jika data dari database kosong , maka akan muncul pesan informasi -->
            <div class="alert alert-info">
              Data belum tersedia
            </div>
          <?php else: ?>
            <!-- jika datanya ada, maka akan ditampilkan pada tabel -->
            <table class="table" id="table_pustakawan">
              <thead>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Kontak</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Image</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $hasil): ?>
                  <tr>
                    <td><?php echo $hasil["nip"]; ?></td>
                    <td><?php echo $hasil["nama"]; ?></td>
                    <td><?php echo $hasil["kontak"]; ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <img src="<?php echo "image_pusta/".$hasil["image"]; ?>" class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="pustakawan proses.php?hapus=pustakawan&nip=<?php echo $hasil["nip"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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

    <!-- membuat pop up -->
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="pustakawan proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Pustakawan</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang akan dialkukan entah itu insert atau upfdate -->
              NIP
              <input type="text" name="nip" id="nip" class="form-control">
              NAMA
              <input type="text" name="nama" id="nama" class="form-control">
              KONTAK
              <input type="text" name="kontak" id="kontak" class="form-control">
              USERNAME
              <input type="text" name="username" id="username" class="form-control">
              PASSWORD
              <input type="password" name="password" id="password" class="form-control">
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
  
