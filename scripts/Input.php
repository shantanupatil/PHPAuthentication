<?php
  class Input {
    public static function getData($item) {
      if (isset($_POST[$item])) {
        return $_POST[$item];
      } else if (isset($_GET[$item])) {
        return $_GET[$item];
      }
      return '';
    }
  }
