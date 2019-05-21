<?php
  session_start();
  $koneksi = mysqli_connect("localhost","root","","perpustakaan1");
  if (isset($_GET["pinjam"])) {
    $kode_buku = $_GET["kode_buku"];
    $sql = "select * from buku where kode_buku='$kode_buku'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    // masukkan k keranjang
    if (!in_array($hasil, $_SESSION["session_pinjam"])) {
      array_push($_SESSION["session_pinjam"],$hasil);
    }
    header("location:template_siswa.php?page=list_buku");
  }

  if (isset($_GET["checkout"])) {
    // siapkan data untuk tabel pinjam
    $id_pinjam = rand(1,1000000);
    $nisn = $_SESSION["session_siswa"]["nisn"];
    $nip = null;
    $tgl_pinjam = date("Y-m-d");
    $tgl_kembali = null;
    $sql = "insert into pinjam values ('$id_pinjam','$nisn','$nip','$tgl_pinjam','$tgl_kembali','0')";
    mysqli_query($koneksi,$sql);

    foreach ($_SESSION["session_pinjam"] as $hasil) {
      $sql = "insert into detail_pinjam values ('$id_pinjam','".$hasil["kode_buku"]."')";
      mysqli_query($koneksi,$sql);
      $sql_update = "update buku set stok=stok-1 where kode_buku='".$hasil["kode_buku"]."'";
      mysqli_query($koneksi,$sql_update);
    }
    $_SESSION["session_pinjam"] = array();
    header("location:template_siswa.php?page=list_buku");
  }

  if (isset($_GET["hapus"])) {
    $kode_buku = $_GET["kode_buku"];
    $index = array_search($kode_buku,array_column($_SESSION["session_pinjam"],"kode_buku"));
    array_splice($_SESSION["session_pinjam"],$index,1);
    header("location:template_siswa.php?page=list_pinjam");
  }

  if (isset($_GET["kembali"])) {
    $id_pinjam = $_GET["id_pinjam"];
    $sql = "select * from detail_pinjam where id_pinjam='$id_pinjam'";
    $result = mysqli_query($koneksi,$sql);

    foreach ($result as $hasil) {
      $sql = "update buku set stok=stok+1 where kode_buku='".$hasil["kode_buku"]."'";
      mysqli_query($koneksi,$sql);
    }
    $sql = "update pinjam set status='1' where id_pinjam='$id_pinjam'";
    mysqli_query($koneksi,$sql);
    header("location:template_siswa.php?page=list_buku");
  }
 ?>
