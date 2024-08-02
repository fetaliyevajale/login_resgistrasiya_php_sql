<?php
session_start();
require "config.php";
require "helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = post("username");
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET username = ? WHERE id = ?";

    try {
        $query = $connection->prepare($sql);
        $query->execute([$username, $user_id]);
        header("Location: profile.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
