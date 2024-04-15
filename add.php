<?php
session_start();

//データベースクラスのファイル読み込み
require('private/ToDoListDao.php');

//クラスの生成
$ToDoListDao = new ToDoListDao();

//文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require('multibyteTrim.php');

//追加画面から入力されたタイトル、内容、作成日を取得
$title = multibyteTrim($_POST['title']);
$content = multibyteTrim($_POST['content']);
$createdDate = date("Y-m-d H:i:s");

//空白のみが入力されていた場合
if (empty($title)) {
  $_SESSION['flash']['title'] = 'タイトルは必須項目です';
}
if (empty($content)) {
  $_SESSION['flash']['content'] = '内容は必須項目です';
}

//バリデーション処理postが空だったらリダイレクト
if (empty($title) || empty($content)) {
  header("Location: index.php");
  exit();
} else {
  $ToDoListDao->insert($title, $content, $createdDate);
  header("Location: index.php");
}
