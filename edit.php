<?php
session_start();
require "config.php";
require "helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = post("id");
    $title = post("title");
    $content = post("content");

    $sql = "UPDATE blogs SET title = ?, content = ? WHERE id = ?";

    try {
        $query = $connection->prepare($sql);
        $query->execute([$title, $content, $id]);
        echo "Blog updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
</head>
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
        margin-left: 20px;
        }
    </style>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
        <button type="submit">Update Blog</button>
    </form>
</body>
</html>
