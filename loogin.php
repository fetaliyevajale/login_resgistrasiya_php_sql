<?php

require "config.php";
require "helper.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = post("email");
    $password = post("password");

    $sql = "SELECT * FROM users WHERE email = ?";

    $loginQuery = $connection->prepare($sql);
    $loginQuery->execute([$email]);
    $user = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: main.php');
        exit();
    } else {
        $error = "Yanlış email və ya şifrə.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        .reg_child {
            width: 400px;
            height: 100px;
            border: solid 1px gray;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .reg_child input {
            width: 300px;
            height: 50px;
            background-color: #D3D3D3;
            border: none;
            outline: none;
            border-radius: 20px;
        }
        button {
            width: 150px;
            height: 40px;
            background-color: #00CED1;
            border-radius: 20px;
            border: none;
        }
        #ahref {
            margin-top: 10px;
            text-decoration: none;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register">
        <div class="register_row">
            <div class="register_col">
                <form action="" method="post" class="register_control">
                    <?php if ($error): ?>
                        <div class="error"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <div class="reg_child">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="reg_child">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="reg_child">
                        <button type="submit">Login</button>
                        <a id="ahref" href="register.php">If you don't have an account, go register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

</html>