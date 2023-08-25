<?php

session_start();

$chapter_id = $_GET['id'];

function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}



$user = "brightech";
$password = "brightech";

$pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");
$stmt = $pdo->prepare("SELECT * FROM mst_chapters WHERE id = :chapter_id");
//$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

// (4) 登録するデータをセット
$stmt->bindParam(':chapter_id', $chapter_id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);


$comic_id = $row['comic_id'];
$chapter_name = $row['chapter_name'];
$date = $row['date'];
var_dump("$comic_id");
var_dump("$chapter_name");
var_dump("$date");
var_dump("$chapter_id");

//update処理
if (isset($_POST["chapter_name"])) {
    $new_chapter_name = h($_POST["chapter_name"]);
    $new_date = $_POST["date"];
   


    // $pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");
    $stm = $pdo->prepare("UPDATE mst_chapters SET comic_id=:comic_id,chapter_name=:new_chapter_name,date=:new_date WHERE id=:chapter_id;");
    //$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

    // $stm = $pdo->prepare("UPDATE mst_titles SET title='testaaaa',writer='testwraaaiter',example='testexample' WHERE id=1");
    if((strtotime($_POST["date"]))-strtotime("now")>=0){
        $stm->bindParam(':comic_id', $comic_id);
        $stm->bindParam(':new_chapter_name', $new_chapter_name, PDO::PARAM_STR_CHAR);
        $stm->bindParam(':new_date', $new_date, PDO::PARAM_STR_CHAR);
        $stm->bindParam(':chapter_id', $chapter_id,PDO::PARAM_INT);
      
    
        // (5) SQL実行
        $res = $stm->execute();
        header('Location: ./chapter_list.php?id='.$comic_id.'');
    }else{
        header('Location: ./edit_chapter.php?id='.$chapter_id.'');

    }


}








?>

<section>
    <form action="" method="post">
        chapter名:<br>
        <input type="text" name="chapter_name" value="<?php echo $chapter_name; ?>"><br>
        <br>
        date:<br>
        <input type="date" name="date" value="<?php echo $date; ?>"><br>
        <input type="submit" value="登録">
    </form>
</section>