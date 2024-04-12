<?php
session_start();

//データベース接続クラスのファイル読み込み
require('connect.php');

//クラスの生成
$DB_connect_class = new connector();
$dbh = $class->connect();

//文字列の先頭、末尾にある空白などを削除するクラスの読みこみ（全角スペース対応）
require('multibyteTrim.php');

//edit_page.phpから編集するidを取得
$id = $_POST['id'];

//更新するタイトル、内容、更新日
$title = multibyteTrim($_POST['title']);
$todo = multibyteTrim($_POST['content']);
$editedDate = date("Y-m-d H:i:s");

//バリデーション処理 空っぽだった場合
if (empty($title) || empty($todo)) {

  //リダイレクト
  header("Location: todo_list_page.php");
  exit();
} else {
  try {

    //入力した内容にデータベースの中身を編集するSQL文の実行準備
    $query = "UPDATE ToDoList SET title=:title,todo=:todo,upd=:editedDate WHERE id = :id";
    $stmt = $dbh->prepare($query);

    //変数の値をバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
    $stmt->bindValue(':editedDate', $editedDate, PDO::PARAM_STR);

    //SQL文実行
    $stmt->execute();

    //リダイレクト
    header("Location: todo_list_page.php");

    //接続終了
    exit();
  } catch (PDOException $e) {
    echo "処理に失敗しました。";
    die();
  }
}
