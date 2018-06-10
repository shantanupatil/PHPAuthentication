<?php
  require('Session.php');
  session_destroy();
  header('Location: ../index.php');
