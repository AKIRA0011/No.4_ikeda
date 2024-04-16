<?php
//データベース接続クラス
class Db
{
  private $pdo;
  public function __construct()
  {
    //設定ファイルの読み込み
    $ini = parse_ini_file('dbconfig.ini');
    $dbDatabase = $ini['DB_DATABASE'];
    $dbUsername = $ini['DB_USERNAME'];
    $dbPasseword = $ini['DB_PASSWORD'];
    $dbPort = $ini['DB_PORT'];
    $dbCharset = $ini['DB_CHARSET'];
    $dbHost = $ini['DB_HOST'];
    $dbOption = "port=" . $dbPort . ";charset=" . $dbCharset . "";
    $dsn = "mysql:dbname=" . $dbDatabase . ";" . $dbOption . ";host=" . $dbHost . ";";

    try {
      $this->pdo = new PDO($dsn, $dbUsername, $dbPasseword);
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
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }

  /**
   * 1件のデータに対するselect文実行
   */
  public function selectOne($query, $params)
  {
    try {
      $stmt = $this->pdo->prepare($query);
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
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
    } catch (PDOException $e) {
      echo "エラーメッセージ：" . $e->getMessage();
      die();
    }
  }
}
