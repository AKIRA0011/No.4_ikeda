<?php
session_start();

//データベース接続を読み込む
require('connect.php');

//バリデーション処理 全角スペースを含んだtrim()
function mbTrim($str)
{
  return preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $str);
}

//edit_page.phpから編集するidを取得
$id = $_POST['id'];

//更新するタイトル、内容、更新日
$title = mbTrim($_POST['title']);
$todo = mbTrim($_POST['content']);
$editDate = date("Y-m-d H:i:s");

//バリデーション処理 空っぽだった場合
if (empty($title) || empty($todo)) {

  //リダイレクト
  header("Location: todo_list_page.php");
  exit();
} else {
  try {

    //入力した内容にデータベースの中身を編集するSQL文の実行準備
    $query = "UPDATE ToDoList SET title=:title,todo=:todo,upd=:editDate WHERE id = :id";
    $stmt = $dbh->prepare($query);

    //変数の値をバインド
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
    $stmt->bindValue(':editDate', $upd, PDO::PARAM_STR);

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
