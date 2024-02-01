<?php

//データベース接続を読み込む
require('connect.php');


    //continue_edit.phpの値を取得
    //タイトル
    $title = $_POST['title'];
    //内容
    $todo = $_POST['text'];
    //更新日
    $upd = date("Y-m-d H:i:s");
    //id取得
    $id = $_POST['id'];
    

    //sql文
    $sql = "UPDATE ToDoList SET title=:title,todo=:todo,upd=:upd WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    //クエリの設定
    $stmt->bindValue(':id',$id,PDO::PARAM_INT);
    $stmt->bindValue(':title',$title,PDO::PARAM_STR);
    $stmt->bindValue(':todo',$todo,PDO::PARAM_STR);
    $stmt->bindValue(':upd',$upd,PDO::PARAM_STR);
    //実行
    $stmt->execute();

    //リダイレクト
    header("Location: index.php");
    //接続終了
    exit();
    
?>