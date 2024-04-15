<?php
session_start();

//データベースクラスのファイル読み込み
require('private/ToDoListDao.php');

//クラスの生成
$ToDoListDao = new ToDoListDao();

//文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require('multibyteTrim.php');

//edit_page.phpから編集するidを取得
$id = $_POST['id'];

//更新するタイトル、内容、更新日
$title = multibyteTrim($_POST['title']);
$content = multibyteTrim($_POST['content']);
$editedDate = date("Y-m-d H:i:s");

//バリデーション処理 空っぽだった場合
if (empty($title) || empty($content)) {

  //リダイレクト
  header("Location: index.php");
  exit();
} else {
  try {
    $ToDoListDao->edit($title, $content, $editedDate, $id);

    //リダイレクト
    header("Location: index.php");

    //接続終了
    exit();
  } catch (PDOException $e) {
    echo "処理に失敗しました。";
    die();
  }
}
