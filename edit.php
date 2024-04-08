<?php

//データベース接続を読み込む
require('connect.php');

//edit_page.phpから編集するidを取得
$id = $_POST['id'];

//更新するタイトル、内容、更新日
$title = $_POST['title'];
$todo = $_POST['content'];
$editDate = date("Y-m-d H:i:s");

//SQL文の実行準備
$sql = "UPDATE ToDoList SET title=:title,todo=:todo,upd=:editDate WHERE id = :id";
$stmt = $dbh->prepare($sql);

//変数の値をバインド
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':editDate', $upd, PDO::PARAM_STR);

//SQL文実行
$stmt->execute();

//リダイレクト
header("Location: todo_list_page.php");

//接続終了
exit();
