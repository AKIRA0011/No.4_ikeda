<?php
session_start();

//設定ファイルの読み込み
$ini = parse_ini_file('dbconfig.ini');
$DB_DATABASE = $ini['DB_DATABASE'];
$DB_USERNAME = $ini['DB_USERNAME'];
$DB_PASSWORD = $ini['DB_PASSWORD'];
$DB_port = $ini['port'];
$DB_charset = $ini['charset'];
$DB_host = $ini['host'];
$DB_OPTION = "port=" . $DB_port . ";charset=" . $DB_charset . "";
$dsn = "mysql:dbname=" . $DB_DATABASE . ";" . $DB_OPTION . ";host=" . $DB_host . ";";

try {
  $dbh = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);

  //エラー表示
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "エラーメッセージ：" . $e->getMessage();

  //全ての命令を中止する
  die();
}
