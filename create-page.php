<?php
  require 'header.php';
  if( !isset($_COOKIE['user']) and !isset($_SESSION['logged_user']) ) {
    echo '<meta http-equiv = "Refresh" content = "0 ; URL =/login.php#log">';
    exit();
  require 'mail.php';


  }
  // $sql = "UPDATE `users` SET `login` = \'Users\' WHERE `users`.`id` = 6";
 ?>

 <head>
   <link rel="stylesheet" href="css/pageStyle.css">
 </head>

  <main class="main container flex-grow-1 p-0">
    <form class="" action="/create-page.php" method="POST">

<?php
  $data = $_POST;
  if ( isset($data['do_create'])) {
    // регистрируем

    $errors = array();
    if ( trim($data['title']) == '' ) {
      $errors [] = 'Введите Заголовок!';
    }

    if ( trim($data['text']) == '' ) {
      $errors [] = 'Введите текст!';
    }



    if ( empty($errors) ) {
      // всё гуд, регаемся
      $article = R::dispense('posts');
      $article->author = $_SESSION['logged_user']->login;
      $article->title = htmlspecialchars(strip_tags($data['title']));
      $article->icon = trim($data['icon'], ' #');
      $article->text = '<p>'.htmlspecialchars(strip_tags($data['text'])).'</p>';
      $article->like = 0;
      $article->time = date('Y-m-d h:i');
  //      $user->join_date = time();
      R::store($article);

      FeedBack($article);

  //    $_SESSION['articles'] = $article->id;
      //header("Location: http:{$_SERVER['SERVER_NAME']}/index.php");
      echo '<meta http-equiv = "Refresh" content = "0 ; URL =/">';
      exit();
    } else{
      echo '<div style="color: red; font-weight: 700; font-family: sans-serif;">'.array_shift($errors).'</div><hr>';
    }
  }
?>
      <div class="title-block">
        <div class="title-background">
          <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="600" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect class="backgroundImage" width="100%" height="100%" fill="<?=$rand_color?>"></rect></svg>
        </div>
        <h1 class="title">
          <input class="colorSwitch" type="color" name="icon" value="<?=$rand_color?>">
          <input class="form-control form-control-lg" style='background: transparent; color: white;' type="text" name="title" value="">
        </h1>
        <div class="border-top-content"></div>
      </div>
      <div class="content pb-5">

        <textarea class="form-control" name="text" rows="8" cols="100%" placeholder="Напишите свою историю..." required></textarea>

        <div class=" mt-3 btn-group d-flex justify-content-center">
          <button class="btn btn-sm btn-primary" type="submit" name="do_create">Создать</button>
        </div>
      </div>
    </form>
  </main>

  <?php
    require "footer.php";
  ?>


<!--
<article class="frame">
  <p class="default-text">здесь может быть ваша реклама</p>
</article>

<div class="content-image">
  <img src="../img/twospiders.jpg" alt="">
</div>
