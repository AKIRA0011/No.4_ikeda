<?php
session_start();

// データベースクラスのファイル読み込み
require_once('private/ToDoListDao.php');

// 文字列の先頭、末尾にある空白などを削除する関数の読みこみ（全角スペース対応）
require_once('private/functions.php');

// クラスの生成
$toDoListDao = new ToDoListDao();

// edit_page.phpから編集するidを取得
$id = $_POST['id'];

// 更新するタイトル、内容、更新日
$title = multibyteTrim($_POST['title']);
$content = multibyteTrim($_POST['content']);
$editedDate = date("Y-m-d H:i:s");

// タイトル、内容に空白のみが入力されていた場合
if (empty($title)) {
  $_SESSION['flash']['title'] = 'タイトルは必須項目です';
}
if (empty($content)) {
  $_SESSION['flash']['content'] = '内容は必須項目です';
}

// タイトル、内容が文字数制限を超えた場合
if (mb_strlen($title) >= 30) {
  $_SESSION['flash']['title'] = 'タイトルは３０文字未満で書いてください';
}
if (mb_strlen($title) >= 200) {
  $_SESSION['flash']['content'] = '内容は２００文字未満で書いてください';
}

// バリデーション処理 ・タイトル、内容が空だった場合・文字数制限を超えた場合
if (empty($title) || empty($content)|| mb_strlen($title) >= 30 || mb_strlen($todo) >= 200) {

  // リダイレクト
  header("Location: index.php");
  exit();
} else {
  try {
    $toDoListDao->edit($title, $content, $editedDate, $id);
    header("Location: index.php");
    exit();
  } catch (PDOException $e) {
    echo "処理に失敗しました。";
    die();
  }
}
