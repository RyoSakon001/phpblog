<?php
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();
$pdo=db_connect();

try {
    // SQL文の準備
     $sql="SELECT * FROM books ORDER BY id DESC";
    // プリペアドステートメントの作成
    $stmt=$pdo->prepare($sql);
    // 実行
    $stmt->execute();
} catch (PDOException $e) {
    echo $e;
    die();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>在庫一覧画面</h1>
    <a class="blue button" href="bookSignUp.php">新規登録</a>
    <a class="gray button" href="logout.php">ログアウト</a>
    <table border="1">
        <tr>
            <th>タイトル</th>
            <th>発売日</th>
            <th>在庫数</th>
            <th></th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><a class="red button" href="delete_book.php?id=<?php echo $row['id']; ?>">削除</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>