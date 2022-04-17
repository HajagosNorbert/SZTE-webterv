<?php
session_start();
require_once 'classes/User.php';
$user = new User();

if(isset($_POST["registration"]) && isset($_POST["fullname"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_again"])){
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $pw_again = $_POST["password_again"];
    $reg = json_decode($user->registration($fullname, $username, $password, $pw_again));
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="mediafiles/debugging.png" type="image/icon" />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./css/genericStyle.css" />
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/login.css" />
    <title>Hibabejelentő - regisztráció</title>
</head>
<body>
<?php include 'navbar.php' ?>
<main>
    <div class="login">
        <img src="mediafiles/login.png" alt="login ábra" />
        <form action="registration.php" method="post">
        <p><strong><?php echo (isset($reg->fullnameError)) ? $reg->fullnameError : ""; ?></strong></p>
            <div class="row">
                <input
                        type="text"
                        name="fullname"
                        placeholder="Teljes név"
                        required
                />
            </div>
            <p><strong><?php echo (isset($reg->usernameError)) ? $reg->usernameError : ""; ?></strong></p>
            <div class="row">
                <input
                        type="text"
                        name="username"
                        placeholder="Felhasználónév"
                        required
                />
            </div>
            <p><strong><?php echo (isset($reg->passwordError)) ? $reg->passwordError : ""; ?></strong></p>
            <div class="row">
                <input
                        type="password"
                        name="password"
                        placeholder="Jelszó"
                        required
                />
            </div>
            <p><strong><?php echo (isset($reg->passwordAgainError)) ? $reg->passwordAgainError : ""; ?></strong></p>
            <div class="row">
                <input
                        type="password"
                        name="password_again"
                        placeholder="Jelszó újra"
                        required
                />
            </div>
            <p><strong><?php echo (isset($reg->siker)) ? $reg->siker : ""; ?></strong></p>
            <div class="row button">
                <input type="submit" name="registration" value="Regisztráció" />
            </div>
        </form>
    </div>
</main>
<?php include 'footer.html';?>
</body>
</html>
