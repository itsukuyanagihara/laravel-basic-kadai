<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>formテスト</title>
</head>
<body>
  <?php 
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  try {
    $dsn = 'mysql:dbname=form-test;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $company = $_POST['company'];
    $mail = $_POST['mail'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contests (name, company, mail, number, message) VALUES (:name, :company, :mail, :number, :message)";
    $stmt = $pdo->prepare($sql);
    $params = array(':name' => $name, ':company' => $company, ':mail' => $mail, ':number' => $number, ':message' => $message);
    $stmt->execute($params);

    echo "お名前:".$name."<br>";
    echo "会社名:".$company."<br>";
    echo "メールアドレス:".$mail."<br>";
    echo "電話番号:".$number."<br>";
    echo "お問い合わせ内容:".$message."<br>";
    echo "で登録しました";
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。'. $e->getMessage());
  }


  ?>
</body>
</html>