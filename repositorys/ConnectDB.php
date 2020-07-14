<?php

class ConnectDB
{
    private static $instance = null;
    private $con;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'phpexercise';
    public function __construct()
    {
        $this->con = new PDO("mysql:host={$this->host};
        dbname={$this->name}", $this->user, $this->pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new ConnectDB();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->con;
    }
}
