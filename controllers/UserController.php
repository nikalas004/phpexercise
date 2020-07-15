<?php

class UserController
{
    public function addUser($params) {
        $user = new User($params['name'], $params['email'], $params['number'], $params['city'], $params['address']);
        $user->insert();

        echo json_encode([
            'code' => 200
        ]);
    }

}