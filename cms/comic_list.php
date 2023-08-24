<?php
// 接続


//escape function
session_start();
function h(string $str): string{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

$usermail = $_SESSION['mail'];

if (isset($_SESSION['user_id'])) {//ログインしているとき
    $msg = 'こんにちは' . htmlspecialchars($usermail, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
    $link_add = '<a href="add_comic.php">漫画追加</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}

$mysqli = new mysqli('localhost', 'brightech', 'brightech', 'cms');

  $sql = "SELECT * FROM mst_titles;";
  $result = $mysqli->query($sql);


  echo "<table>\n";
  echo "<tr><th>ID</th><th>title</th><th>writer</th><th>説明</th></tr>\n";
  while($row = $result->fetch_assoc() ){
      // 何行も文字列書くときはこのようなヒアドキュメントが便利
      $html = <<<TEXT
  <tr>
    <td>{$row['id']}</td>
    <td>{$row['title']}</td>
    <td>{$row['writer']}</td>
    <td>{$row['example']}</td>
    <td><a href="edit_comic.php?id={$row['id']}">編集</a></td>
  </tr>
  TEXT;
      echo $html;
  }
  echo "</table>";




?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
<?php echo $link_add; ?>



