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
        // 案件名を取得
        $work_name = $_POST['work_name'];

        // 1. 案件名をworksテーブルに登録し、work_idを取得
        $stmt = $conn->prepare("INSERT INTO works (work_name) VALUES (:work_name)");
        $stmt->bindParam(':work_name', $work_name);
        $stmt->execute();

        // 最後に挿入された行のID（work_id）を取得
        $work_id = $conn->lastInsertId();

        // 2. データベースへのデータ挿入（yesterday_reportsテーブル）
        $wakeup_time = $_POST["wakeup_time"];
        $departure_time = $_POST["departure_time"];

        // 画像データのアップロード
        if (isset($_FILES["route_image"]) && $_FILES["route_image"]["error"] == 0) {
            $image_tmp_name = $_FILES["route_image"]["tmp_name"];
            $route_image = file_get_contents($image_tmp_name);

            // データベースへのデータ挿入
            $stmt = $conn->prepare("INSERT INTO yesterday_reports (user_id, work_id, wakeup_time, departure_time, route_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $user_id);
            $stmt->bindParam(2, $work_id);
            $stmt->bindParam(3, $wakeup_time);
            $stmt->bindParam(4, $departure_time);
            $stmt->bindParam(5, $route_image, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                // 3. メールアドレス取得とメール送信
                $stmt = $conn->prepare("SELECT user_email FROM users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $to = $result['user_email'];  // メールアドレス取得成功
                    $subject = "新しいデータが登録されました";
                    $message = "新しいデータがデータベースに登録されました。";
                    $headers = "From: itsuku.yanagihara@workaslife-inc.com";

                    // メール送信
                    mail($to, $subject, $message, $headers);

                    echo '送信完了　<a href="../home.php">ホームに戻る</a>';

                    if(mb_send_mail($to, $subject, $message, $headers))
        {
            // echo "メール送信成功です";
        }
        else
        {
            echo "メール送信失敗です";
        }

                } else {
                    echo "メールアドレスの取得に失敗しました。";
                }
            } else {
                echo "データベースへの挿入エラー: " . $stmt->errorInfo()[2];
            }
        } else {
            echo "ファイルのアップロードエラーが発生しました。";
        }
    }
} catch (PDOException $e) {
    // 接続エラーが発生した場合の処理
    echo "データベース接続エラー: " . $e->getMessage();
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- 上記の PHP コードで CSS ファイルを読み込む -->
</head>
<body>