<?php
  include 'includes/signup.php';

  if(isset($_POST["signupbtn"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["pwd"];
    $repeat_pwd = $_POST["pwd-repeat"];

    $signUpUser = new Users($firstname, $lastname, $username, $password, $repeat_pwd);
    $signUpUser->signUp();
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styling/reset.css">
    <link rel="stylesheet" href="styling/style.css">
    <link rel="stylesheet" href="styling/singup.css">
    <title>Sign-Up Page</title>
  </head>
  <body>
    <nav class="goback">
      <a href="index.php">Go Back</a>
    </nav>
    <div class="signupdiv">
    <h1 class="singupHeading">Signup</h1>
    <form class="signupForm" action="signuppage.php" method="POST">
      <input type="text" name="firstname" placeholder="Firstname">
      <input type="text" name="lastname" placeholder="Lastname">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="pwd" placeholder="Password">
      <input type="password" name="pwd-repeat" placeholder="Confirm Password">
      <button type="submit" name="signupbtn">Sign-Up</button>
      <?php

        $fullURL =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "signup=empty") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>Fill Up All The Fields.</p>";
          exit();
        }
        elseif (strpos($fullURL, "signup=invalid") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>Invalid Firstname Or Lastname.</p>";
          exit();
        }
        elseif (strpos($fullURL, "signup=passwordNotMatch") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>Password Doesn't Match.</p>";
          exit();
        }
        elseif (strpos($fullURL, "signup=InvalidPassword") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>You Have To Create 8-64 Password Characters.</p>";
          exit();
        }
        elseif (strpos($fullURL, "signup=UserFound") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>This Username Already Exists.</p>";
          exit();
        }
        elseif (strpos($fullURL, "signup=Success") == true) {
          echo "<p style='color: #fff; padding-top: 25px; margin:auto; font-family: serif;'>Signed-Up Successfully</p>";
          exit();
        }

       ?>
    </form>
    </div>
  </body>
</html>
