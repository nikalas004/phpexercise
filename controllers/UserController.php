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

    public function updateUser($params) {
        $user = User::getUser($params['id']);
        $user->update($params);

        echo json_encode([
            'code' => 200
        ]);
    }

    public function deleteUser($params) {
        User::deleteUser($params['id']);

        echo json_encode([
            'code' => 200
        ]);
    }
}