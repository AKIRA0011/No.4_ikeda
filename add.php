<?php
//データベース接続を読み込む
require('connect.php');

//input.phpの値を取得
//タイトル
$title = $_POST['title'];
//内容
$todo = $_POST['text'];
//作成日
$cre = date("Y-m-d H:i:s");


    
//sql文
$sql = "INSERT INTO ToDoList (title,todo,cre) VALUES (:title,:todo,:cre)";
$stmt = $dbh->prepare($sql);
//クエリの設定
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':todo',$todo,PDO::PARAM_STR);
$stmt->bindValue(':cre',$cre,PDO::PARAM_STR);
//クエリの実行
$stmt->execute();

//接続終了
$dbh = null;
//リダイレクト
header("Location: index.php");
    
exit();
    
?>