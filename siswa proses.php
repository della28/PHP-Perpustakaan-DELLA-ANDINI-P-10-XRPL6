<?php
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  // localhost = host name
  // root = username untuk akseske database
  // "" = password untuk akses database
  // perpustakaan1 = nama databsenya

  if (isset($_POST["action"])) {
    // kita tampung dulu data yang dikirim
    $nisn = $_POST["nisn"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $action = $_POST["action"];

    if ($action == "insert") {
      // kita tampung deskripsi gambarnya
      $path = pathinfo($_FILES["image"]["name"]);
      // ambil eksekusi gambarnya
      $extensi = $path["extension"];
      // rangkai nama file yang akan disimpan
      $filename = $nisn."-".rand(1,1000).".".$extensi;

      //simpan file gambarnya
      move_uploaded_file($_FILES["image"]["tmp_name"],"image_siswa/$filename");
      $sql = "insert into siswa values('$nisn','$nama','$alamat','$kontak','$username','$password','$filename')";
    } else if ($action == "update") {
      // ambil daa dari database
      $sql = "select * from siswa where nisn = '$nisn'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      // untuk mengkonversi ke array
      if (isset($_FILES["image"])) {
        if (file_exists("image_siswa/".$hasil["image"])) {
          // jika filenya tersedia
          unlink("image_siswa/".$hasil["image"]);
        }
        $path = pathinfo($_FILES["image"]["name"]);
        // ambil ekstensi gambarnya
        $extensi = $path["extension"];
        // rangkai nama file yag akan disimpan
        $filename = $nisn."-".rand(1,1000).".".$extensi;

        // simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"image_siswa/$filename");
        $sql = "update siswa set nama = '$nama',alamat='$alamat',kontak='$kontak',username='$username',password='$password',image='$filename' where nisn='$nisn'";
      } else {
        $sql = "update siswa set nama = '$nama',alamat='$alamat',kontak='$kontak',username='$username',password='$password' where nisn='$nisn'";
      }
    }
    // eksekusi sql
    mysqli_query($koneksi,$sql);
    echo $sql;
    // direct ke halaman siswa
    header("location:template.php?page=siswaa");
  }

  if (isset($_GET["hapus"])) {
    // jika yang dikirim adalah variable GET Hapus
   $nisn = $_GET["nisn"];
    // ambil data dari databsase
   $sql = "select * from siswa where nisn = '$nisn'";
   // eksekusi query
   $result = mysqli_query($koneksi,$sql);
   // konversi ke array
   $hasil = mysqli_fetch_array($result);
   if (file_exists("image_siswa/".$hasil["image"])) {
     unlink("image_siswa/".$hasil["image"]);
   }
    $sql = "delete from siswa where nisn = '$nisn'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=siswaa");
  }
?>
