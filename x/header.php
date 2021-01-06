<?php
  session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="styling/reset.css">
    <link rel="stylesheet" href="styling/main.css">
  </head>
  <body>
    <nav class="navHeader">
      <?php
          if (isset($_SESSION["username"])) {
            echo "<p class='helloMsg'>Hello There " . $_SESSION["username"] . "</p>";
          } else {
            header("Location: index.php?login=UnkownUser");
          }
       ?>
        <form action="header.php" method="POST" class="logoutForm">
          <button type="submit" name="logOutbtn" class="btnLogOut">LogOut</button>
        </form>
        <?php
          if (isset($_POST["logOutbtn"])) {
            session_unset();
            session_destroy();
            header("Location: index.php?logout=Successfully");
            exit();
          }
         ?>
      </nav>
