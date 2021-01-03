<?php
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();
$pdo=db_connect();

try {
    // SQL文の準備
     $sql="SELECT * FROM posts ORDER BY id DESC";
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
</head>
<body>
    <h1>メインページ</h1>
    <p>ようこそ<?php echo $_SESSION["user_name"]; ?>さん</p>   <!--requireなどで定義してなくてOK-->
    <a href="logout.php">ログアウト</a><br />
    <a href="create_post.php">記事投稿！</a><br />
    <table>
        <tr>
            <td>記事ID</td>
            <td>タイトル</td>
            <td>本文</td>
            <td>投稿日</td>
            <td>詳細</td>
            <td>編集</td>
            <td>削除</td>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><a href="detail_post.php?id=<?php echo $row['id']; ?>">詳細</a></td>
                <td><a href="edit_post.php?id=<?php echo $row['id']; ?>">編集</a></td>
                <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>