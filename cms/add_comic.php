<section>
    <form action="" method="post">
        漫画名:<br>
        <input type="text" name="title" value=""><br>
        <br>
        作家名:<br>
        <input type="text" name="writer" value=""><br>
        説明:<br>
        <input type="text" name="example" value=""><br>
        <input type="submit" value="登録">
    </form>
</section>

<?php
// 接続
// //MySQLに接続
// $mysqli = new mysqli('localhost', 'brightech', 'brightech', 'cms');

// $sql = "SELECT * FROM adm_admin_users;";
// $password = $_POST['password'];
// $password_hash = hash("sha256", $password);
// $result = $mysqli->query($sql);

// var_dump($result);
// $mysqli->close();

// exit;
//escape function
function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}



$user = "brightech";
$password = "brightech";


// var_dump($user);


$pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");

// var_dump($_POST["title"]);
// var_dump(1111);



$title = h($_POST["title"]);
$writer = h($_POST["writer"]);
$example = h($_POST["example"]);
// var_dump($title);
// var_dump($writer);
// var_dump($example);



$stmt = $pdo->prepare("INSERT INTO mst_titles (title,writer,example) VALUES (:title, :writer,:example)");
//$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

// (4) 登録するデータをセット
$id = 1;
$stmt->bindParam( ':title', $title, PDO::PARAM_STR_CHAR);
$stmt->bindParam( ':writer', $writer, PDO::PARAM_STR_CHAR);
$stmt->bindParam( ':example', $example, PDO::PARAM_STR_CHAR);

// (5) SQL実行
$res = $stmt->execute();

// (6) 該当するデータを取得
if( $res ) {
	var_dump($res);
}
//$stmt->execute(array(':title' => $title, ':writer' => $writer, ':example'->$example));
// $dbh = null;
// header('Location: ./comic_list.php');




?>