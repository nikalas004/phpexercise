<?php

class RouteController
{

    public function home($params) {
        require 'templates/home.html';
    }

    public function users($params) {
        $users = User::getAllUsers();
        require 'templates/users.phtml';
    }
}