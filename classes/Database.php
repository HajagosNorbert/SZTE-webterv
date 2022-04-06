<?php

class Database{
    protected $host;
    protected $username;
    protected $pass;
    protected $dbName;
    protected $conn;

    /**
     * @param $host
     * @param $username
     * @param $pass
     * @param $dbName
     * @param $conn
     */
    public function __construct($host, $username, $pass, $dbName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->pass = $pass;
        $this->dbName = $dbName;
    }

    public function db_connect(){
        try{
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            $pdo = new PDO($dsn,$this->username,$this->pass);
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            return $pdo;
        }catch (PDOException $e){
            echo "Hiba: ".$e->getMessage();
            die();
        }
    }
}

