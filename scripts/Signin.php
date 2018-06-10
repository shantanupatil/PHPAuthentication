<?php
  class Signin {
    private $error_signin = array(),
            $passed_login = false;

    public function loginUser($data) {
      include 'Database.php';
      include 'Session.php';

      $query = 'SELECT * FROM register WHERE email = :email';

      $statement = $conn->prepare($query);

      $statement->execute(array(':email'=> $data['email']));

      if (!($statement->rowCount() === 0)) {
        while($row = $statement->fetch()) {
          $hash_password = $row['password'];
          $password = $data['password'];
          if (password_verify($password, $hash_password)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header('Location: ./index.php');
          } else {
            $this->addError('Error, Please check your email and password.');
          }
        }
      } else {
        $this->addError('I guess, you\'re not registered. Please <a href="register.php">register here</a>');
      }

      if (empty($this->error_signin)) {
        $this->passed_login = true;
      }
    }

    public static function passLogin() {
      return $this->passed_login;
    }

    public function getError() {
      return $this->error_signin;
    }

    private function addError($err) {
      $this->error_signin[] = $err;
    }
  }
