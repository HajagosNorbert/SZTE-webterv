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
    public function registration($fullname, $username, $password, $password_again){

        $username = trim($username);
        $fullname = trim($fullname);
        $fullnameErr = "";
        $usernameErr = "";
        $passwordErr = "";
        $password_againErr = "";
        $siker= "";
        //felhasználónév tartalmaznia kell kis és nagy betűt is.
        /*if(!preg_match("/^([A-Z][a-z]+)+$/",$username)){
            $usernameErr .= "A felhasználónévnek tartalmaznia kell kis és nagy betűt is!";
        }*/

        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
        $stmt->execute(array($username));
        $data = $stmt->fetchObject();

        if(empty($fullname)){
            $fullnameErr .="Teljes név ne legyen üres";
        }
        if(empty($username)){
            $usernameErr .="Felhasználó név ne legyen üres";
        }
        if(!empty($data)){
            $usernameErr .= "Ezzel a felhasználóval már van fiók regisztrálva!";
        }
        if(strlen($password) < 6) {
            $passwordErr .= "A jelszó minimum 6 karakter kell legyen!";
        }
        if($password != $password_again) {
            $password_againErr .= "A két jelszó nem egyezik!";
            $passwordErr .= "A két jelszó nem egyezik!";
        }

        if($usernameErr == "" && $passwordErr == "" && $password_againErr == "" && $fullnameErr == ""){
            $hashedPw = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('INSERT INTO users (`name`, `username`, `password`, `group`) VALUES (?, ?, ?, ?)');
            if($stmt->execute(array($fullname,$username,$hashedPw, 0))){
                $siker .= "Sikeres regisztráció!";
                echo "<script>console.log('siker');</script>";
            } else {
                $err = $stmt->errorInfo();
                print_r($err);
                print($hashedPw);
                echo "<script>console.log(".$err.");</script>";
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

}
