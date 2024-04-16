<?php
session_start();
// データベースクラスのファイル読み込み
require_once('private/ToDoListDao.php');

//クラスの生成
$toDoListDao = new ToDoListDao();

// 削除するid取得
$id = $_POST['id'];

$toDoListDao->delete($id);

// リダイレクト
header("Location: index.php");
exit();
