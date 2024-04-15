<?php
session_start();

//データベース接続クラスのファイル読み込み
require('connect.php');

//クラスの生成
$connector = new connector();
$dbh = $connector->connect();

//文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require('multibyteTrim.php');

//追加画面から入力されたタイトル、内容、作成日を取得
$title = multibyteTrim($_POST['title']);
$todo = multibyteTrim($_POST['content']);
$createdDate = date("Y-m-d H:i:s");

//空白のみが入力されていた場合
if (empty($title)) {
  $_SESSION['flash']['title'] = 'タイトルは必須項目です';
}
if (empty($todo)) {
  $_SESSION['flash']['content'] = '内容は必須項目です';
}
if (mb_strlen($title) >= 30) {
  $_SESSION['flash']['title'] = 'タイトルは３０文字未満で書いてください';
}
if (mb_strlen($title) >= 200) {
  $_SESSION['flash']['content'] = '内容は２００文字未満で書いてください';
}

//バリデーション処理postが空だったらリダイレクト
if (empty($title) || empty($todo) || mb_strlen($title) >= 30 || mb_strlen($todo) >= 200) {
  header("Location: todo_list_page.php");
  exit();
} else {
  try {

    //テーブルにタイトル、内容、作成日を追加するためのsql文の実行準備
    $query = "INSERT INTO ToDoList (title,todo,cre) VALUES (:title,:todo,:createdDate)";
    $stmt = $dbh->prepare($query);

    //変数の値をバインド
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
    $stmt->bindValue(':createdDate', $createdDate, PDO::PARAM_STR);

    //sql文の実行
    $stmt->execute();

    //接続終了
    $dbh = null;

    //リダイレクト
    header("Location: todo_list_page.php");
    exit();
  } catch (PDOException $e) {
    echo "処理に失敗しました。";
    die();
  }
}
