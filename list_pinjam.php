<div class="card col-sm-12">
  <div class="card-header">
    <h4>Buku yang akan dipinjam</h4>
  </div>
  <div class="card-body">
    <form action="db_pinjam.php?checkout=true" method="post" onsubmit="return confirm('Apakah Anda yakin dengan pesanan ini?')">


    <table class="table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Judul</th>
          <th>Penulis</th>
          <th>Picture</th>
          <th>
            Option
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["session_pinjam"] as $hasil): ?>
          <tr>
            <td><?php echo $hasil["kode_buku"]; ?></td>
            <td><?php echo $hasil["judul"]; ?></td>
            <td><?php echo $hasil["penulis"]; ?></td>
            <td>
              <img src="image_book/<?php echo $hasil["image"]; ?>" width="100" height="100" class="image">
            </td>
            <td>
              <a href="db_pinjam.php?hapus=true&kode_buku=<?php echo $hasil["kode_buku"]; ?>">
                <button type="button" class="btn btn-danger">Hapus</button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
      <button type="submit" class="btn btn-block btn btn-primary">CHECKOUT</button>
    </form>
  </div>
</div>
