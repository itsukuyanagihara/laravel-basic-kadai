<?php
session_start();

$host = 'localhost'; // データベースホスト
$dbname = 'system_attendance'; // データベース名
$username = 'root'; // データベースユーザー名
$password = 'root'; // データベースパスワード

try {
    // データベースに接続
    $conn = new mysqli($host, $username, $password, $dbname);

    // 接続確認
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $user_email = $_POST['user_email'];
        $user_email = filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL);
        // $user_password = $_POST['user_password'];
        $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');

        $sql = "SELECT user_id, user_password FROM users WHERE user_email = '$user_email'";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Query failed: " . $conn->error);
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            // 平文のパスワードを検証
            if ($user_password == $row['user_password']) {
                // ログイン成功
                $_SESSION['user_id'] = $row['user_id']; // 正しいユーザーIDをセット
                header("Location: home.php"); // ログイン後のページにリダイレクト
            } else {
                // ログイン失敗
                echo "Invalid username or password";
            }
        } else {
            // ログイン失敗
            echo "Invalid username or password";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    if (isset($conn)) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ログインページ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>ログインページ</h2>

<form action="" method="post">
    <label for="user_email">ユーザーID:</label>
    <input type="text" name="user_email" required><br>

    <label for="user_password">パスワード:</label>
    <input type="password" name="user_password" required><br>

    <input type="submit" value="ログイン">
</form>

<div>
    <a href="insert.php">ユーザー登録</a>
</div>

</body>
</html>
