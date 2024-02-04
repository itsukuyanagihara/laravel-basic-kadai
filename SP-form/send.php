<?php

$host = 'localhost';
$dbname = 'spform';
$username = 'root';
$password = 'root';

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // フォームからのデータを受け取ります
    $username = $_POST["username"];
    $workname = $_POST["workname"];
    $wakeuptime = $_POST["wakeuptime"];
    $departuretime = $_POST["departuretime"];

    // 画像データのアップロード
    if (isset($_FILES["routeimage"]) && $_FILES["routeimage"]["error"] == 0) {
        $imagetmpname = $_FILES["routeimage"]["tmp_name"];
        $imagedata = file_get_contents($imagetmpname);
        
        // データベースへのデータ挿入
        $stmt = $pdo->prepare("INSERT INTO report (username, workname, wakeuptime, departuretime, imagedata) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $workname);
        $stmt->bindParam(3, $wakeuptime);
        $stmt->bindParam(4, $departuretime);
        $stmt->bindParam(5, $imagedata, PDO::PARAM_LOB);
        
        if ($stmt->execute()) {
            echo "データがデータベースに保存されました。";
        } else {
            echo "データベースへの挿入エラー: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "ファイルのアップロードエラーが発生しました。";
    }

} catch (PDOException $e) {
    echo "データベース接続エラー: " . $e->getMessage();
}
?>
