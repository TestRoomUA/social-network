<head>
  <link rel="stylesheet" href="css/form.css">
</head>

<?php
  require 'header.php';
?>


<form class="container form flex-grow-1" action="/login.php" method="POST" id="log">
  <div>
    <?php
      $data = $_POST;

      if ( isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array(htmlspecialchars(strip_tags($data['login']))));
        if($user){
          if( password_verify($data['password'], $user->password)){
            $_SESSION['logged_user'] = $user;
            //header("Location: http:{$_SERVER['SERVER_NAME']} // /index.php");
            echo '<meta http-equiv = "Refresh" content = "0 ; URL =/">';
            exit();
          } else {
            $errors [] = 'Неверно введён пароль!';
          }

        } else {
          $errors[] = 'Пользователь с таким логином не найден!';
        }

        if (! empty($errors) ) {
          echo '<div class="alert-danger"><p class="alert-link">'.array_shift($errors).'</p></div><hr>';
        }
      }
    ?>
    <h2 class="text-center mb-4">Войти</h2>

    <div class="form-floating mb-3">
      <input type="text" name="login" value="<?=htmlspecialchars(strip_tags(@$data['login']))?>" class="form-control" id="floatingInput" placeholder="Name">
      <label for="floatingInput">Login</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" value="<?=@$data['password']?>" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <a href="/signup.php">Зарегестрироваться</a>

    <p>
      <button type="submit" name="do_login">Войти</button>
    </p>

  </div>
</form>

<?php
  require "footer.php";
?>
