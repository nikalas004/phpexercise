<?php

class UserController
{
    public function addUser($params) {
        $user = new User($params['name'], $params['email'], $params['number'], $params['city'], $params['address']);
        try {
            $user->validateData();
        } catch(Exception $e) {
            return;
        }
        $user->insert();

        echo json_encode([
            'code' => 200
        ]);
    }

    public function updateUser($params) {
        $user = User::getUser($params['id']);
        $user->setNewData($params);
        try {
            $user->validateData();
        } catch(Exception $e) {
            return;
        }
        $user->update();

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