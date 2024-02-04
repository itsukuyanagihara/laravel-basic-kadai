<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    $dice = mt_rand(1, 6);
    echo "{$dice}の目が出ました。";
    ?>
  </p>
  <p>
    <?php 
    $omikuji = ['大吉', '中吉', '小吉', '吉', '末吉', '凶', '大凶'];
    $key = array_rand($omikuji);
    $result = $omikuji[$key];
    echo "おみくじの結果は{$result}です。";
    ?>
  </p>
</body>
</html>