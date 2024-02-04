<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    $num = mt_rand(0, 4);

    $i = 1;

    echo "最初の値は{$num}です。<br>";

    while($num !== 0) {
      $num = mt_rand(0, 4);
      echo "現在の値は{$num}です。<br>";

      if($i === 5) {
        echo '5回目なので繰り返し処理を強制終了します。';
        break;
      }
      $i++;
    }

    
    ?>
  </p>

  <p>
    <?php 
    $sum = 0;
    while($sum < 20) {
      $num = mt_rand(1, 10);
      echo "{$num}が出ました。<br>";

      if($num % 2 === 0) {
        echo '偶数なので加算しません。<br>';
        continue;
      }

      $sum += $num;

    }
    ?>
  </p>
</body>
</html>