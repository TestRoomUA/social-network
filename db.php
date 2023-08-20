<?php
  require 'libs/rb.php';
  date_default_timezone_get();

  /*no longer existing database*/
  /*R::setup( 'mysql:host=localhost;dbname=q99700ly_users', 'q99700ly_users', 'password' );*/


  /*Database on my computer*/
  R::setup( 'mysql:host=localhost;dbname=q99700ly',
  'root', 'password' );


session_start();

$basics_colors = array('1' => '#FFFFFF','#00FFFF','#FFFF00','#00FF00','#008000','#000080','#808000','#008080','#FF0000','#800000','#800080','#0000FF','#808080','#000000');
$rand_color = $basics_colors[$g = rand(1, count($basics_colors))];
if ($g <= 4) $c = 'dark';
else $c = 'white';

function randColor()
{
  $rand_color = $basics_colors[$g = rand(1, count($basics_colors))];
  if ($g <= 4) $c = 'dark';
  else $c = 'white';
  echo ($rand_color);
}

function printR($value='')
{
  echo "<pre class='alert-primary'>";
  print_r($value);
  echo "</pre>";
}

function trimStr($str, $countChar=100)
{
  mb_internal_encoding("UTF-8");
  $str = mb_substr($str, 0, $countChar);

  return $str;
}


function postPublic($article = array())
{
if (is_array($article)) :
?>
<div class="col _anim-items _anim-no-hide">
  <div class="card <?php if($article['author'] == 'TestRoom' or $article['author'] == 'Denys'):?> bg-primary bg-gradient border border-primary <?php endif; ?> bg-opacity-10 shadow-sm">
    <a href="/page-1.php?post_id=<?=$article['id']?>">
      <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#<?= @($article['icon']) ?>"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Responsive image</text></svg>
    </a>
    <div class="card-body">
      <a href="/page-1.php?post_id=<?=$article['id']?>">
        <h5 class="card-title"><?=$article['title']?></h5>
        <p class="card-text"><?=trimStr(str_replace("\n", "<br>", $article['text']), 100)?>...</p>
      </a>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/page-1.php?post_id=<?=$article['id']?>">View</a></button>
          <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->login == $article['author']) : ?><button type="button" class="btn btn-sm btn-outline-secondary">Edit <?php else : ?><button type="button" class="btn btn-sm btn-outline-secondary">Like <?php endif; ?> <?=$article['like']?></button>
        </div>
        <small class="text-muted"><a href="/index.php?get_posts=@<?=@$article['author']?>"><?=@$article['author']?></a> / <?=$article['time']?> </small>
      </div>
    </div>
  </div>
</div>
<?php
endif;
}











/*
echo '<pre>';
$g = 0;
foreach ($basics_colors as $color) {
  $g++;
  if ($g <= 8) $c = 'dark';
  else $c = 'white';
  echo '<h5 style="background: #'.$color.'; color: '.$c.' ">'.$color.'</h5>';
}
echo '</pre>';
*/
