<?php
session_start();

// データベースクラスのファイル読み込み
require_once('private/ToDoListDao.php');

// 文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require_once('private/functions.php');

// クラスの生成
$toDoListDao = new ToDoListDao();

// 追加画面から入力されたタイトル、内容、作成日を取得
$title = multibyteTrim($_POST['title']);
$content = multibyteTrim($_POST['content']);
$createdDate = date("Y-m-d H:i:s");

// 空白のみが入力されていた場合
if (empty($title)) {
  $_SESSION['flash']['title'] = 'タイトルは必須項目です';
}
if (empty($content)) {
  $_SESSION['flash']['content'] = '内容は必須項目です';
}

// 文字数制限を超えた場合
if (mb_strlen($title) >= 30) {
  $_SESSION['flash']['title'] = 'タイトルは３０文字未満で書いてください';
}
if (mb_strlen($title) >= 200) {
  $_SESSION['flash']['content'] = '内容は２００文字未満で書いてください';
}

// バリデーション処理,postが空だったとき、文字数制限を超えたときリダイレクト
if (empty($title) || empty($content)|| mb_strlen($title) >= 30 || mb_strlen($todo) >= 200) {
  header("Location: index.php");
  exit();
} else {
  $toDoListDao->insert($title, $content, $createdDate);
  header("Location: index.php");
  exit();
}
