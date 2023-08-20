<head>
  <link rel="stylesheet" href="css/form.css">
</head>

<?php
  require 'header.php';
  require 'mail.php';
?>

<form class="container form flex-grow-1" action="/signup.php" method="POST" id="sign">
  <div>
    <?php
      $data = $_POST;

      if ( isset($data['do_signup'])) {
        // регистрируем

        $errors = array();
        if ( trim(htmlspecialchars(strip_tags($data['login']))) == '' ) {
          $errors [] = 'Введите логин!';
        }

        if ( trim(htmlspecialchars(strip_tags($data['email']))) == '' ) {
          $errors [] = 'Введите Email!';
        }

        if ( $data['password'] == '' ) {
          $errors [] = 'Введите пароль!';
        }

        if ( $data['password_rep'] != $data['password'] ) {
          $errors [] = 'Пароли должны совпадать';
        }

        if ( R::count('users', "login = ?", array($data['login'])) > 0 ) {
          $errors [] = 'Пользователь с таким логином уже существует!';
        }

        if ( R::count('users', "email = ?", array($data['email'])) > 0 ) {
          $errors [] = 'Пользователь с таким Email уже существует!';
        }


        if ( empty($errors) ) {
          // всё гуд, регаемся
          $user = R::dispense('users');
          $user->login = htmlspecialchars(strip_tags($data['login']));
          $user->email = htmlspecialchars(strip_tags($data['email']));
          $user->avatar = rand(1, 9);
          $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
          $user->regdate = date('d.m.Yг.');
    //      $user->join_date = time();
          R::store($user);
          $_SESSION['logged_user'] = $user;
          FeedBack($user);
          //header("Location: http:{$_SERVER['SERVER_NAME']}/index.php");
          echo '<meta http-equiv = "Refresh" content = "0 ; URL =/">';
          exit();
        } else{
          echo '<div class="alert-danger"><p class="alert-link">'.array_shift($errors).'</p></div><hr>';
        }
      }
     ?>
     <h2 class="text-center mb-4">Регистрация</h2>

    <div class="form-floating mb-3">
      <input type="text" name="login" value="<?php echo @$data['login']; ?>" class="form-control" id="floatingInput" placeholder="Name">
      <label for="floatingInput">Ваш Логин</label>
    </div>

    <div class="form-floating mb-3">
      <input type="email" name="email" value="<?php echo @$data['email']; ?>" class="form-control" id="floatingEmail" placeholder="Email">
      <label for="floatingEmail">Ваш Email</label>
    </div>

    <div class="form-floating mb-3">
      <input type="password" name="password" value="<?php echo @$data['password']; ?>" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Ваш Пароль</label>
    </div>

    <div class="form-floating mb-3">
      <input type="password" name="password_rep" value="<?php echo @$data['password_rep']; ?>" class="form-control" id="floatingRep" placeholder="Repeat password">
      <label for="floatingRep">Подтвердите Пароль</label>
    </div>

    <a href="/login.php#log">Войти</a>

    <p>
      <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
  </div>

</form>

<?php
  require "footer.php";
?>
