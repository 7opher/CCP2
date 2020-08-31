<?php
include('server.php');
require('../structure/head.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="text-center">
  <form class="form-signin" method="post" action="login.php">
    <div class="alert" role="alert">
      <?php include('errors.php'); ?>
    </div>
    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-lock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
    </svg>
    <h1 class="h3 mb-3 mt-3 font-weight-normal">Espace Admin</h1>
    <label class="sr-only">Email address</label>
    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
    <label class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="mb-4 form-control" placeholder="Password">
    <button class="btn btn-lg btn-success btn-block" type="submit" name="login_user">Sign in</button>
  </form>
</body>

</html>