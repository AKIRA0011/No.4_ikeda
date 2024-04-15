<?php
session_start();
//データベースクラスのファイル読み込み
require('private/ToDoListDao.php');

//クラスの生成
$ToDoListDao = new ToDoListDao();

//削除するid取得
$id = $_POST['id'];

$ToDoListDao->delete($id);

//リダイレクト
header("Location: index.php");
exit();
