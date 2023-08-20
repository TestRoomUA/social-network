<head>
  <link rel="stylesheet" href="css/pageStyle.css">
</head>

<?php
  include 'header.php';
  $article = R::findOne('posts', 'id = ?', array($_GET['post_id']));
 ?>

    <main class="main container flex-grow-1 p-0">
      <div class="title-block">
        <div class="title-background">
          <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="600" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#<?=$article->icon?>"></rect></svg>
        </div>
        <h1 class="title"><?=$article->title?></h1>
        <h2 class="subtitle">@<?=@$article->author?></h2>
        <div class="border-top-content"></div>
      </div>
      <div class="content">
        <section class="text">
          <?php
            echo $article->text;
          ?>
        </section>
        <p class="text-end font-monospace text-muted"><?=$article->time?></p>
      </div>
    </main>


<?php
  require "footer.php";
?>
