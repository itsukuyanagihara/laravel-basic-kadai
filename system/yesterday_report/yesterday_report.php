<?php 
session_start();

// セッションにuser_idが保存されているか確認
if (!isset($_SESSION['user_id'])) {
  // セッションにuser_idが存在しない場合はログインページにリダイレクト
  header("Location: login.php");
  exit();
}

// user_idをセッションから取得
$user_id = $_SESSION['user_id'];

// echo $user_id;保存できているか確認
// echo $user_id;

// あっているか不安
// work_idをセッションから取得

// データベース接続情報
$host = 'localhost';
$dbname = 'system_attendance';
$username = 'root';
$password = 'root';

try {
    // データベースに接続
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $work_name = $_POST['work_name'];変更: 案件名を取得
        $work_name = $htmlspecialchars($_POST['work_name'], ENT_QUOTES, 'UTF-8'); // 変更: 案件名を取得とバリデーション

        // 場所があっているのか不安
        if(empty($_POST['work_name'])){
          echo '案件名を入力してください。';
          exit;
        }

        // データベースに案件名を登録
        // $stmt = $conn->prepare("INSERT INTO your_table_name (user_id, work_name) VALUES (:user_id, :work_name)");
        $stmt = $conn->prepare("INSERT INTO your_table_name (user_id, work_name) VALUES (:user_id, :work_name)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':work_name', $work_name);
        $stmt->execute();

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    if (isset($conn)) {
        $conn = null;
    }
}





 ?>
 <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>朝確システム-前日報告フォーム</title>
</head>
<body>
<form method="post" action="send.php" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  <div>案件名</div>
  <input type="text" name="work_name" required>
  <div>起床予定時間</div>
  <input type="time" name="wakeup_time" required>
  <div>出発予定時間</div>
  <input type="time" name="departure_time" required>
  <div>経路画像（電車のスクリーンショット）</div>
  <input type="file" name="route_image" accept="image/*" required>
  <div>
    <input type="submit" value="送信">
  </div>
</form>
</body>
</html>