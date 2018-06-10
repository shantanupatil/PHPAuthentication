<?php
  $dsn = 'mysql:host=127.0.0.1;dbname=authentication';
  $username = 'root';
  $password = '';
  try {
      $conn = new PDO($dsn, $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $pe) {
    echo $pe->getMessage();
  }
