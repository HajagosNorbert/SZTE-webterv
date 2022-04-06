<?php
include 'Database.php';
class Report{
    private $db;
    private $megnevezes;
    private $jellege;
    private $akadalyoz;
    private $datum;
    private $teremSzam;
    private $leiras;

    /**
     * @return PDO|void
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param PDO|void $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getMegnevezes()
    {
        return $this->megnevezes;
    }

    /**
     * @param mixed $megnevezes
     */
    public function setMegnevezes($megnevezes)
    {
        $this->megnevezes = $megnevezes;
    }

    /**
     * @return mixed
     */
    public function getJellege()
    {
        return $this->jellege;
    }

    /**
     * @param mixed $jellege
     */
    public function setJellege($jellege)
    {
        $this->jellege = $jellege;
    }

    /**
     * @return mixed
     */
    public function getAkadalyoz()
    {
        return $this->akadalyoz;
    }

    /**
     * @param mixed $akadalyoz
     */
    public function setAkadalyoz($akadalyoz)
    {
        $this->akadalyoz = $akadalyoz;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getTeremSzam()
    {
        return $this->teremSzam;
    }

    /**
     * @param mixed $teremSzam
     */
    public function setTeremSzam($teremSzam)
    {
        $this->teremSzam = $teremSzam;
    }

    /**
     * @return mixed
     */
    public function getLeiras()
    {
        return $this->leiras;
    }

    /**
     * @param mixed $leiras
     */
    public function setLeiras($leiras)
    {
        $this->leiras = $leiras;
    }


    public function __construct()
    {
        $db = new Database('localhost','root','','hibabejelento');
        $this->db = $db->db_connect();
    }

    public function saveNewReport(){

    }

    public function fetchAllReport(){

    }
}