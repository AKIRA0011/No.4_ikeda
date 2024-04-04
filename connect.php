<?php
$DB_DATABASE = 'ToDoList';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'root';
$DB_OPTION = 'port=3306;charset=utf8';
//$dsn = "mysql:dbname=".$DB_DATABASE.";".$DB_OPTION.";host=localhost";
$dsn = "mysql:dbname=" . $DB_DATABASE . ";" . $DB_OPTION . ";host=host.docker.internal";

try {
    $dbh = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);

    //エラー表示
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "エラーメッセージ：" . $e->getMessage();

    //全ての命令を中止する
    die();
}
