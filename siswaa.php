        <script type="text/javascript">
        function Add() {
          // set action menjadi insert
          document.getElementById('action').value = "insert";
          // kosongkan inputan form
          document.getElementById("nisn").value = "";
          document.getElementById("nama").value = "";
          document.getElementById("alamat").value = "";
          document.getElementById("kontak").value = "";
        }

        function Edit(index) {
          // set inputan action menjadi update
          document.getElementById('action').value = "update";
          // set formnya berdasarkan table yang dipilih
          var table = document.getElementById("table_siswa");
          // tampung data dari tabel
          var nisn = table.rows[index].cells[0].innerHTML;
          var nama = table.rows[index].cells[1].innerHTML;
          var alamat = table.rows[index].cells[2].innerHTML;
          var kontak = table.rows[index].cells[3].innerHTML;

          //keluarkan pada formnya
          document.getElementById("nisn").value = nisn;
          document.getElementById("nama").value = nama;
          document.getElementById("alamat").value = alamat;
          document.getElementById("kontak").value = kontak;
        }
      </script>
      <div class="card col-sm-12">
        <div class="card-header">
          <h4>Daftar Siswa</h4>
        </div>
        <div class="card-body">
          <?php
            // koneksi ke databasenya
            $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
            // localhost = host name
            // root = username untuk akses database
            // "" = password untuk akses database
            // siswa = name databasenya
            $sql = "select * from siswa";
            $result = mysqli_query($koneksi,$sql);
            //digunakan untuk eksekusi sintax sql
            $count = mysqli_num_rows($result);
          ?>

          <?php if ($count == 0): ?>
            <!-- jika data dari databse kosong, maka akan muncul pesan informasi -->
            <div class="alert alert-info">
              Data belum tersedia
            </div>
          <?php else: ?>
            <!-- jika ditanya ada, maka akan ditampilkan pada tabel -->
            <table class="table" id="table_siswa">
              <thead>
                <tr>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Alamat</th>
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
                    <td><?php echo $hasil["nisn"]; ?></td>
                    <td><?php echo $hasil["nama"]; ?></td>
                    <td><?php echo $hasil["alamat"]; ?></td>
                    <td><?php echo $hasil["kontak"]; ?></td>
                    <td><?php echo $hasil["username"] ?></td>
                    <td><?php echo $hasil["password"] ?></td>
                    <td>
                      <img src="<?php echo "image_siswa/".$hasil["image"]; ?>" class="img" width="100">
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="Edit(this.parentElement.parentElement.rowIndex);">Edit</button>
                      <a href="siswa proses.php?hapus=siswa&nisn=<?php echo $hasil["nisn"];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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

    <!-- membuat modal / pop up -->
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="siswa proses.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Form Siswa</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" id="action">
              <!-- untuk menyimpan aksi yang akan dilakukan entah itu insert atau update -->
              NISN
              <input type="text" name="nisn" id="nisn" class="form-control">
              NAMA
              <input type="text" name="nama" id="nama" class="form-control">
              ALAMAT
              <input type="text" name="alamat" id="alamat" class="form-control">
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
  
