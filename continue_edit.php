<?php

//データベース接続を読み込む
require('connect.php');


    //id取得
    $id = $_GET['id'];
    

    //sql文
    $sql = "SELECT * FROM ToDoList WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    //クエリの設定
    $stmt->bindValue(':id',$id,PDO::PARAM_INT);
    //実行
    $stmt->execute();

    //タイトルテキストを変数に入れる
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $todo = $row['todo'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>編集画面</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="title-area">
        <h1>編集画面</h1>
    </div>
    <form method="post" action="continue.php">
                <label for="title">タイトル</label><br>
                <input type="text" id="title" class="text" name="title" placeholder="テキストを入力" value="<?php echo $title;?>"><br>
                <label for="text">内容</label><br>
                <input id="text" name="text" placeholder="テキストを入力" value="<?php echo $todo;?>"><br>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="button" value="登録">登録</button>       
                <a href="index.php" class="textarea">戻る</a>
            </form>
</body>

</html>