<?php
session_start();
require_once 'classes/User.php';
if(empty($_SESSION["user_id"]) && empty($_COOKIE["login"])){
    header("location: login.php");
}
$user = new User();
$data = $user->getLoggedUserFromDb($_SESSION["user_id"]);

if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST["change_data"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $group = $_POST["group"];
    $user->modifyUserData($name, $username);
    header("location: profile.php");
}

if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST["changePw"])) {
    $response = json_decode($user->changePassword(array($_POST["old_pw"], $_POST["new_pw"], $data->id)));
}
if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST["upload_img"])) {
    $msg =  json_decode($user->uploadImage($_FILES, $data->id));
}
if(isset($_GET["deleteAccount"])){
   $user->deleteAccount($data->id);
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
    <?php  $activePage = "profile"; include 'navbar.php' ?>
    <main>
        <div class="profile">
        <img alt="profile" src="<?php echo (empty($data->profile_img)) ? "./img/profileavatar.webp" : "./profileimg/".$data->profile_img; ?>" width="150" >
            <form action="./profile.php" method="post">
                <label>Név</label>
                <div>
                    <input type="text" name="name" value="<?php echo $data->name; ?>">
                </div>
                <label>Felhasználónév</label>
                <div>
                    <input type="text" name="username" value="<?php echo $data->username; ?>">
                </div>
                <input type="submit" class="button" value="Módosítás" name="change_data">
            </form>
            <div style="margin-top: 25px">
                <a class="button" href="./changepassword.php">Jelszó módosítás</a>
            </div>
            <form action="profile.php" method="POST" enctype="multipart/form-data">

                <div style="margin: 20px 0 20px 0">
                <h3 style="margin: 20px 0">Kép feltöltése</h3>
                <input type="file" name="file">
                </div>
                <input type="submit" value="Feltöltés" class="button" name="upload_img">
                <a class="button" href="profile.php?deleteAccount">Fiók törlése</a>
            </form>
            <div><?php echo (isset($msg->msg)) ? $msg->msg : "" ?></div>
        </div>
    </main>
    <?php include 'footer.html'; ?>
</body>
</html>