<?php
// db_connect.phpの読み込み
require_once('db_connect.php');

// function.phpの読み込み
require_once('function.php');

// ログインしていなければ、login.phpにリダイレクト
check_user_logged_in();

// URLの?以降で渡されるIDをキャッチ
$id = $_GET['id'];
// もし、$idが空であったらindex.phpにリダイレクト
// 不正なアクセス対策
redirect_main_unless_parameter($id);

// PDOのインスタンスを取得
$pdo = db_connect();

try {
    // SQL文の準備
    $sql = "SELECT * FROM posts WHERE id = :id";
    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);
    // idのバインド
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch (PDOException $e) {
    // エラーメッセージの出力
    echo 'Error: ' . $e->getMessage();
    // 終了
    die();
}

// 結果が1行取得できたら
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
} else {
    // 対象のidでレコードがない => 不正な画面遷移
    echo "対象のデータがありません。";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>記事編集</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>記事編集</h1>
        <form method="POST" action="edit_done_post.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            title:<br>
            <input type="text" name="title" id="title" style="width:200px;height:50px;" value=<?php echo $title; ?>>
            <br>
            content:<br>
            <input type="text" name="content" id="content" style="width:200px;height:100px;" value=<?php echo $content; ?>><br>
            <input type="submit" value="submit" id="edit" name="edit">
        </form>
    </body>
</html>