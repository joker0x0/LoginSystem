<?php

  include 'includes/login.php';

  if (isset($_POST["loginbtn"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginUser = new loginUser($username, $password);
    $loginUser->signUserIn();
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main - Login</title>
    <link rel="stylesheet" href="styling/reset.css">
    <link rel="stylesheet" href="styling/style.css">
  </head>
  <body>
    <nav class="navbar">
      <form class="loginForm" action="index.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="loginbtn">Login</button>
      </form>
      <a href="signuppage.php" class="signuplink">SignUp</a>
      <?php
        $fullURL =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($fullURL, "login=empty") == true) {
          echo "<p style='color: red; float:right; padding-top: 10px; padding-right: 10px;'>Fill Up All Fields.</p>";
          exit();
        }
        elseif (strpos($fullURL, "login=userNotFound") == true) {
          echo "<p style='color: red; float:right; padding-top: 10px; padding-right: 10px;'>User Not Found.</p>";
          exit();
        }
        elseif (strpos($fullURL, "login=wrongPassword") == true) {
          echo "<p style='color: red; float:right; padding-top: 10px; padding-right: 10px;'>Incorrect Password.</p>";
          exit();
        }
        elseif (strpos($fullURL, "login=UnkownUser") == true) {
          echo "<p style='color: red; float:right; padding-top: 10px; padding-right: 10px;'>Please Login First.</p>";
          exit();
        }

      ?>
    </nav>
  </body>
</html>
