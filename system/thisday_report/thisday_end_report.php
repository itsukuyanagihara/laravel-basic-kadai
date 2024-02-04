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
// work_idをセッションから取得
$work_id = $_SESSION['work_id'];




$host = 'localhost'; // データベースホスト
$dbname = 'system_attendance'; // データベース名
$username = 'root'; // データベースユーザー名
$password = 'root'; // データベースパスワード

try {
  // PDOインスタンスの作成
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  
  // エラーモードを例外モードに設定
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // タイムスタンプの取得
  $timestamp = date("Y-m-d H:i:s");

  // SQLクエリの準備と実行
  $sql = "INSERT INTO end_reports (user_id, work_id, end_time) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
  $stmt->bindParam(2, $work_id, PDO::PARAM_INT);
  $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
  $stmt->execute();

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

// データベース接続のクローズ
$pdo = null;


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>当日報告フォーム-終了報告</title>
</head>
<body>
  <!--  -->
  <button class="favorite styled" type="button" onclick="location.href='../home.php'">終了しました</button>
  
</body>
</html>