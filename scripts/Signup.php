<?php
  class Signup {
    private $result = array();
    public static function registerUser($data) {
      include 'Database.php';
      $name = $data['name'];
      $email = $data['email'];
      $password = $data['password'];
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $address = $data['address'];
      try {
        $sql = "INSERT INTO register(name, email, password, address, created) VALUES(:name, :email, :password, :address, now())";
        $statement = $conn->prepare($sql);

        $values = array(':name'=>$name, ':email'=>$email, ':password'=>$hashed_password, ':address'=>$address);
        $statement->execute($values);

        if($statement->rowCount() == 1) {
          $result = 'Registered Successfully. You can now login.';
          header('Location: ./login.php?signup=success');
        }
      } catch(PDOException $pd) {

      }
    }
  }
