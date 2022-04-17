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
            $stmt->execute(array($username));
            $user = $stmt->fetchObject();
            if($user){
                if($password == $user->password){
                    $uid = $user->id;
                    $_SESSION["user_id"] = $uid;
                    $_SESSION["user"] = $user;
                    $cookie_name = "login";
                    $cookie_value = $user->username;
                    setcookie($cookie_name,$cookie_value,time() + (86400 * 30), "/");
                    header("location: index.php");
                }else{
                    $message .= "Hibás jelszó!";
                }
            }else{
                $message .= "Nem létezik ilyen felhasználónév!";
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
    public function registration($name, $username, $password, $password_again){
        $nameErr = "";
        $usernameErr = "";
        $passwordErr = "";
        $password_againErr = "";
        $siker= "";


        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
        $stmt->execute(array($username));
        $data = $stmt->fetchObject();

        if(!empty($data)){
            $usernameErr .= "Ezzel a felhasználóval már van fiók regisztrálva!";
        }
        if(strlen($name) < 7){
            $nameErr .= "7 karakter hosszúnak kell lennie!";
        }
        if(strlen($password) < 6) {
            $passwordErr .= "A jelszó minimum 6 karakter kell legyen!";
        }
        if($password != $password_again) {
            $password_againErr .= "A két jelszó nem egyezik!";
            $passwordErr .= "A két jelszó nem egyezik!";
        }

        if($usernameErr == "" && $passwordErr == "" && $password_againErr == "" && $nameErr == ""){
            //$hashedPw = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('INSERT INTO users (`name`, `username`, `password`, `group`) VALUES (?, ?, ?, ?)');
            if($stmt->execute(array($name,$username,$password,1))){
                $siker .= "Sikeres regisztráció!";
            }
        }
        $response = [
            "nameError" => $nameErr,
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

    public function modifyUserData(array $data){
        $d = [
            'name' => $data[0],
            'username' => $data[1],
            'group' => $data[3],
            'id' => $data[4]
        ];
        $sql = "UPDATE `users` SET `name`= ?, `username`= ?, `group`= ? WHERE id = ?";
        $stmt= $this->db->prepare($sql);
        $stmt->execute(array($d["name"],$d["username"],$d["group"],$d["id"]));
    }

    public function changePassword(array $data){
        $s = $this->db->prepare("SELECT password FROM users WHERE id = ?;");
        $s->execute(array($data[2]));
        $dataa = $s->fetchObject();

        $msg = "";

        if($data[0] == $dataa->password){
            $sql = "UPDATE `users` SET `password`= ? WHERE id = ?";
            $stmt= $this->db->prepare($sql);
            $stmt->execute(array($data[1],$data[2]));
        }else{
            $msg .= "Hibás régi jelszó!";
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
            $msg .= "Sikeres képfeltöltés!";
            $sql = "UPDATE `users` SET `profile_img`= ? WHERE id = ?";
            $stmt= $this->db->prepare($sql);
            $stmt->execute(array($profileImageName, $id));
        }else{
            $msg .= "Nem sikerült a képfeltöltés próbáld újra!";
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