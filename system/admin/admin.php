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



// データベース接続情報
$host = 'localhost'; // データベースホスト
$dbname = 'system_attendance'; // データベース名
$username = 'root'; // データベースユーザー名
$password = 'root'; // データベースパスワード

// PDOインスタンスを作成してデータベースに接続
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}

// SQLクエリを作成
// $sql = "SELECT y.user_id, u.user_name, y.work_id, y.wakeup_time, y.departure_time, y.route_image
//         FROM yesterday_reports y
//         JOIN users u ON y.user_id = u.user_id";

// SELECT 句で DISTINCT を使う代わりに、GROUP BY を使用して user_id と user_name でグループ化しています。
// 集約関数（MAX）を使用して、各ユーザーに関連する他のカラムの値を取得しています。これにより、各ユーザーごとに最新の情報を取得できます。


// $sql = "SELECT u.user_id, u.user_name, MAX(y.work_id) as work_id, MAX(y.wakeup_time) as wakeup_time, MAX(y.departure_time) as departure_time, MAX(y.route_image) as route_image
//         FROM yesterday_reports y
//         JOIN users u ON y.user_id = u.user_id
//         GROUP BY u.user_id, u.user_name";


$sql = "SELECT u.user_id, u.user_name,
               MAX(y.work_id) as work_id,
               MAX(y.wakeup_time) as wakeup_time,
               MAX(y.departure_time) as departure_time,
               MAX(a.arrival_time) as arrival_time,
               MAX(e.end_time) as end_time,
               MAX(y.route_image) as route_image
        FROM users u
        LEFT JOIN yesterday_reports y ON u.user_id = y.user_id
        LEFT JOIN departure_reports d ON u.user_id = d.user_id AND y.work_id = d.work_id
        LEFT JOIN arrival_reports a ON u.user_id = a.user_id AND y.work_id = a.work_id
        LEFT JOIN end_reports e ON u.user_id = e.user_id AND y.work_id = e.work_id
        GROUP BY u.user_id, u.user_name";






// クエリを実行して結果を取得
try {
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("クエリ実行エラー: " . $e->getMessage());
}















// HTMLテーブルに結果を表示
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>朝確システム-</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>前日報告</h2>
    <table>
        <thead>
            <tr>
                <th>ユーザーID</th>
                <th>ユーザー名</th>
                <th>案件ID</th>
                <th>起床予定時間</th>
                <th>出発予定時間</th>
                <th>ルート画像</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['work_id']; ?></td>
                    <td><?php echo $row['wakeup_time']; ?></td>
                    <td><?php echo $row['departure_time']; ?></td>
                    <!-- 以下のコードだと画像データがテキストで表示され、文字化けする -->
                    <!-- <td><?php echo $row['route_image']; ?></td> -->
                    <!-- <td><img src="data:image/png;base64,<?php echo base64_encode($row['route_image']); ?>" alt="Route Image"></td> -->

                    <td><a href="#" onclick="showImage('<?php echo base64_encode($row['route_image']); ?>');">画像詳細</a></td>
                </tr>
            <?php endforeach; ?>

<!-- JavaScriptを使用して画像を表示する関数を定義 -->
<script>
    function showImage(base64Data) {
        // 画像表示用のダイアログを作成
        var imageDialog = document.createElement('div');
        imageDialog.style.position = 'fixed';
        imageDialog.style.top = '0';
        imageDialog.style.left = '0';
        imageDialog.style.width = '100%';
        imageDialog.style.height = '100%';
        imageDialog.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        imageDialog.style.display = 'flex';
        imageDialog.style.justifyContent = 'center';
        imageDialog.style.alignItems = 'center';

        // Base64データを画像として表示
        var img = document.createElement('img');
        img.src = 'data:image/png;base64,' + base64Data;
        img.style.maxWidth = '80%';
        img.style.maxHeight = '80%';

        // ダイアログに画像を追加
        imageDialog.appendChild(img);

        // ダイアログをクリックで閉じる
        imageDialog.onclick = function() {
            document.body.removeChild(imageDialog);
        };

        // ダイアログをbodyに追加
        document.body.appendChild(imageDialog);
    }
</script>
        </tbody>
    </table>


    <h2>当日報告</h2>
    <table>
      <thead>
        <tr>
          <th>ユーザーID</th>
          <th>ユーザー名</th>
          <th>案件ID</th>
          <th>起床時間</th>
          <th>出発時間</th>
          <th>到着時間</th>
          <th>終了時間</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <!-- <?php foreach ($result_today as $row): ?> -->
          <td><?php echo $row['user_id']; ?></td>
          <td><?php echo $row['user_name']; ?></td>
          <td><?php echo $row['work_id']; ?></td>
          <td><?php echo $row['wakeup_time']; ?></td>
          <td><?php echo $row['departure_time']; ?></td>
          <td><?php echo $row['arrival_time']; ?></td>
          <td><?php echo isset($row['end_time']) ? $row['end_time'] : ''; ?></td>
        </tr>
        <!-- <?php endforeach; ?> -->
      </tbody>
    </table>

    <button>全削除</button>
</body>
</html>