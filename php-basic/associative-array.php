<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    $personal_data = ['name' => '男性', 'age' => '36', 'gender' => '男性'];

    print_r($personal_data);
    echo '<br>';
    $personal_data['age'] = '37';
    $personal_data['address'] = '東京都';
    print_r($personal_data);
    echo '<br>';
    echo $personal_data['name'];
    ?>
  </p>
  
</body>
</html>