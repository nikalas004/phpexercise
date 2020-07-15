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

    public function addUser($user) {
        $sth = 'INSERT INTO users(name, email, number, city, address) VALUES(:name, :email, :number, :city, :address);';

        $params = ['name' => $user->getName(), 'email' => $user->getEmail(), 'number' => $user->getNumber(),
            'city' => $user->getCity(), 'address' => $user->getAddress()];
        $pdoSth = $this->con->prepare($sth);
        $pdoSth->execute($params);
    }

    public function getUserById($id) {
        $sth = 'SELECT * FROM users WHERE id=:id;';

        $pdoSth = $this->con->prepare($sth);
        $pdoSth->execute(['id' => $id]);
        return $pdoSth->fetch();
    }

    public function updateUser($user) {
        $sth = 'UPDATE users SET name = :name, email = :email, number = :number, city = :city, address = :address WHERE id = :id;';

        $params = ['name' => $user->getName(), 'email' => $user->getEmail(), 'number' => $user->getNumber(),
            'city' => $user->getCity(), 'address' => $user->getAddress(), 'id' => $user->getId()];
        $pdoSth = $this->con->prepare($sth);
        $pdoSth->execute($params);
    }
}