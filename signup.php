<?php
include_once("bootstrap.php");

function validateEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } 
    return true;
}

if(!empty($_POST)) {
    if(validateEmail($_POST["email"])) {
        $user = new Student();
        if(!$user->is_member($_POST["email"])) {
            try {
                $user->setUsername($_POST["name"]);
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
    
                $user->can_signup($_POST["name"], $_POST["email"], $_POST["password"]);
    
    
                session_start();
                $_SESSION['user'] = $_POST["email"];
                // TODO: Redirect to dashboard
                header('location:index.php');
                die();
            } catch (Throwable $e) {
    
                $error = $e->getMessage();
            }
        } else {
            $error = "Email already exists!";
        }  
    } else {
        $error = "Email is not valid";
    }
}

?>
<!DOCTYPE html>
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
    <label for="name">Full name</label>
    <input type="text" name="name" placeholder="Type your full name">
</div>
<div class="inputWrapper">
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="Email for future login">
</div>
<div class="inputWrapper">
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Password for your account">
</div>

<button type="submit">Register</button>
</form>
</div>
</body>
</html>