<?php
session_start();
require "config.php";
require "helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = post("title");
    $content = post("content");

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO blogs (user_id, title, content) VALUES (?, ?, ?)";

        try {
            $query = $connection->prepare($sql);
            $query->execute([$user_id, $title, $content]);
            echo "Blog added successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "You must be logged in to create a blog.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>

    <style>
        form {
            width: 400px;
            margin: 0 auto;
        }
        form input{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }
        form textarea{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
            resize: vertical;
        }
       form button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: none;
        background-color: #00ced1;
        border-radius: 20px;
        color: white;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <button type="submit">Create Blog</button>
    </form>
</body>
</html>
