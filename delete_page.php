<?php
session_start();

// 削除するid取得
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>最終確認</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div>
    <h1 class="caution">最終確認!!</h1>
  </div>
  <div>
    <h2>本当に削除していいですか？</h2>
  </div>
  <form method="post" action="delete.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="push">はい</button>
    <a href="index.php" class="back">いいえ</a>
  </form>
</body>

</html>