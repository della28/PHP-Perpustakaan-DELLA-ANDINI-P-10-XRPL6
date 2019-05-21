<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pustakawan</title>
    <link rel="stylesheet" href="stylepus.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script> -->
  </head>
  <body>
    <!-- <div class="container my-5">
      <div class="row justify-content-center align-items-center">
      <div class="col-sm-6 card">
        <div class="card-header">
          <h3>Login Form</h3>
        </div>
        <div class="card-body"> -->
        <?php if (isset($_SESSION["message"])): ?>
          <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
            <?php echo $_SESSION["message"]["message"]; ?>
            <?php unset($_SESSION["message"]); ?>
          </div>
        <?php endif; ?>
        <form class="box" action="proses_login.php" method="post">
          <h1>LOGIN PUSTAKAWAN</h1>
          <input type="text" name="username" placeholder="Username or E-mail" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="" value="Login">
        </form>
        <!-- </div>
      </div>
      </div>
    </div> -->
  </body>
</html>
