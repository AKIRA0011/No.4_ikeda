<?php
session_start();

//データベース接続クラスのファイル読み込み
require('connect.php');

//クラスの生成
$class = new connect();
$dbh = $class->pdo();

//文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require('multibyteTrim.php');

//クラスの生成
$Trim_class = new multibyteTrim();

//追加画面から入力されたタイトル、内容、作成日を取得
$title = $Trim_class->multibyteTrim($_POST['title']);
$todo = $Trim_class->multibyteTrim($_POST['content']);
$createDate = date("Y-m-d H:i:s");

//空白のみが入力されていた場合
if (empty($title)) {
  $_SESSION['flash']['title'] = 'タイトルは必須項目です';
}
if (empty($todo)) {
  $_SESSION['flash']['content'] = '内容は必須項目です';
}

//バリデーション処理postが空だったらリダイレクト
if (empty($title) || empty($todo)) {
  header("Location: todo_list_page.php");
  exit();
} else {
  try {

    //テーブルにタイトル、内容、作成日を追加するためのsql文の実行準備
    $query = "INSERT INTO ToDoList (title,todo,cre) VALUES (:title,:todo,:createDate)";
    $stmt = $dbh->prepare($query);

    //変数の値をバインド
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
    $stmt->bindValue(':createDate', $cre, PDO::PARAM_STR);

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
