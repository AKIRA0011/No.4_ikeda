<?php
//データベース接続クラス
class connector
{
  public $dsn;
  public $DB_PASSWORD;
  public $DB_USERNAME;
  public function __construct()
  {
    //設定ファイルの読み込み
    $ini = parse_ini_file('dbconfig.ini');
    $DB_DATABASE = $ini['DB_DATABASE'];
    $this->DB_USERNAME = $ini['DB_USERNAME'];
    $this->DB_PASSWORD = $ini['DB_PASSWORD'];
    $DB_PORT = $ini['port'];
    $DB_CHARSET = $ini['charset'];
    $DB_HOST = $ini['host'];
    $DB_OPTION = "port=" . $DB_PORT . ";charset=" . $DB_CHARSET . "";
    $this->dsn = "mysql:dbname=" . $DB_DATABASE . ";" . $DB_OPTION . ";host=" . $DB_HOST . ";";
  }
  public function connect()
  {
    try {
      $dbh = new PDO($this->dsn, $this->DB_USERNAME, $this->DB_PASSWORD);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
    //エラー表示
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
  }
}
