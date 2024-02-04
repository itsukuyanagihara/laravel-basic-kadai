<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    echo 45 + 18;
    echo '<br>';
    var_dump(45 > 18);
    ?>
  </p>
  <p>
      <?php
       // 等価演算子を使った場合の戻り値を出力する
       var_dump('5' == 5);
 
        // 改行する
       echo '<br>';
 
       // 厳密等価演算子を使った場合の戻り値を出力する
       var_dump('5' === 5);
      ?>
     
  </p>
  <p>
    <?php 
    $num = mt_rand(0, 4);
    echo $num;
    echo '<br>';

    if($num === 4) {
      echo '大当たりです';
    }
    ?>
  </p>
  
</body>
</html>