<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        button {
            width: 150px;
            height: 40px;
            border: none;
            background-color: burlywood;
            border-radius: 20px;
        }
        button a {
            text-decoration: none;
            color: black;
            display: inline-block;
            width: 100%;
            height: 100%;
            line-height: 40px; 
            text-align: center;
        }
    </style>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['user_id'])) { ?>

    <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <button>
        <a href="logout.php">Log out</a>
    </button>

    <?php
} else {
    ?>
    <button>
        <a href="register.php">Register</a>
    </button>
    <button>
        <a href="loogin.php">Loogin</a>
    </button>

    <?php
}
?>
</body>
</html>
