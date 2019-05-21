<?php session_start(); ?>
<?php if (isset($_SESSION["session_pustakawan"])): ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUSTKAWAN'S TELKOM LIBRARY</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-danger navbar-dark sticky-top">
      <!--
        navbar-expand-md -> menu akan dihidden ketika tampilan device berukuran medium
        bg-danger -> navbar akan mempunyai background warna merah
        navbar-dark -> tulisan menu pada navbar akan lebih gelap
        fixed-top -> navbar kan berposisi selalu di atas -->
        <a href="#" class="text-white">
          <h3>TELKOM's LIBRARY</h3>
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
          <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav">
            <li class="nav-item"><a href="template.php?page=siswaa" class="nav-link">Siswa</a></li>
            <li class="nav-item"><a href="template.php?page=pustakawan" class="nav-link">Pustakawan</a></li>
            <li class="nav-item"><a href="template.php?page=buku" class="nav-link">Buku</a></li>
            <li class="nav-item"><a href="template.php?page=daftar_peminjaman" class="nav-link">Daftar Peminjaman</a></li>
            <li class="nav-item"><a href="proses_login.php?logout=true" class="nav-link">Logout</a></li>
          </ul>
        </div>
        <h5 class="text-white">Hello, <?php echo $_SESSION["session_pustakawan"]["nama"]; ?></h5>
    </nav>

    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $_GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
  <?php echo "Anda belum login!"; ?>
  <br>
  <a href="login.php">Loginnya tuh disini</a>
<?php endif; ?>
