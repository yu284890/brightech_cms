<?php

session_start();

if (!isset($_GET['id'])){
    echo "不正な遷移です";
    exit;
    

}
$id = $_GET['id'];


function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}



$user = "brightech";
$password = "brightech";


// var_dump($user);






try {  
    $pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->beginTransaction();
    $stmt = $pdo->prepare("DELETE FROM mst_titles WHERE id = :id;");

    // $stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = 17");

    // (4) 登録するデータをセット
    $stmt->bindParam(':id', $id);
    $stm = $pdo->prepare("DELETE FROM mst_chapters WHERE comic_id =:id;");
    $stm->bindParam(':id', $id);
    $res = $stmt->execute();
    $stm->execute();
    $pdo->commit();
   
    
  } catch (Exception $e) {
    var_dump(444);
    $pdo->rollBack();
    echo "失敗しました。" . $e->getMessage();
  }



header('Location: ./comic_list.php');










?>

