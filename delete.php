<?php
session_start();
//データベース接続を読み込む
require('connect.php');

//削除するid取得
$id = $_GET['id'];

//データベースから削除するsql文の実行準備
$query = "DELETE FROM ToDoList WHERE id = :id";
$stmt = $dbh->prepare($query);

//変数の値をバインド
$stmt->bindValue(':id', $id);

//SQL文実行
$stmt->execute();

//idの連番をリセットするSQL文の実行準備
$query = "ALTER TABLE ToDoList auto_increment = 1";
$stmt = $dbh->prepare($query);

//SQL文実行
$stmt->execute();
$dbh = null;

//リダイレクト
header("Location: todo_list_page.php");
exit();
