<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
  require 'header.php';
  // ONLOAD COOKIE
  if (empty($_SESSION['logged_user'])) {
  }
  //SEARCH POSTS
  \R::getPDO()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
  if (isset($_GET['get_posts']) && trim($_GET['get_posts'], ' @')) {
    $search = explode(' ', trim(htmlspecialchars(strip_tags($_GET['get_posts']))));
    $array = array();
    foreach ($search as $key) {
      if (($ckey = trim($key, " @")) != "") {

        if (strpos(trim($key), '@') !== false) {
          if ($key != $search[count($search)-1]) {
            $array[] = "CONCAT (`author`) LIKE '%".$ckey."%' OR ";
          }
          else {
            $array[] = "CONCAT (`author`) LIKE '%".$ckey."%'";
          }
        }
        else {
          if ($key != $search[count($search)-1]) {
            $array[] = "CONCAT (`title`, `text`) LIKE '%".$ckey."%' OR ";
          }
          else {
            $array[] = "CONCAT (`title`, `text`) LIKE '%".$ckey."%'";
          }
        }
      }
    }

    $sql = "SELECT * FROM `posts` WHERE ".implode("", $array);

    $articles = R::getCursor($sql);
  }
  else {
    $articles = R::getCursor("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 50");
  }

?>


  <main id="_articles" class="articles flex-grow-1">
    <h5 class="heading mt-2" style="background: <?=$rand_color?>; color: <?=$c?>">
      Вам будет интересно почитать<?php if (isset($_SESSION['logged_user']->login)) {
        echo ", ".$_SESSION['logged_user']->login;
      } ?>
    </h5>

<?php
  if (null == $articles->getNextItem()){
      echo "<h5 class='alert-danger container p-5'>Не найдено ни одного поста с '".trim(htmlspecialchars(strip_tags($_GET['get_posts'])), ' @')."' </h5>";
  };
  $articles->reset();

?>

    <div class=" grid ">
<!--  data-masonry='{"percentPosition": true }' style="position: relative; height: 690px;" , .row-->

      <?php
      if (null != $articles->getNextItem()) {
        $articles->reset();
        while ($article = $articles->getNextItem()) {
          postPublic($article);
        }
      }

    ?>

    </div>
  </main>

<script type="text/javascript">
  window.addEventListener('scroll', () => {
    const documentRect = document.documentElement.getBoundingClientRect();
    if (documentRect.bottom < document.documentElement.clientHeight + 100) {
      <?=$j = 0;?>
    }
  })
</script>

<?php
  require "footer.php";
?>
