<?php
//データベース接続クラス
class Db
{
  private $dbh;
  public function __construct()
  {
    //設定ファイルの読み込み
    $ini = parse_ini_file('dbconfig.ini');
    $DB_DATABASE = $ini['DB_DATABASE'];
    $DB_USERNAME = $ini['DB_USERNAME'];
    $DB_PASSWORD = $ini['DB_PASSWORD'];
    $DB_PORT = $ini['DB_PORT'];
    $DB_CHARSET = $ini['DB_CHARSET'];
    $DB_HOST = $ini['DB_HOST'];
    $DB_OPTION = "port=" . $DB_PORT . ";charset=" . $DB_CHARSET . "";
    $dsn = "mysql:dbname=" . $DB_DATABASE . ";" . $DB_OPTION . ";host=" . $DB_HOST . ";";

    try {
      $this->dbh = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }

  /**
   * select文実行
   */
  public function selectAll($query, $params = null)
  {
    try {
      $stmt = $this->dbh->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }

  /**
   * 1件のデータに関するselect文実行
   */
  public function selectOne($query, $params)
  {
    try {
      $stmt = $this->dbh->prepare($query);
      $stmt->execute($params);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }


  /**
   * insert,update,delete文実行
   */
  public function write($query, $params)
  {
    try {
      var_dump($params);
      $stmt = $this->dbh->prepare($query);
      $stmt->execute($params);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }
}
