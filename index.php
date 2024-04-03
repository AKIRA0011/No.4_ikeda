<?php

//データベース接続を読み込む
require('connect.php');
$modal_display_style = "style='display:none'";

//post処理
if(isset($_POST['register'])){
    $modal_display_style="style='display:block'";
}

//sql文実行
$sql = "SELECT *FROM ToDoList";
$stmt = $dbh->query($sql);

//結果の取り出し
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//接続終了
$dbh = null;
?>

<!DOCTYPE html>
<html land="ja">
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>

    <!--CSSの読み込み-->
    <link rel="stylesheet" href="style.css">

    <!--JavaScriptの読み込み-->
    <script src="modal.js"></script>
</head>
<body>
    <div>
        <h1>ToDoリスト</h1>
    </div>
    <div align="right">
        <button type="button" id="addButton">
            追加
        </button>
    </div>
    <table border = "1" style="border-collapse:collapse" width="1520">
        <tr bgcolor = "#f0908d">
            <th width="3%">番号</th>
            <th width="15%">タイトル</th>
            <th width="55%">内容</th>
            <th width="10%">作成日</th>
            <th width="10%">更新日</th>
            <th width="5%"></th>
        </tr>

            <!--データベース表-->
            <?php
            foreach($result as $row){
            ?>
                <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['todo'] ?></td>
                <td><?php echo$row['cre'] ?></td>
                <td><?php echo $row['upd'] ?></td>
                <div>
                    <form method="post">
                        <td align='center'><a href="continue_edit.php?id=<?php echo $row['id'];?>" class="cntLink">編集</a>
                        <a href="delete.php?id=<?php echo $row['id'];?>">削除</a></td>
                    </form>
                </div>
                </tr>
            <?php } ?>
            
    
    </table>

    <!--追加モーダルウィンドウ-->
    <div id="addModal" class="addmodal">
        <div class="addmodal-content">

            <!-- ×表示 -->
            <span class="addclose">&times;</span>
            
            <!-- 入力フォーム -->
            <form method="post" action="add.php">
                <label for="title">タイトル</label><br>
                <input type="text" id="title" class="text" name="title" placeholder="テキストを入力" required><br>
                <label for="text">内容</label><br>
                <textarea id="text" name="text" placeholder="テキストを入力" required></textarea><br>
                <button type="submit" value="登録">登録</button>
            </form>
        </div>
    </div>
</body>
</html>

<!-- //編集モーダルウィンドウ
<div id="cntModal" class="cntmodal">
    <div class="cntmodal-content">
        //×表示 
        <span class="cntclose">&times;</span>
        //入力フォーム
        <form method="post" action="continue.php">
            <label for="title">タイトル</label><br>
            <input type="text" id="title" class="text" name="title" placeholder="テキストを入力" required><br>
            <label for="text">内容</label><br>
            <textarea id="text" name="text" placeholder="テキストを入力" required></textarea><br>
            <button type="submit" value="登録">登録</button>
        </form>
    </div>   
</div> -->