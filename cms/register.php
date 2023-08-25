<section>
    <form action="" method="post">
        メールアドレス:<br>
        <input type="email" name="mail" value=""><br>
        <br>
        パスワード:<br>
        <input type="text" name="password" value=""><br>
        <input type="submit" value="登録">
        <a href="login.php">ログイン画面へ</a>
    </form>
</section>

<?php
// 接続


//escape function
function h(string $str): string{
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}



$user = "brightech";
$password="brightech";


var_dump($user);


$dbh = new PDO("mysql:host=localhost; dbname=cms; charset=utf8", "$user", "$password");


$mail = h($_POST["mail"]);
$pass = h($_POST["password"]);
$password_hash = hash("sha256", $pass);
$stmt = $dbh->prepare("INSERT INTO adm_admin_users (mail, password) VALUES (:mail, :pass)");
$stmt->execute(array(':mail' => $mail,':pass' => $password_hash));
$dbh = null;




?>