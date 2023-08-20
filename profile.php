<head>
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
  require 'header.php';


  if( !isset($_COOKIE['user']) and !isset($_SESSION['logged_user']) ) {
    header('Location: /login.php#log');
    exit();
  }
  $profile = R::findOne('users', 'login = ?', array($_SESSION['logged_user']->login));
  $articles = R::getCursor("SELECT * FROM `posts` WHERE `author` = ?", array($_SESSION['logged_user']->login));
 ?>



  <main class="container flex-grow-1 mt-5">

    <div class="content d-flex flex-column align-items-center">
      <img src="img/avatars/1<?=@$_SESSION['logged_user']->avatar?>.png" alt="" width="192" height="192" class="rounded-circle">
      <h1 class="title">@<?=$_SESSION['logged_user']->login?></h1>
      <small class="text-muted m-2">
        <?=$profile['email']?>
      </small>
      <small class="text-muted m-2">
        Вы с нами с <?=@$profile['regdate']?>
      </small>
    </div>

    <pre class="alert-primary m-2">
      <a class="alert-link" href="/create-page.php">создать пост</a>
    </pre>

    <h3 class="primary m-5">Ваши посты:</h3>
  <?php if ($articles->getNextItem() == null) :?>
    <h4 class="text-muted text-center">У вас нету постов</h4>
  <?php else : ?>

  <div class=" grid ">
<!--  data-masonry='{"percentPosition": true }' style="position: relative; height: 690px;" , .row-->

    <?php
    $articles->reset();
    if (null != $articles->getNextItem()) {
      $articles->reset();
      while ($article = $articles->getNextItem()) {
        postPublic($article);
      }
    }
  ?>

  </div>

<?php endif; ?>
  </main>

<?php
require 'footer.php';
?>
