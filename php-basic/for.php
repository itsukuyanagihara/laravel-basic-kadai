<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    for($i = 1; $i <= 10; $i++) {
      echo $i . '<br>';
      if($i === 5) {
        break;
      }
    }
    ?>
  </p>
  <p>
    <?php 
    for($i = 1; $i <= 10; $i++) {
      $num = mt_rand(1, 20);
      echo "{$i}回目の結果は{$num}です。<br>";

      if($num === 20) {
        echo '20が出たので繰り返し処理を強制終了します。';
        break;
      }
    }
    ?>
  </p>
  
</body>
</html>