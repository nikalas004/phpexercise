<?php

class RouteController
{

    public function users($params) {
        $colOpportunities = ['name', 'email', 'number', 'city', 'address'];
        $wayOpportunities = ['ASC', 'DESC', ''];

        if(!isset($params['col'])) {
            $params['col'] = null;
        } else {
            $params['col'] = strtolower($params['col']);
            if(!in_array($params['col'], $colOpportunities)) {
                http_response_code(422);
                return;
            }
        }
        if(!isset($params['way'])) {
            $params['way'] = '';
        } else {
            $params['way'] = strtoupper($params['way']);
            if(!in_array($params['way'], $wayOpportunities)) {
                http_response_code(422);
                return;
            }
        }

        $allUsers = User::getAllUsers($params['col'], $params['way']);

        $pageCount = count($allUsers)==0? 1 : ceil(count($allUsers)/5);
        if(!isset($params['page'])) {
            $page = 1;
        } elseif($params['page'] > $pageCount) {
            http_response_code(422);
            return;
        } else {
            $page = $params['page'];
        }

        $offset = ($page-1)*5;
        $users = array_slice($allUsers, $offset, 5);

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