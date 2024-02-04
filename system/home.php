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

// 時間帯指定
require_once 'config.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>朝確システム-ホーム</title>
</head>
<body>
  <div>
    <a href="yesterday_report/yesterday_report.php">前日報告用ページ</a>
  </div>

  <div>
    <a href="thisday_report/thisday_wakeup_report.php">当日報告用ページ</a>
  </div>

  <div>
    <a href="thisday_report/thisday_end_report.php">終了報告用ページ</a>
  </div>

  
  
</body>
</html>