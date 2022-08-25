<?php 
include_once("bootstrap.php");

if(!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
        $user = new Student();
        if($user->can_login($email, $password)) {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["userID"] = $user->getUserID();
            // TODO: Redirect to dashboard
            header("location:dashboard.php");
        } else {
           $error = "Invalid email or password!";
        }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
 
    <div id="app">
        <form action="" method="post">
        <?php if (isset($error)) : ?>
                <div>
                    <p>
                        <?php echo $error ?>
                    </p>
                </div>
            <?php endif; ?>
        <div class="inputWrapper">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Use your email to login">
        </div>
        <div class="inputWrapper">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Use your password to login">
        </div>

        <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>