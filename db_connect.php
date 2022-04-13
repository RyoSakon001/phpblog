<?php
function db_connect(){
    $username = 'ryo';
    $password = 'y5ad8mjN';
    $pdo = new PDO("mysql:dbname=phpblog;host=localhost", $username, $password);
    return $pdo;
}
?>