
<?php

session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != null){
    header('location:main.php');
}


require "config.php";
require "helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = post('username');
    $email = post('email');
    $password = post('password');
    $confirm_password = post('confirm_password'); 

    if ($password == $confirm_password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";


        try {
            $loginQuery = $connection->prepare($sql);
            $check = $loginQuery->execute([
                $username, 
                $email,
                $password
            ]);

            if ($check) {
                header("location: loogin.php");
              
            }
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                echo "Email already exists";
            } else {
                echo $e->getMessage();
            }
        }
    } else {
        echo 'Qeyd etdiyiniz şifrələr bir biri ilə uyğunlaşmır.';
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
  
<style>
    .reg_child{
        width: 400px;
        height: 100px;
        border: solid 1 px gray;
       display: flex;
       align-items: center;
       justify-content: center;
       flex-direction: column;
    }
    .reg_child input{
        width: 300px;
        height: 50px;
        background-color: #D3D3D3;
        border: none;
        outline: none;
        border-radius: 20px;
    }

    button{
        width: 150px;
        height: 40px;
        background-color: #00CED1;
        border-radius: 20px;
        border: none;
    }
    #ahref{
        margin-top: 10px;
        text-decoration: none;
    }
</style>


</head>
<body>
    <div class="register">
        <div class="register_row">
            <div class="register_col">
                <form action="" method="post" class="register_control">
                    <div class="reg_child">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="reg_child">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="reg_child">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="reg_child">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="reg_child">
                        <button  type="submit">Register</button>
                        <a id="ahref" href="loogin.php">if you have user, go login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>