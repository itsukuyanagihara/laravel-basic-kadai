<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ユーザー登録フォーム</title>
</head>
<body>

<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'system_attendance';
$username = 'root';
$password = 'root';

// フォームが送信されたかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // データベースに接続
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // フォームから受け取ったデータ
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        // メールアドレスのバリデーション
        if(!$email){
            echo '有効なメールアドレスを入力してください。';
            exit;
        }

        // 名前のバリデーション
        if(empty($name)){
            echo '名前を入力してください。';
            exit;
        }

        // パスワードのバリデーション
        if(strlen($password) < 4){
            echo 'パスワードは少なくとも4文字以上である必要があります。';
            echo '<a href="insert.php">もう一度入力する</a>';
            exit;
        }


        // データベースにデータを挿入
        $stmt = $conn->prepare("INSERT INTO users (user_email, user_name, user_password) VALUES (:email, :name, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            echo 'ユーザーが登録されました。<a href="login.php">ログイン画面へ</a>';
        } else {
            echo "データベースへの挿入エラー: " . $stmt->errorInfo()[2];
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
}
?>

<!-- ユーザー登録フォーム -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">メールアドレス:</label>
    <input type="email" name="email" required><br>

    <label for="name">名前:</label>
    <input type="text" name="name" required><br>

    <label for="password">パスワード:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="登録">
</form>

</body>
</html>
