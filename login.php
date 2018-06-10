<?php
  require_once 'scripts/Input.php';
  require_once 'scripts/Validate.php';
  require_once 'scripts/Signin.php';
  require_once 'scripts/Signup.php';

  if ($_POST) {
    $validate = new Validate();
    $signin = new Signin();
    $validate->check($_POST, array(
      'email' => array(
        'required'=>'true',
      ),
      'password' => array(
        'required'=>'true'
      ),
    ));

    if ($validate->passed()) {
      $signin->loginUser($_POST);
      $errors_ = $signin->getError();
    } else {
      $errors_ = $validate->getError();
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register - Auth Example</title>
    <?php require('requires/bootstrap.php') ?>
  </head>
  <body>
    <?php require('requires/navigation.php') ?>
    <div class="container">
      <div style="margin-top: 50px;">
        <h1 style="margin: 25px 0 25px 0">Login</h1>
        <form action="" method="POST">
            <?php
              if ($_POST  && isset($errors_)) {
                echo '<div class="jumbotron">';
                  echo'<div class="errors">';
                    foreach($errors_ as $error) {
                      echo "<li><p style='color:red; display:inline;'>{$error}</p></li>";
                    }
                  echo"</div>";
                echo"</div>";
              }
            ?>
            <?php
              if (isset($_GET['signup'])) {
                if ($_GET['signup'] === 'success') {
                  echo '<div class="jumbotron">';
                    echo'<div class="errors">';
                      echo "<p style='color:green;'>Successfully Registered. You can now login</p>";
                    echo"</div>";
                  echo"</div>";
                }
              }
            ?>
          <div class="form-group">
            <label for="emailID">Email Address</label>
            <input class="form-control" type="email" name="email"  id="emailID" value="<?php echo Input::getData('email')?>">
            <small class="form-text text-muted">We will never share your email address.</small>
          </div>
          <div class="form-group">
            <label for="passwordID">Password</label>
            <input class="form-control" type="password" name="password" id="passwordID" value="<?php Input::getData('password')?>">
          </div>

          <button class="btn btn-primary" type="submit" name="button">Register</button>
        </form>
      </div>
    </div>
  </body>
</html>
