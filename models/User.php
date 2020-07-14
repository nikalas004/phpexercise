<?php

class User
{
    private $id;
    private $name;
    private $email;
    private $number;
    private $city;
    private $address;

    public function __construct($name, $email, $number, $city, $address, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->number = $number;
        $this->city = $city;
        $this->address = $address;
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


}