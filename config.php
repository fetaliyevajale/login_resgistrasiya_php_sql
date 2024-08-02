<?php

try {
    $server = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "medium"; 
    $connection = new PDO("mysql:host=$server;dbname=$databaseName;charset=utf8", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
