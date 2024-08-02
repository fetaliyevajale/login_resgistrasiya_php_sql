<?php
require "config.php";

$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$query = $connection->prepare($sql);
$query->execute();
$blogs = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blogs</title>
</head>
<body>
    <h1>Blogs</h1>
    <?php foreach ($blogs as $blog): ?>
        <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($blog['content'])); ?></p>
        <p><em>Created at: <?php echo $blog['created_at']; ?></em></p>
        <a href="edit.php?id=<?php echo $blog['id']; ?>">Edit</a>
        <a href="Delete.php?id=<?php echo $blog['id']; ?>">Delete</a>
    <?php endforeach; ?>
</body>
</html>
