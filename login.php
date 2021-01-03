<?php
require_once('db_connect.php');
// セッション開始。誰がアクセスしたか？
session_start();

// $_POSTが空ではない場合
// つまり、ログインボタンが押された場合のみ、下記の処理を実行する
if (!empty($_POST)) {
    // ログイン名が入力されていない場合の処理
    if (empty($_POST["name"])) {
        echo "名前が未入力です。";
    }
    // パスワードが入力されていない場合の処理
    if (empty($_POST["password"])) {
        echo "パスワードが未入力です。";
    }

    // 両方共入力されている場合
    if (!empty($_POST["name"]) && !empty($_POST["password"])) {
        //ログイン名とパスワードのエスケープ処理
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
        // ログイン処理開始
        $pdo = db_connect();
        try {
            //データベースアクセスの処理文章。ログイン名があるか判定//$namepostされたものと一致するレコード＊全て
            $sql = "SELECT * FROM users WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);    //メソッドの引数は初期値があるものは未記入でOKーーーーーbindParamは第一引数に第二引数を渡す
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // ハッシュ化されたパスワードを判定する定形関数のpasswordword_verify右boolean
            // 入力された値と引っ張ってきた値が同じか判定しています。
            if (password_verify($password, $row['password'])) {
                // セッションに値を保存（一定の長い期間！どこに？sessionという特別な保存場所、サーバー）
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_name"] = $row['name'];
                // main.phpにリダイレクト
                header("Location: main.php");
                exit;
            } else {
                // パスワードが違ってた時の処理
                echo "パスワードに誤りがあります。";
            }
        } else {
            //ログイン名がなかった時の処理
            echo "ユーザー名かパスワードに誤りがあります。";
        }
    }
}
?>
<!doctype html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="top-wrapper">
        <h1 class="top-items">ログイン画面</h1>
        <div class="top-items">
            <a class="green top button" href="signUp.php">新規ユーザー登録</a>
        </div>    
    </div>
    <form method="POST" action="">
        <input class="textbox" type="text" name="name" placeholder="ユーザー名"><br>
        <input class="textbox" type="password" name="password" placeholder="パスワード"><br>
        <input class="blue large button" type="submit" value="ログイン">
    </form>
</body>
</html>