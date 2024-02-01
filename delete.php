<?php

//データベース接続を読み込む
require('connect.php');

    //id取得
    $id = $_GET['id'];

    //sql文
    $sql = "DELETE FROM ToDoList WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    //クエリの設定
    $stmt->bindValue(':id',$id);
    //実行
    $stmt->execute();

    $sql = "ALTER TABLE ToDoList auto_increment = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $dbh = null;
    //リダイレクト
    header("Location: index.php");
    exit();
    //接続終了
    
?>