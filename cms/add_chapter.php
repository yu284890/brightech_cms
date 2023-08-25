<section>
    <form action="" method="post">
        chapter名:<br>
        <input type="text" name="chapter_name" value=""><br>
        <br>
        公開日:<br>
        <input type="date" name="date" value=""><br>
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
session_start();
$comic_id = $_GET["id"];
var_dump($comic_id);


function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}



if((strtotime($_POST["date"]))-strtotime("now")>=0){
    echo (strtotime($date)-strtotime("now"));

    $user = "brightech";
    $password = "brightech";

    $pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");




    $chaptername = h($_POST["chapter_name"]);
    $date =$_POST["date"];


    $stmt = $pdo->prepare("INSERT INTO mst_chapters (comic_id,chapter_name,date) VALUES (:comic_id,:chaptername,:date);");
    //$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");
    var_dump($date);
    // var_dump($date->format("y-m-d"));


    $stmt->bindParam( ':comic_id', $comic_id);
    $stmt->bindParam( ':chaptername', $chaptername, PDO::PARAM_STR_CHAR);
    $stmt->bindParam( ':date', $date,PDO::PARAM_STR_CHAR);


    // (5) SQL実行
    $res = $stmt->execute();

    // (6) 該当するデータを取得
    //$stmt->execute(array(':title' => $title, ':writer' => $writer, ':example'->$example));
    // $dbh = null;
    header('Location: ./chapter_list.php?id='.$comic_id.'');
}else{
    
   

}



?>