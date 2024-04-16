<?php
session_start();
// データベース接続クラスのファイル読み込み
require_once("private/ToDoListDao.php");

// バリデーション、エスケープ処理関数群の読み込み
require_once("private/functions.php");

// エラーメッセージのリセット
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
unset($_SESSION['flash']);

// クラスの生成
$toDoListDao = new ToDoListDao();

// ToDoListの取り出し
$toDoList = $toDoListDao->findAll();
?>

<!DOCTYPE html>
<html lang="ja">

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
  <?php echo isset($flash['title']) ? $flash['title'] : null ?></br>
  <?php echo isset($flash['content']) ? $flash['content'] : null ?>
  <div class="addButton">
    <button type="button">
      追加
    </button>
  </div>
  <table>
    <thead class="header">
      <tr>
        <th class="num">番号</th>
        <th class="title">タイトル</th>
        <th class="content">内容</th>
        <th class="create">作成日</th>
        <th class="edit">更新日</th>
        <th class="btn"></th>
      </tr>
    </thead>

    <!--データベース表-->
    <tbody>
      <?php
      foreach ($toDoList as $row) {
      ?>
        <tr>
          <td><?php echo escape($row['id']) ?></td>
          <td><?php echo escape($row['title']) ?></td>
          <td><?php echo escape($row['content']) ?></td>
          <td><?php echo escape($row['createdAt']) ?></td>
          <td><?php echo escape($row['updatedAt']) ?></td>
          <td>
            <div>
              <a href="edit_page.php?id=<?php echo $row['id']; ?>" class="edit">編集</a></br>
              <a href="delete_page.php?id=<?php echo $row['id']; ?>" class="delete">削除</a>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!--追加モーダルウィンドウ-->
  <div class="addModal">
    <div class="addModalContent">

      <!-- ×表示 -->
      <button class="addClose">&times;</button>

      <!-- 入力フォーム -->
      <form method="post" action="add.php">
        <label for="title">タイトル</label><br>
        <input type="text" id="title" class="title" name="title" maxlength="29" placeholder="テキストを入力(３０文字未満)" required><br>
        <label for="content">内容</label><br>
        <textarea id="content" class="content" name="content" maxlength="65535" placeholder="テキストを入力(２００文字未満)" required></textarea><br>
        <button type="submit">登録</button>
      </form>
    </div>
  </div>
</body>

</html>