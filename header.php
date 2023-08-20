<?php
  require "db.php";
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="описание">
    <meta name="keywords" content="ключевые слова">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--<link rel="stylesheet" href="css/header.css">-->
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/scroll.css">
    <link rel="stylesheet" href="css/anim.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Test Room NetW</title>

    <script src="https://kit.fontawesome.com/4c7c5eb148.js" crossorigin="anonymous"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="page min-vh-100 d-flex flex-column justify-content-start">
<!-- sourceMappingURL=bootstrap.min.css.map -->

    <header class="p-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
          <?php if (isset($_SESSION['logged_user'])): ?>
            <li><a href="/index.php?get_posts=@<?=@$_SESSION['logged_user']->login?>" class="nav-link px-2 link-dark">Мои истории</a></li>
            <li><a href="/create-page.php" class="nav-link px-2 link-dark">Новая история</a></li>
          <?php else: ?>
            <li><a  data-bs-toggle="modal" href="#exampleModalToggle" role="button" class="nav-link px-2 link-dark">Новая история</a></li>
          <?php endif; ?>
          <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalToggleLabel">Войдите или Зарегистрируйтесь</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Чтобы создать историю нужно войти в свой аккаунт
                </div>
                <div class="modal-footer d-flex flex-column align-items-stretch">
                  <a class="btn btn-primary" href="login.php#log">Войти</a>
                  <a class="btn btn-primary" href="signup.php#sign">Зарегистрироваться</a>
                </div>
              </div>
            </div>
          </div>
        </ul>

    <!-- SEARCH SYSTEM -->
        <form action="/index.php" method="GET" class="form-floating col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" name="get_posts" class="form-control" placeholder="Поиск..." id="search" aria-label="Search" value="<?=trim(htmlspecialchars(strip_tags(@$_GET['get_posts'])))?>">
          <label for="search">Поиск</label>
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if( isset($_SESSION['logged_user']) ) : ?>
            <img src="img/avatars/1<?=$_SESSION['logged_user']->avatar?>.png" alt="" width="32" height="32" class="rounded-circle"> <?=$_SESSION['logged_user']->login?>
          <?php else : ?>
            <img src="https://github.com/uds.png" alt="" width="32" height="32" class="rounded-circle"> Войти
          <?php endif; ?>
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
          <?php if( isset($_SESSION['logged_user']) ) : ?>
            <li><a class="dropdown-item" href="/create-page.php">Новая история...</a></li>
            <li><a class="dropdown-item" href="/settings.php">Настройки</a></li>
            <li><a class="dropdown-item" href="/profile.php">Профиль</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout.php">Выйти</a></li>
          <?php else : ?>
            <li><a class="dropdown-item" href="/create-page.php">Войти</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/signup.php#sign">Зарегистрироваться</a></li>
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <small class="text-muted text-center container-fluid secondary border-bottom">Бета-сайт</small>
