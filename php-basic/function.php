<?php 
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    function say_good_morning() {
      echo 'おはようございます<br>';
      echo'昨日はよくねむれましたが？<br>';
      echo'今日も1日頑張りましょう！<br>';
    }

    function say_good_evening() {
      echo 'こんばんは！<br>';
      echo '今日も1日お疲れ様でした.<br>';
    }

    say_good_morning();

    say_good_evening();
    ?>
  </p>
  <p>
    <?php 
    
    function calculate_total($price) {
      $total = $price + 500;
      echo $total . '円<br>';
    }

    calculate_total(1200);

    function add_two_arguments($price, $shipping_fee) {
      $total = $price + $shipping_fee;
      echo $total . '円<br>';
    }

    add_two_arguments(1200, 500);

    ?>
  </p>
  <p>
    <?php 
    function double($num) {
      return $num * 2;
    }
    echo double(30);
    ?>
  </p>
  <p>
    <?php 
    function type_hinting_argument(int $num) {
      return $num * 2;
    }
    echo type_hinting_argument(1);
    ?>
  </p>
  <p>
    <?php 
    function type_hinting_return_value($num): int {
      return $num * 2;
    }

    echo type_hinting_return_value(1);
    ?>
  </p>
</body>
</html>