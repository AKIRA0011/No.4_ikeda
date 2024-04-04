<?php

//データベース接続を読み込む
require('connect.php');

//編集するid取得
$id = $_GET['id'];

//sql文の実行準備
$sql = "SELECT * FROM ToDoList WHERE id = :id";
$stmt = $dbh->prepare($sql);

//変数の値をバインド
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//SQL実行
$stmt->execute();

//データベースからタイトル,内容を取得する。
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$title = $row['title'];
$todo = $row['todo'];

?>
<!DOCTYPE html>
<html lang="en">

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
        <input type="text" id="title" class="text" name="title" placeholder="テキストを入力" value="<?php echo $title; ?>"><br>
        <label for="content">内容</label><br>
        <input id="content" name="text" placeholder="テキストを入力" value="<?php echo $todo; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="push" value="登録">登録</button>
        <a href="todo_list_page.php" class="back">戻る</a>
    </form>
</body>

</html>