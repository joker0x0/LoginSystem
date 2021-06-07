<?php

include_once "dbh.php";

class Users extends DBH {

  private $firstname;
  private $lastname;
  private $username;
  private $password;
  private $repeat_pwd;

  public function __construct($firstname, $lastname, $username, $password, $repeat_pwd) {
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->username = $username;
      $this->password = $password;
      $this->repeat_pwd = $repeat_pwd;
  }

  public function signUp() {

    if (empty($this->firstname) || empty($this->lastname) || empty($this->username) || empty($this->password) || empty($this->repeat_pwd)) {
      header("Location: signuppage.php?signup=empty");
      exit();
    }
    else {
          if (!preg_match("/^[a-zA-Z]+$/i", $this->firstname) || !preg_match("/^[a-zA-Z]+$/i", $this->lastname)) {
            header("Location: signuppage.php?signup=invalid");
            exit();
          } else {
            if ($this->password != $this->repeat_pwd) {
              header("Location: signuppage.php?signup=passwordNotMatch");
              exit();
            } else {
              if (strlen($this->password) < 8 || strlen($this->password) > 64) {
                header("Location: signuppage.php?signup=InvalidPassword");
                exit();
              } else {
                $sql = "SELECT * FROM users WHERE username=?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$this->username]);
                if ($row = $stmt->fetchAll()) {
                  header("Location: signuppage.php?signup=UserFound");
                  exit();
              } else {
                  $sql = "INSERT INTO users(firstname, lastname, username, password) VALUES(?, ?, ?, ?)";
                  $stmt = $this->connect()->prepare($sql);
                  $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
                  $stmt->execute([$this->firstname, $this->lastname, $this->username, $hashedPassword]);
                  header("Location: signuppage.php?signup=Success");
              }
            }
          }
        }
      }
    }
  }
