<?php

class DBH {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $charset;

  protected function connect() {
    $this->servername = "";
    $this->username = "";
    $this->password = "";
    $this->dbname = "";
    $this->charset = "";

    try {
      $dsn = "mysql:host=$this->servername;dbname=$this->dbname;charset=$this->charset";
      $pdo = new PDO($dsn, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      echo "Connection Failed " . $e->getMessage();
    }
  }
}
