<?php

session_start();

$chapter_id = $_GET['id'];


$user = "brightech";
$password = "brightech";


// var_dump($user);


$pdo = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");

$stmt = $pdo->prepare("SELECT comic_id FROM mst_chapters WHERE id = :chapter_id;");
$stmt->bindParam(':chapter_id', $chapter_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("DELETE FROM mst_chapters WHERE id = :chapter_id;");
//$stmt = $pdo->prepare("SELECT * FROM mst_titles WHERE id = :id");

// (4) 登録するデータをセット
$stmt->bindParam(':chapter_id', $chapter_id);
$stmt->execute();






header('Location: ./chapter_list.php?id='.$row["comic_id"].'');
