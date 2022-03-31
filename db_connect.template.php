<?php
function db_connect(){
    $username = 'username';
    $password = 'password';
    $pdo = new PDO("mysql:dbname=DBNAME;host=localhost", $username, $password);
    return $pdo;
}
?>