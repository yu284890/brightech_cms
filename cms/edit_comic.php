<?php

session_start();

$id = $_GET['id'];

function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}



$user = "brightech";
$password = "brightech";


// var_dump($user);


$pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");

$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");
//$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

// (4) 登録するデータをセット
$stmt->bindParam(':id', $id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $row['title'];
$writer = $row['writer'];
$example = $row['example'];


//update処理
if (isset($_POST["title"])) {
    $new_title = h($_POST["title"]);
    $new_writer = h($_POST["writer"]);
    $new_example = h($_POST["example"]);


    // $pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");
    $stm = $pdo->prepare("UPDATE mst_titles SET title=:title,writer=:writer,example=:example WHERE id=:id");
    //$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

    // $stm = $pdo->prepare("UPDATE mst_titles SET title='testaaaa',writer='testwraaaiter',example='testexample' WHERE id=1");

    // $stm->bindParam(':title', $new_title, PDO::PARAM_STR_CHAR);
    $stm->bindParam(':writer', $new_writer, PDO::PARAM_STR_CHAR);
    $stm->bindParam(':example', $new_example, PDO::PARAM_STR_CHAR);
    $stm->bindParam(':id', $id, PDO::PARAM_INT);

    // (5) SQL実行
    $res = $stm->execute();

    header('Location: ./comic_list.php');

}








?>

<section>
    <form action="" method="post">
        漫画名:<br>
        <input type="text" name="title" value="<?php echo $title; ?>"><br>
        <br>
        作家名:<br>
        <input type="text" name="writer" value="<?php echo $writer; ?>"><br>
        説明:<br>
        <input type="text" name="example" value="<?php echo $example; ?>"><br>
        <input type="submit" value="登録">
    </form>
</section>