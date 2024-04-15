<?php

require_once("Db.php");

class ToDoListDao
{
  //DBインスタンス
  private $db;


  /**
   * コンストラクタ
   */
  public function __construct()
  {
    $this->db = new Db();
  }

  /**
   * ToDoリスト全件取得
   */
  public function findAll()
  {
    $query = "SELECT * FROM ToDoList";
    return $this->db->selectAll($query);
  }

  /**
   * ToDoリストからID指定で1件だけ取得
   */
  public function findOne($id)
  {
    $query = "SELECT *FROM ToDoList WHERE id=:id";
    $params = array(':id' => $id);
    return $this->db->selectOne($query, $params);
  }

  /**
   * ToDoListにデータ追加
   */
  public function insert($title, $content, $createdDate)
  {
    $query = "INSERT INTO ToDoList (title,content,createdAt) VALUES (:title,:content,:createdDate)";
    $params = array(':title' => $title, ':content' => $content, ':createdDate' => $createdDate);
    $this->db->write($query, $params);
  }

  /**
   * ToDoListからデータ削除
   */
  public function delete($id)
  {
    $query = "DELETE FROM ToDoList WHERE id =:id";
    $params = array(':id' => $id);
    $this->db->write($query, $params);
  }

  /**
   * ToDoListのデータ編集
   */
  public function edit($title, $content, $editedDate,$id)
  {
    $query = "UPDATE ToDoList SET title=:title,content=:content,updatedAt=:editedDate WHERE id=:id";
    $params = array(':title' => $title, ':content' => $content, ':editedDate' => $editedDate,":id"=>$id);
    $this->db->write($query, $params);
  }
}
