<?php
function db_connect(){
    $username = 'username';
    $password = 'password';
    $db_name = 'db_name';
    $pdo = new PDO("mysql:dbname=".$db_name.";host=localhost", $username, $password);
    return $pdo;
}
?>