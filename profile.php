<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: loogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM users WHERE id = ?";
$query = $connection->prepare($sql);
$query->execute([$user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM blogs WHERE user_id = ?";
$query = $connection->prepare($sql);
$query->execute([$user_id]);
$blogs = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        form{
           width: 100%;
        }
        form input{
            width: 300px;
            height: 30px;
            margin-bottom: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
            background-color: gainsboro;
        }
        button{
            width: 200px;
            height: 30px;
            border: none;
            outline: none;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
            background-color: lightblue;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Profile</h1>
    <form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <button type="submit">Update Profile</button>
    </form>

    <h2>Your Blogs</h2>
    <?php foreach ($blogs as $blog): ?>
        <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
        <p><em>Created at: <?php echo $blog['created_at']; ?></em></p>
        <a href="edit.php?id=<?php echo $blog['id']; ?>">Edit</a>
        <a href="Delete.php?id=<?php echo $blog['id']; ?>">Delete</a>
    <?php endforeach; ?>
</body>
</html>
