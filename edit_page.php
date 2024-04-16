<?php
session_start();
// データベースクラスのファイル読み込み
require_once('private/ToDoListDao.php');

// バリデーション、エスケープ処理関数群の読み込み
require_once("private/functions.php");

// クラスの生成
$toDoListDao = new ToDoListDao();

try {
  // 編集するid取得
  $id = $_GET['id'];

  // 編集するidのデータを取得し、タイトル、内容を取得する。
  $row = $toDoListDao->findOne($id);
  $title = $row['title'];
  $content = $row['content'];
} catch (PDOException $e) {
  echo "処理に失敗しました。";
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>編集画面</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div>
    <h1>編集画面</h1>
  </div>
  <form method="post" action="edit.php">
    <label for="title">タイトル：３０文字未満</label><br>
    <input type="text" id="title" class="title" name="title" value="<?php echo escape($title); ?>"><br>
    <label for="content">内容：２００文字未満</label><br>
    <textarea id="content" class="content" name="content"><?php echo escape($content); ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="push">登録</button>
    <a href="index.php" class="back">戻る</a>
  </form>
</body>

</html>