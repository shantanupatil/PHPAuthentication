<?php
  class Validate {
    private $_errors = array(),
            $_passed = false;

    public function check($source, $items = array()) {
      include 'Database.php';
      foreach ($items as $item => $rules) {
        foreach ($rules as $rule => $rule_value) {

          if ($rule === 'unique') {
            $user_email = $source[$item];
            $query = "SELECT email from register";
            $statement = $conn->prepare($query);

            $statement->execute(array('email'=>$user_email));
            while($row = $statement->fetch()) {
              if (($row['email']) == $user_email) {
                $registered = true;
              }
            }

            if (isset($registered)) {
              $this->addError("{$user_email} already registered.");
            }
          }

          $actual_user_value = $source[$item];
          if (($rule === 'required') && $rules[$rule] == 'true' && empty($actual_user_value)) {
             $this->addError("{$item} is required");
          }

        }
      }
      //var_dump(empty($this->_errors));
      if (empty($this->_errors)) {
        $this->_passed = true;
      }
    }

    private function addError($error) {
      $this->_errors[] = $error;
    }

    public function passed() {
      return $this->_passed;
    }

    public function getError() {
      return $this->_errors;
    }
  }
