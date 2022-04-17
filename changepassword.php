<?php
session_start();
require_once 'classes/User.php';
if(empty($_SESSION["user_id"]) && empty($_COOKIE["login"])){
    header("location: login.php");
}
$user = new User();

if(isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST["changePw"])){
    $response = json_decode($user->changePassword(array($_POST["old_pw"], $_POST["new_pw"],$_SESSION["user_id"])));
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="mediafiles/debugging.png" type="image/icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/genericStyle.css" />
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/profile.css" />
    <title>Suli hibabejelentő</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <main>
            <div class="changePw">
                <form action="changepassword.php" method="post">
                    <label>Jelszó</label>
                    <div>
                        <input type="password" name="old_pw" id="">
                    </div>
                    <label>Új jelszó</label>
                    <div>
                        <input type="password" name="new_pw" id="" placeholder="Legalább 6 karakter">
                    </div>
                    <div>
                        <input type="submit" id="button" value="Módosítás" name="changePw">
                    </div>
                    <p><?php echo (isset($response->msg)) ? $response->msg : ""; ?></p>
                </form>
            </div>
    </main>
    <?php include 'footer.html'; ?>
</body>

</html>