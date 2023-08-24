<?php
  session_start();
  //MySQLに接続
  $mysqli = new mysqli('localhost', 'brightech', 'brightech', 'cms');

  $sql = "SELECT * FROM adm_admin_users;";
  $password = $_POST['password'];
  $password_hash = hash("sha256", $password);
  $result = $mysqli->query($sql);

  if (isset($_POST['mail'])){
    while($row = $result->fetch_assoc() ){
      if ($row['mail']==$_POST['mail']){
        if($row['password']==$password_hash){
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['mail'] = $row['mail'];

        }
          
        }
    }

  }


  if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
  }

  /**
   * 課題２：データベースにPOSTで取得したusername,password(ハッシュ化)と一致するものがあればセッションを開始し
   * $_SESSION['user_id']にユーザIDを,$_SESSION['user_name']にユーザ名を格納する処理を書いてください
   */
  if(isset($_SESSION['user_id'])) {
    
    header('Location: ./comic_list.php');
    exit();
  }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="login.php" method="post">
		  メールアドレス: <input type="email" name="mail" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>