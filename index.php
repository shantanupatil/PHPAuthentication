<?php
  require_once 'scripts/Session.php';
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Authentication Example - Shantanu Patil</title>
    <?php require('requires/bootstrap.php') ?>
  </head>
  <body>
    <?php require('requires/navigation.php') ?>
    <div class="container">
      <div style="margin-top:50px">
        <?php if(isset($_SESSION['name'])): ?>
          <h1>Hello, <?php echo $_SESSION['name'] ?></h1>
          <p>Your Email: <?php echo $_SESSION['email']?> || <a href="scripts/Logout.php">Logout</a></p>
        <?php else: ?>
          <h1>Authentication Example</h1>
          <p>The Login and Register script is built with Bootstrap and PHP. The database connectivity is done by using PDO.</p>
          <a href="login.php">Login</a> || <a href="register.php">Register</a>
        <?php endif ?>
      </div>
    </div>
  </body>
</html>
