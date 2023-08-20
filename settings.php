<?php
  require 'header.php';

  if( !isset($_COOKIE['user']) and !isset($_SESSION['logged_user']) ) {
    header('Location: /login.php#log');
    exit();
  }
  $profile = R::findOne('users', 'login = ?', array($_SESSION['logged_user']->login));
  $articles = R::getCursor("SELECT * FROM `posts` WHERE `author` = ?", array($_SESSION['logged_user']->login));
?>


<main class="container mt-5">
  <div class="content d-flex flex-column align-items-center">

    <img src="img/avatars/1<?=@$_SESSION['logged_user']->avatar?>.png" alt="" width="192" height="192" class="rounded-circle">
    <h1 class="title">@<?=$_SESSION['logged_user']->login?></h1>

    <form class="form-control" action="settings.php" method="POST">
      <label class="mb-3">Укажи свой День рождения
      <input class="form-control mt-1 mb-3" type="date" id="birth" name="birthday" value="">
      </label>
      <div class="">
        <button class="btn btn-primary mb-3" type="submit" name="do_sett" value="Сохранить">Сохранить</button>
      </div>
    </form>
  </div>
</main>

<?php
require 'footer.php';
?>
