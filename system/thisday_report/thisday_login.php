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
        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];

        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Query failed: " . $conn->error);
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            // 平文のパスワードを検証
            if ($user_password == $row['user_password']) {
                // ログイン成功
                $_SESSION['user_id'] = $user_id;
                header("Location: thisday_wakeup_report.php"); // ログイン後のページにリダイレクト
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
</head>
<body>

<h2>前日報告ログインページ</h2>

<form action="" method="post">
    <label for="user_id">ユーザーID:</label>
    <input type="number" name="user_id" required><br>

    <label for="user_password">パスワード:</label>
    <input type="password" name="user_password" required><br>

    <input type="submit" value="Login">
</form>

</body>
</html>
