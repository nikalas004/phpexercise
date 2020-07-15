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

    public function userAdd($params) {
        require 'templates/addUser.html';
    }

    public function user($params) {
        try {
            $user = User::getUser($params['urlId']);
        } catch(Exception $e) {
            http_response_code(404);
            return;
        }
        require 'templates/user.phtml';
    }

    public function userUpdate($params) {
        try {
            $user = User::getUser($params['urlId']);
        } catch(Exception $e) {
            http_response_code(404);
            return;
        }
        require 'templates/updateUser.phtml';
    }
}