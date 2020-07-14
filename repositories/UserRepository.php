<?php

class UserRepository
{
    private static $instance = null;
    private $con;

    public function __construct()
    {
        $this->con = ConnectDB::getInstance()->getConnection();
    }


    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new UserRepository();
        }

        return self::$instance;
    }

    public function getUsers() {
        $sth = 'SELECT * FROM users;';

        $pdoSth = $this->con->prepare($sth);
        $pdoSth->execute();
        return $pdoSth->fetchAll();
    }

}