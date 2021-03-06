<?php
include 'Database.php';

class User{
    private $id;
    private $nev;
    private $username;
    private $password;
    private $group;
    private $db;

    /**
     * @return PDO|void
     */
    public function getDb()
    {
        return $this->db;
    }

    public function __construct()
    {
        $db = new Database('localhost','root','','hibabejelento');
        $this->db = $db->db_connect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNev()
    {
        return $this->nev;
    }

    /**
     * @param mixed $nev
     */
    public function setNev($nev)
    {
        $this->nev = $nev;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function login($username, $password){
            $message = "";
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
            $stmt->execute(array(trim($username)));
            $user = $stmt->fetchObject();
            if($user){
                if(password_verify($password, $user->password)){
                    $uid = $user->id;
                    $_SESSION["user_id"] = $uid;
                    $_SESSION["user"] = $user;
                    $cookie_name = "login";
                    $cookie_value = $user->username;
                    setcookie($cookie_name,$cookie_value,time() + (86400 * 30), "/");
                    header("location: index.php");
                }else{
                    $message .= "Hib??s jelsz??!";
                }
            }else{
                $message .= "Nem l??tezik ilyen felhaszn??l??n??v!";
            }
        $response = [
            "message" => $message,
        ];
        return json_encode($response);
    }

    public function logout(){
        if(isset($_SESSION["user_id"])){
            unset($_SESSION["user_id"]);
        }
        if(isset($_COOKIE["login"])){
            unset($_COOKIE["login"]);
            setcookie("login",'',time() - 3600, "/");
        }
        session_destroy();
        header("location: index.php");
    }
    public function registration($fullname, $username, $password, $password_again){

        $username = trim($username);
        $fullname = trim($fullname);
        $fullnameErr = "";
        $usernameErr = "";
        $passwordErr = "";
        $password_againErr = "";
        $siker= "";

        //felhaszn??l??n??v tartalmaznia kell kis ??s nagy bet??t is.
        /*if(!preg_match("/^([A-Z][a-z]+)+$/",$username)){
            $usernameErr .= "A felhaszn??l??n??vnek tartalmaznia kell kis ??s nagy bet??t is!";
        }*/

        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
        $stmt->execute(array($username));
        $data = $stmt->fetchObject();

        if(empty($fullname)){
            $fullnameErr .="Teljes n??v ne legyen ??res";
        }
        if(empty($username)){
            $usernameErr .="Felhaszn??l?? n??v ne legyen ??res";
        }
        if(!empty($data)){
            $usernameErr .= "Ezzel a felhaszn??l??val m??r van fi??k regisztr??lva!";
        }
        if(strlen($password) < 6) {
            $passwordErr .= "A jelsz?? minimum 6 karakter kell legyen!";
        }
        if($password != $password_again) {
            $password_againErr .= "A k??t jelsz?? nem egyezik!";
            $passwordErr .= "A k??t jelsz?? nem egyezik!";
        }

        if($usernameErr == "" && $passwordErr == "" && $password_againErr == "" && $fullnameErr == ""){
            $hashedPw = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('INSERT INTO users (`name`, `username`, `password`, `group`) VALUES (?, ?, ?, ?)');
            if($stmt->execute(array($fullname,$username,$hashedPw, 0))){
                $siker .= "Sikeres regisztr??ci??!";
            }
        }
        $response = [
            "fullnameError" => $fullnameErr,
            "usernameError" => $usernameErr,
            "passwordError" => $passwordErr,
            "passwordAgainError" => $password_againErr,
            "siker" => $siker
        ];
        return json_encode($response);
    }

    public function getLoggedUserFromDb($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?;");
        $stmt->execute(array($id));
        $data = $stmt->fetchObject();
        return $data;
    }

    public function modifyUserData($fullname, $username){
        // $d = [
        //     'name' => $data[0],
        //     'username' => $data[1],
        // ];
        // $sql = "UPDATE `users` SET `name`= ?, `username`= ? WHERE id = ?";
        // $stmt= $this->db->prepare($sql);
        // $stmt->execute(array($d["name"],$d["username"],$d["group"],$d["id"]));

        $fullnameErr = "";
        $usernameErr = "";
        $siker = "";
        $password_againErr = "";
        $passwordErr = "";


        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
        $stmt->execute(array($username));
        $data = $stmt->fetchObject();

        if(empty($fullname)){
            $fullnameErr .="Teljes n??v ne legyen ??res";
        }
        if(empty($username)){
            $usernameErr .="Felhaszn??l?? n??v ne legyen ??res";
        }
        if(!empty($data) && $data->id != $_SESSION["user_id"]){
            $usernameErr .= "Ezzel a felhaszn??l??val m??r van fi??k regisztr??lva!";
        }

        if($usernameErr == "" && $fullnameErr == ""){
            $stmt = $this->db->prepare("UPDATE `users` SET `name`= ?, `username`= ? WHERE id = ?");
            if($stmt->execute(array($fullname, $username,$_SESSION["user_id"]))){
                $siker .= "Sikeres regisztr??ci??!";
                header("location: profile.php");
            }
        }
        $response = [
            "fullnameError" => $fullnameErr,
            "usernameError" => $usernameErr,
            "passwordError" => $passwordErr,
            "passwordAgainError" => $password_againErr,
            "siker" => $siker
        ];
        return json_encode($response);
    }

    public function changePassword(array $data){
        $s = $this->db->prepare("SELECT password FROM users WHERE id = ?;");
        $s->execute(array($data[2]));
        $dataa = $s->fetchObject();
        $msg = "";

        if(!strlen(trim($data[0])) < 6) {
            if(password_verify($data[0], $dataa->password)){
                $hashedPw = password_hash($data[1], PASSWORD_DEFAULT);
                $sql = "UPDATE `users` SET `password`= ? WHERE id = ?";
                $stmt= $this->db->prepare($sql);
                $stmt->execute(array($hashedPw,$data[2]));

                $err = $stmt->errorInfo();
                $msg .= "Sikeres jelsz??m??dos??t??s!";
            }else{
                $msg .= "Hib??s r??gi jelsz??!";
            }
        } else {    
            $msg .= "A jelsz?? minimum 6 karakter kell legyen! ";
        }

        $response = [
            "msg" => $msg
        ];
        return json_encode($response);
    }

    public function uploadImage($files, $id){
        $msg = "";
        $profileImageName = time() . '_' . $files["file"]["name"];
        $target = 'profileimg/' . $profileImageName;
        if(move_uploaded_file($files["file"]["tmp_name"],$target)){
            $msg .= "Sikeres k??pfelt??lt??s!";
            $sql = "UPDATE `users` SET `profile_img`= ? WHERE id = ?";
            $stmt= $this->db->prepare($sql);
            $stmt->execute(array($profileImageName, $id));
            header("location: profile.php");
        }else{
            $msg .= "Nem siker??lt a k??pfelt??lt??s pr??b??ld ??jra!";
        }
        $response = [
            "msg" => $msg
        ];
        return json_encode($response);
    }

    public function deleteAccount($id){
        $sql = 'DELETE FROM `users` WHERE `users`.`id` = ?';
        $stmt= $this->db->prepare($sql);
        if($stmt->execute(array($id))){
            $this->logout();
        }
    }

}
