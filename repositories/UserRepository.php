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
        $sql = 'SELECT * FROM users;';

        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute();
        return $pdoSth->fetchAll();
    }

    public function getUsersOrdered($col, $way) {
        $sql = 'SELECT * FROM users ORDER BY ' . $col . ' ' . $way . ';';
        //echo $sql;
        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute(['col' => $col]);
        return $pdoSth->fetchAll();
    }

    public function addUser($user) {
        $sql = 'INSERT INTO users(name, email, number, city, address) VALUES(:name, :email, :number, :city, :address);';

        $params = ['name' => $user->getName(), 'email' => $user->getEmail(), 'number' => $user->getNumber(),
            'city' => $user->getCity(), 'address' => $user->getAddress()];
        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute($params);
    }

    public function getUserById($id) {
        $sql = 'SELECT * FROM users WHERE id=:id;';

        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute(['id' => $id]);
        return $pdoSth->fetch();
    }

    public function updateUser($user) {
        $sql = 'UPDATE users SET name = :name, email = :email, number = :number, city = :city, address = :address WHERE id = :id;';

        $params = ['name' => $user->getName(), 'email' => $user->getEmail(), 'number' => $user->getNumber(),
            'city' => $user->getCity(), 'address' => $user->getAddress(), 'id' => $user->getId()];
        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute($params);
    }

    public function deleteUser($id) {
        $sql = 'DELETE FROM users WHERE id = :id;';

        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute(['id' => $id]);
    }
    
    public function uniqueEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email;";
        
        $pdoSth = $this->con->prepare($sql);
        $pdoSth->execute(['email' => $email]);

        return $pdoSth->fetch();
    }
}