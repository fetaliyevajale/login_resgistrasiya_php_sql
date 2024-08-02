<?php
session_start();
require "config.php";
require "helper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $sql = "DELETE FROM blogs WHERE id = ?";

    try {
        $query = $connection->prepare($sql);
        $query->execute([$id]);
        header("Location: view.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
