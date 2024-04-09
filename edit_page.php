<?php
session_start();
//データベース接続を読み込む
require('connect.php');

//エスケープ処理
function escape($s)
{
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

try {
  //編集するid取得
  $id = $_GET['id'];

  //sql文の実行準備
  $query = "SELECT * FROM ToDoList WHERE id = :id";
  $stmt = $dbh->prepare($query);

  //変数の値をバインド
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  //sql文の実行
  $stmt->execute();

  //10行目で取得したデータからタイトル,内容を取得する。
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $title = $row['title'];
  $todo = $row['todo'];
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
    <label for="title">タイトル</label><br>
    <input type="text" id="title" class="title" name="title" value="<?php echo escape($title); ?>"><br>
    <label for="content">内容</label><br>
    <textarea id="content" class="content" name="content"><?php echo escape($todo); ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="push">登録</button>
    <a href="todo_list_page.php" class="back">戻る</a>
  </form>
</body>

</html>