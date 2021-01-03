<?php
require_once("db_connect.php");
if (!empty($_POST["name"]) && !empty($_POST["password"])) {
    $pdo=db_connect();
    try {
        $st = $pdo->prepare("INSERT INTO users(name,password) VALUES(:name,:password) ");
        $st->execute(array(':name'=>$_POST['name'],':password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)));
        echo "登録が完了しました。<br>";
    } catch (PDOException $e) {
        echo "データベースエラー：".$e;
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-wrapper">
        <h1 class="top-items">ユーザー登録画面</h1>
        <div class="top-items">
            <a class="green top button" href="login.php">ログイン画面へ</a>
        </div>    
    </div>
    <form method="POST" action="">
        <input class="textbox" type="text" name="name" placeholder="ユーザー名"><br>
        <input class="textbox" type="password" name="password" placeholder="パスワード"><br>
        <input class="blue large button" type="submit" value="新規登録">
    </form>
</body>
</html>