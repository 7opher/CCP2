<?php
session_start();

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "Vous devez d'abord vous connecter";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: ../index.php");
}
