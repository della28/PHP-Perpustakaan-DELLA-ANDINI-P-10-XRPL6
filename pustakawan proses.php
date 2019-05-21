<?php
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  // localhost = host name
  // root = username untuk akses databsenya
  // "" = pasword untuk akses databse
  // siswa = nama databasenya

  if (isset($_POST["action"])) {
    // kita tampung dulu dat ayng dikirim
    $nip = $_POST["nip"];
    $nama = $_POST["nama"];
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
      move_uploaded_file($_FILES["image"]["tmp_name"],"image_pusta/$filename");
      // jika actionnya insert
      $sql = "insert into pustakawan values('$nip','$nama','$kontak','$username','$password','$filename')";
    } else if($action == "update") {
      // ambil daa dari database
      $sql = "select * from pustakawan where nip = '$nip'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      // untuk mengkonversi ke array
      if (isset($_FILES["image"])) {
        if (file_exists("image_pusta/".$hasil["image"])) {
          // jika filenya tersedia
          unlink("image_pusta/".$hasil["image"]);
        }
        $path = pathinfo($_FILES["image"]["name"]);
        // ambil ekstensi gambarnya
        $extensi = $path["extension"];
        // rangkai nama file yag akan disimpan
        $filename = $nisn."-".rand(1,1000).".".$extensi;

        // simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"image_pusta/$filename");
        $sql = "update pustakawan set nama = '$nama',kontak = '$kontak',username='$username',password='$password',image='$filename' where nip = '$nip'";
      } else {
        $sql = "update pustakawan set nama = '$nama',kontak = '$kontak',username='$username',password='$password' where nip = '$nip'";
      }
    }

    // eksekusi sql
    mysqli_query($koneksi,$sql);
    echo $sql;
    // direct ke halaman
    header("location:template.php?page=pustakawan");
  }

  if (isset($_GET["hapus"])) {
    // jika yang dikirim adalah variable GET hapus
    $nip = $_GET["nip"];
    // ambil data dari databsase
   $sql = "select * from pustakawab where nip = '$nip'";
   // eksekusi query
   $result = mysqli_query($koneksi,$sql);
   // konversi ke array
   $hasil = mysqli_fetch_array($result);
   if (file_exists("image_pusta/".$hasil["image"])) {
     unlink("image_pusta/".$hasil["image"]);
   }
    $sql = "delete from pustakawan where nip = '$nip'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=pustakawan");
  }
?>
