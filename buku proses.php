<?php
  session_start();
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  if (isset($_POST["action"])) {
    $kode_buku = $_POST["kode_buku"];
    $judul = $_POST["judul"];
    $genre = $_POST["genre"];
    $penulis = $_POST["penulis"];
    $stok = $_POST["stok"];
    $action = $_POST["action"];

    if ($_POST["action"] == "insert") {
      $path = pathinfo($_FILES["image"]["name"]);
      $extensi = $path["extension"];
      $filename = $kode_buku."-".rand(1,1000).".".$extensi;

      $sql = "insert into buku value('$kode_buku','$judul','$genre','$penulis','$stok','$filename')";

      if (mysqli_query($koneksi,$sql)) {
        move_uploaded_file($_FILES["image"]["tmp_name"],"image_book/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Insert data has been success"
        );
      }else {
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      header("location:template.php?page=buku");

    }elseif ($_POST["action"] == "update") {
      if (!empty($_FILES["image"]["name"])) {
        $sql = "select * from buku where kode_buku='$kode_buku'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);

        if (file_exists("image_book/".$hasil["image"])) {
          unlink("image_book/".$hasil["image"]);
        }
        // membuat nama file baru
        $path = pathinfo($_FILES["image"]["name"]);
        // ambil ekstensi gambarnya
        $extensi = $path["extension"];
        // rangkai nama file yang akan disimpan
        $filename = $kode_buku."-".rand(1,1000).".".$extensi;
        // rand() = untuk mengambil nlai random antara 1 - 1000

        $sql = "update buku set judul='$judul',genre='$genre',penulis='$penulis',stok='$stok',image='$filename' where kode_buku='$kode_buku'";
        if (mysqli_query($koneksi,$sql)) {
          move_uploaded_file($_FILES["image"]["tmp_name"],"image_book/$filename");
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }else {
        $sql = "update buku set judul='$judul',genre='$genre',penulis='$penulis',stok='$stok' where kode_buku='$kode_buku'";

        if (mysqli_query($koneksi,$sql)) {
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
      }
      header("location:template.php?page=buku");
    }
  }


  if (isset($_GET["hapus"])) {
    // jika yang dikirim adalah variable GET hapus
    $kode_buku = $_GET["kode_buku"];
     // ambil data dari databsase
    $sql = "select * from buku where kode_buku = '$kode_buku'";
    // eksekusi query
    $result = mysqli_query($koneksi,$sql);
    // konversi ke array
    $hasil = mysqli_fetch_array($result);
    if (file_exists("image_book/".$hasil["image"])) {
      unlink("image_book/".$hasil["image"]);
    }
    $sql = "delete from buku where kode_buku = '$kode_buku'";
    if (mysqli_query($koneksi,$sql)) {
      // jika query sukses
      $_SESSION["message"] = array(
        "type" => "succes",
        "message" => "Delete has been succes"
      );
    }else {
      // jika gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=buku");
  }
 ?>
