<?php

    spl_autoload_register(function($className) {
        $directories = ['controllers', 'repositories', 'models'];

        foreach($directories as $directory) {
            $fileName = './' . $directory . '/' . $className . '.php';
            if(file_exists($fileName)) {
                include_once $fileName;
                break;
            }
        }
    });

    error_reporting(E_ALL & ~E_WARNING);

    $uri = $_SERVER['REQUEST_URI'];
    $link = explode('?', $uri);
    $link_array = explode('/', $link[0]);
    array_shift($link_array);
    array_shift($link_array);
    $page = end($link_array);
    if($page == '') {
        Header('Location: home');
    }

    session_start();

    if($page != 'request') {
        $controller = new RouteController();
        $controller->$page($_GET);
    } else {
        $controllerName = $_REQUEST['target'] . 'Controller';
        $method = $_REQUEST['action'];
        $controller = new $controllerName();
        $controller->$method($_REQUEST);
    }