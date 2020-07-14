<?php

class RouteController
{

    public function home($params) {
        require 'templates/home.html';
    }

    public function users($params) {
        require 'templates/users.phtml';
    }
}