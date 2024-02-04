<?php 
session_start();

$user_name = '侍太郎';

if (isset($_SESSION[$user_name])) {
  $_SESSION[$user_name]++;
} else {
  $_SESSION[$user_name] = 1;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    echo 'ようこそ'.$user_name.'さん、'.$_SESSION[$user_name].'回目の訪問です。';

    if ($_SESSION[$user_name] > 3) {
      echo 'セッションを終了します。';
      $_SESSION = array();
      session_destroy();
    }
    ?>
  </p>
</body>
</html>