<?php
session_start();

//データベース接続を読み込む
require('connect.php');

//バリデーション処理 全角スペースを含んだtrim()
function mbTrim($str)
{
    return preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $str);
}

//追加画面から入力されたタイトル、内容、作成日を取得
$title = mbTrim($_POST['title']);
$todo = mbTrim($_POST['content']);
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
        $sql = "INSERT INTO ToDoList (title,todo,createDate) VALUES (:title,:todo,:createDate)";
        $stmt = $dbh->prepare($sql);

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
