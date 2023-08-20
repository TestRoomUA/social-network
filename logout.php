<?php

  require 'db.php';
  setcookie('user', $user['login'], time() - 2592000, "/");
  setcookie('avatar', $user['avatar'], time() - 2592000, "/");
  unset($_SESSION['logged_user']);


  header('Location: /');

?>
