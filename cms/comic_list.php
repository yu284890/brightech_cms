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





?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
<?php echo $link_add; ?>



