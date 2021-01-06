<?php

include_once "dbh.php";

class loginUser extends DBH {

    private $username;
    private $password;

    public function __construct($username, $password) {
      $this->username = $username;
      $this->password = $password;
    }

    public function signUserIn() {

        if (empty($this->username) || empty($this->password)) {
          header("Location: index.php?login=empty");
          exit();
        }
        else {
          $sql = "SELECT username FROM users WHERE username=?";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([$this->username]);
          if (!($row = $stmt->fetchAll())) {
            header("Location: index.php?login=userNotFound");
            exit();
          } else {
            $sql = "SELECT password FROM users WHERE username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->username]);
            $hashedPassword = $stmt->fetch();
            $checkPassword = password_verify($this->password, $hashedPassword["password"]);
            if ($checkPassword == false) {
              header("Location: index.php?login=wrongPassword");
              exit();
            } else {
              session_start();
              $_SESSION["username"] = $this->username;
              header("Location: Home.php?login=success");
              exit();
            }
          }
        }
    }
}
