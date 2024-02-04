<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>php-form管理画面</title>
</head>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$dsn = 'mysql:dbname=form-test;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'SELECT * FROM contests';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    exit($e->getMessage());
}
?>
<body>

<tr>
    <th>ID</th>
    <th>氏名</th>
    <th>会社</th>
    <th>メールアドレス</th>
    <th>電話番号</th>
    <th>お問い合わせ内容:</th>

</tr>
<?php

foreach ($results as $result) {
 echo "<tr>
 <br>
 <th>ID</th>
 <td>{$result['id']}</td>
 <br>
 <th>氏名</th>
 <td>{$result['name']}</td>
 <br>
 <th>会社</th>
 <td>{$result['company']}</td>
 <br>
 <th>メールアドレス</th>
 <td>{$result['mail']}</td>
 <br>
 <th>電話番号</th>
 <td>{$result['number']}</td>
 <br>
 <th>お問い合わせ内容</th>
 <td>{$result['message']}</td>
 <br>
 </tr>";
}
?></table>



<!-- インサート-->



<!-- ドロップ -->


</body>
</html>


