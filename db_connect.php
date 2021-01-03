<?php
function db_connect(){
    $username = 'root';
    $password = 'root';
    $pdo = new PDO("mysql:dbname=YIGroupBlog;host=localhost", $username, $password);
    return $pdo;
}
?>