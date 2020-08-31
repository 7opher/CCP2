<?php
session_start();

// initialisation des variables
$username = "";
$email    = "";
$errors = array(); 

// connection à la base de données
$db = mysqli_connect('localhost', 'root', '', 'escotoiture_bdd');

// CONNEXION UTILISATEUR
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username est requis");
  }
  if (empty($password)) {
  	array_push($errors, "Password est requis");
  }

  if (count($errors) == 0) {
  	$password = sha1($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Vous êtes maintenant connecté";
  	  header('location: ../admin/index.php');
  	}else {
  		array_push($errors, "Mauvaise combinaison Username / Password");
  	}
  }
}

?>