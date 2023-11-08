<!-- データベース接続 -->
<?php
$DB_DATABASE = 'ToDoList';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'root';
$DB_OPTION = 'port=3306;charset=utf8';
$dsn = "mysql:dbname=".$DB_DATABASE.";".$DB_OPTION.";host=localhost";

try{
    $dbh=new PDO($dsn,$DB_USERNAME,$DB_PASSWORD);
    //エラー表示
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //sql文実行
    $sql = "SELECT *FROM ToDoList";
    $stmt = $dbh->query($sql);
    //結果の取り出し
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //接続終了
    $dbh = null;

    echo "接続完了";
}catch(PDOException $e){
    echo "エラーメッセージ：".$e -> getMessage();
    //全ての命令を中止する
    die();
    }
?>


<!DOCTYPE html>
<html land="ja">
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>
</head>
<body>
    <h1>ToDoリスト</h1>
    <table border = "1" style="border-collapse:collapse" width="1300">
        <tr bgcolor = "#f0908d">
            <th width="3%">番号</th>
            <th width="15%">タイトル</th>
            <th width="55%">内容</th>
            <th width="10%">作成日</th>
            <th width="10%">更新日</th>
            <th width="5%"></th>
        </tr>

        <tr>
            <?php
            foreach($result as $row){
                $num = 1;
                echo "<td>".$num."</td>\n";
                echo "<td>".$row['title']."</td>\n";
                echo "<td>".$row['text']."</td>\n";
                echo "<td>".$row['create']."</td>\n";
                echo "<td>".$row['update']."</td>\n";
                echo "<td align='center'>\n<button type='button'>編集</button>\n
                <button type='button'>削除</button>\n</td>";
                $num++;
            }
            
            ?>
        </tr>
    </table>

</body>


</html>
