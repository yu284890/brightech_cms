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

    $stmt = $pdo->prepare("DELETE FROM mst_titles WHERE id = :id;");

   

    // (4) 登録するデータをセット
    $stmt->bindParam(':id', $id);
    $stm = $pdo->prepare("DELETE FROM mst_chapters WHERE comic_id =:id;");
    $stm->bindParam(':id', $id);
    $pdo->beginTransaction();
    $stmt->execute();
    $stm->execute();
    $pdo->commit();
   
    
  } catch (PDOException $e) {
    var_dump(444);
    $pdo->rollBack();
    echo "PDO失敗しました。" . $e->getMessage();
  }catch(Exception $e){
   $pdo->rollBack();
    echo "失敗しました。" . $e->getMessage();

  }



header('Location: ./comic_list.php');










?>

