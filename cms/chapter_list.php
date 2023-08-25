<?php
// 接続


//escape function
session_start();
if(!(isset($_SESSION['user_id']))) {
    
    header('Location: ./login.php');
    exit();
}else{
    $comic_id = $_GET["id"];
var_dump($comic_id);
function h(string $str): string{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

$usermail = $_SESSION['mail'];

if (isset($_SESSION['user_id'])) {//ログインしているとき
    $msg = 'こんにちは' . htmlspecialchars($usermail, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="add_chapter.php?id='.$comic_id.'">chapterを新規追加</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}

$mysqli = new mysqli('localhost', 'brightech', 'brightech', 'cms');

  $sql = "SELECT * FROM mst_chapters WHERE comic_id=".$comic_id.";";
  $result = $mysqli->query($sql);


  echo "<table>\n";
  echo "<tr><th>chapterName</th><th>date</th></tr>\n";
  while($row = $result->fetch_assoc() ){
      // 何行も文字列書くときはこのようなヒアドキュメントが便利
      $html = <<<TEXT
  <tr>
    <td>{$row['chapter_name']}</td>
    <td>{$row['date']}</td>
    <td><a href="edit_chapter.php?id={$row['id']}">編集</a></td>
    <td><a href="delete_chapter.php?id={$row['id']}">削除</a></td>

  </tr>
  TEXT;
      echo $html;
  }
  echo "</table>";
    
}

?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
<?php echo '<a href="comic_list.php">漫画一覧へ</a>'; ?>




