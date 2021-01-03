<?php
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();

// URLの?以降で渡されるIDをキャッチ
$id = $_GET['id'];
// もし、$idが空であったらmain.phpにリダイレクト
// 不正なアクセス対策
if (empty($id)) {
    header("Location: main.php");
    exit;
}

// PDOのインスタンスを取得
$pdo=db_connect();

try {
    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);    //メソッドの引数は初期値があるものは未記入でOKーーーーーbindParamは第一引数に第二引数を渡す
    $stmt->execute();    
    header("Location: main.php");
    exit;
} catch (PDOException $e) {
    echo $e;
    die();
}