<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    date_default_timezone_set('Asia/Tokyo');

    echo date('Y年n月j日H時i分s秒') . '<br>';

    echo strtotime('+1 week') . '<br>';

    echo date('Y/m/d H:i:s', strtotime('-3 year'));
    ?>
  </p>
  <p>
    <?php 
    $date_time = new DateTime('2015-03-19 12:15:30');
    echo $date_time->format('Y年n月j日H時i分s秒') . '<br>';

    $now = new DateTime();
    $interval = $now->diff($date_time);
    echo $interval->format('%y年と%m月と%d日の差があります。総日数は%a日です。') . '<br>';

    $now = new DateTimeImmutable();
    $add = $now->modify('+1 year');
    $sub = $now->modify('-3 day');
    echo $add->format('現在から1年後はY年n月j日H時i分s秒です。') . '<br>';
    echo $sub->format('現在から3日前はY年n月j日H時i分s秒です。');
    ?>
  </p>
  
</body>
</html>