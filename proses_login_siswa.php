<?php
  session_start();
  $username = $_POST["username"];
  $password = md5($_POST["password"]);

  // koneksi databse
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  $sql = "select * from siswa where username='$username' and password='$password'";
  $result = mysqli_query($koneksi,$sql);
  $jumlah = mysqli_num_rows($result);

  if ($jumlah == 0) {
    // jika jumlah datanya = 0 berarti username atau password salah
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => "Username/Password Salah"
    );
    header("location:login_siswa.php");
  } else {
    // buat variabel session
    $_SESSION["session_siswa"] = mysqli_fetch_array($result);
    $_SESSION["session_pinjam"] = array();
    // ini buat tempat enampung data yang dipinjam
    header("location:template_siswa.php");
  }


  if (isset($_GET["logout"])) {
    // hapus sessionnya
    session_destroy();
    header("location:login_siswa.php");
  }

 ?>
