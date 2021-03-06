<?php

class User
{
    private $id;
    private $name;
    private $email;
    private $number;
    private $city;
    private $address;

    public function __construct($name, $email, $number, $city, $address, $id = -1)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->number = $number;
        $this->city = $city;
        $this->address = $address;
    }

    public static function getAllUsers($col, $way) {
        if(is_null($col)) {
            $userDataArray = UserRepository::getInstance()->getUsers();
        } else {
            $userDataArray = UserRepository::getInstance()->getUsersOrdered($col, $way);
        }
        $users = [];
        foreach($userDataArray as $userData) {
            array_push($users, new User($userData['name'], $userData['email'], $userData['number'], $userData['city'], $userData['address'], $userData['id']));
        }

        return $users;
    }

    public static function getUser($id) {
        $userData = UserRepository::getInstance()->getUserById($id);

        if(!$userData) {
            throw new Exception();
        }

        return new User($userData['name'], $userData['email'], $userData['number'], $userData['city'], $userData['address'], $userData['id']);
    }

    public static function deleteUser($id) {
        UserRepository::getInstance()->deleteUser($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function insert() {
        UserRepository::getInstance()->addUser($this);
    }

    public function setNewData($newData) {
        $this->setName($newData['name']);
        $this->setEmail($newData['email']);
        $this->setNumber($newData['number']);
        $this->setCity($newData['city']);
        $this->setAddress($newData['address']);
    }

    public function update() {
        UserRepository::getInstance()->updateUser($this);
    }

    public function validateData() {
        $user = UserRepository::getInstance()->uniqueEmail($this->getEmail());
        if(empty($this->getName())) {
            echo json_encode([
                'code' => 400,
                'field' => 'name',
                'msg' => 'Name must not be empty!'
            ]);
            throw new Exception;
        } else if(empty($this->getEmail())) {
            echo json_encode([
                'code' => 400,
                'field' => 'email',
                'msg' => 'Email must not be empty!'
            ]);
            throw new Exception;
        } else if($user) {
            if($user['id'] != $this->getId()) {
                echo json_encode([
                    'code' => 400,
                    'field' => 'email',
                    'msg' => 'Email is taken!'
                ]);
                throw new Exception;
            }
        }
    }
}