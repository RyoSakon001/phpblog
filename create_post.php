<?php
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();

// 提出ボタンが押された場合
if (!empty($_POST)) {
    // titleとcontentの入力チェック
    if (!empty($_POST['title'])) {
        echo 'タイトルが未入力です。';
    } elseif (!empty($_POST['content'])) {
        echo 'コンテンツが未入力です。';
    }

    if (!empty($_POST['title'])&&!empty($_POST['content'])) {
        // 入力したtitleとcontentを格納
        $title = $_POST["title"];
        $content = $_POST["content"]; 

        // PDOのインスタンスを取得
        $pdo=db_connect();

        try {
            // SQL文の準備
            $sql="INSERT INTO posts(title,content) VALUES(:title,:content)";
            // プリペアドステートメントの準備
            $stmt=$pdo->prepare($sql);
            // タイトルをバインド
            $stmt->bindParam(":title",$title);
            // 本文をバインド
            $stmt->bindParam(":content",$content);
            // 実行
            $stmt->execute();
            // index.phpにリダイレクト
            header("Location:index.php");
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <h1>記事登録</h1>
    <form method="POST" action="">
        title:<br>
        <input type="text" name="title" id="title" style="width:200px;height:50px;">
        <br>
        content:<br>
        <input type="text" name="content" id="content" style="width:200px;height:100px;"><br>
        <input type="submit" value="登録" id="post" name="post">
    </form>
</body>
</html>