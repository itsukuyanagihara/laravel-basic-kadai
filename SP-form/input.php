<form method="post" action="send.php" enctype="multipart/form-data">
  <div>名前</div>
  <input type="text" name="username" required>
  <div>案件名</div>
  <input type="text" name="workname" required>
  <div>起床予定時間</div>
  <input type="time" name="wakeuptime" required>
  <div>出発予定時間</div>
  <input type="time" name="departuretime" required>
  <div>経路画像（電車のスクリーンショット）</div>
  <input type="file" name="routeimage" accept="image/*" required>
  <div>
    <input type="submit" value="送信">
  </div>
</form>