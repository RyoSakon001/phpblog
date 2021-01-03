<?php
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();

// 提出ボタンが押された場合
if (!empty($_POST)) {
    // titleとstockの入力チェック
    if (empty($_POST['title'])) {
        echo 'タイトルが未入力です。';
    } elseif (empty($_POST['date'])) {
        echo '発売日が未入力です。';
    } elseif (empty($_POST['stock'])) {
        echo '在庫数が未入力です。';
    } 

    if (!empty($_POST['title'])&&!empty($_POST['date'])&&!empty($_POST['stock'])) {
        // 入力したtitleとstockを格納
        $title = $_POST["title"];
        $date = $_POST["date"];
        $stock = $_POST["stock"]; 

        // PDOのインスタンスを取得
        $pdo=db_connect();

        try {
            // SQL文の準備
            $sql="INSERT INTO books(title,date,stock) VALUES(:title,:date,:stock)";
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(":title",$title);
            $stmt->bindParam(":date",$date);
            $stmt->bindParam(":stock",$stock);
            $stmt->execute();
            // main.phpにリダイレクト
            header("Location:main.php");
        } catch (PDOException $e) {
            // エラーメッセージの出力
            echo $e;
            // 終了
            die();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>本 登録画面</h1>
    <form method="POST" action="">
        <input class="smaller textbox" type="text" name="title" id="title" placeholder="タイトル">
        <br>
        <input class="smaller textbox" type="date" name="date" id="date" placeholder="発売日"><br>
        在庫数<br>
        <input class="smaller textbox" type="number" name="stock" id="stock" placeholder="選択してください"><br>
        <input class="blue large button" type="submit" value="登録" id="post" name="post">
    </form>
</body>
</html>