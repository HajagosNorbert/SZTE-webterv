<?php
session_start();
require_once 'classes/User.php';
$user = new User();

if(isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $login = json_decode($user->login($username,$password));
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
    <title>Hibabejelentő - bejelentkezés</title>
</head>
<body>
<?php include 'navbar.php';?>
<main>
    <div class="login">
        <img src="mediafiles/login.png" alt="login ábra" />
        <form action="login.php" method="post">
            <div class="row">
                <input
                        type="text"
                        name="username"
                        placeholder="Felhasználónév"
                        required
                />
            </div>
            <div class="row">
                <input
                        type="password"
                        name="password"
                        placeholder="Jelszó"
                        required
                />
            </div>
            <div id="message">
                <p><strong><?php echo (isset($login->message)) ? $login->message : ""; ?></strong></p>
            </div>
            <div class="row button">
                <input type="submit" name="login" value="Belépés" />
            </div>
        </form>
    </div>
</main>
<?php include 'footer.html' ?>
</body>
</html>
