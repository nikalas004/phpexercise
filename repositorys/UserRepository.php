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

}