<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>PHP基礎編</title>
</head>
<body>
  <p>
    <?php 
    class Product {
      public $name;

      public function set_name(string $name) {
        $this->name = $name;
      }
      public function show_name() {
        echo $this->name . '<br>';
      }

    }

    $coffee = new Product();
    $coffee->set_name('コーヒー');
    $coffee->show_name();


    $shampoo = new Product();
    $shampoo->name = 'シャンプー';
    echo $shampoo->name;
    ?>
  </p>
  <p>
    <?php 
    class User {
      private $name;
      private $age;
      private $gender;

      public function __construct(string $name, int $age, string $gender)
      {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
      }
    }
    $user = new User('侍太郎', 36, '男性');
    print_r($user);
    ?>
  </p>
</body>
</html>