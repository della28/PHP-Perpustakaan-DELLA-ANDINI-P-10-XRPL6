<?php
  session_start();
  $username = $_POST["username"];
  $password = md5($_POST["password"]);

  // koneksi databse
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  $sql = "select * from pustakawan where username='$username' and password='$password'";
  $result = mysqli_query($koneksi,$sql);
  $jumlah = mysqli_num_rows($result);

  if ($jumlah == 0) {
    // jika jumlah datanya = 0 berarti username atau password salah
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => "Username/Password Salah"
    );
    header("location:login.php");
  } else {
    // buat variabel session
    $_SESSION["session_pustakawan"] = mysqli_fetch_array($result);
    header("location:template.php");
  }


  if (isset($_GET["logout"])) {
    // hapus sessionnya
    session_destroy();
    header("location:login.php");
  }

 ?>
