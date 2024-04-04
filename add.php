<?php

//データベース接続を読み込む
require('connect.php');

//追加画面から入力されたタイトル、内容、作成日を取得
$title = $_POST['title'];
$todo = $_POST['text'];
$cre = date("Y-m-d H:i:s");

//sql文の実行準備
$sql = "INSERT INTO ToDoList (title,todo,cre) VALUES (:title,:todo,:cre)";
$stmt = $dbh->prepare($sql);

//変数の値をバインド
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':cre', $cre, PDO::PARAM_STR);

//sql文の実行
$stmt->execute();

//接続終了
$dbh = null;

//リダイレクト
header("Location: todo_list_page.php");
exit();
