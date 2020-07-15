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
    $id = null;
    if(is_numeric(end($link_array))) {
        $id = end($link_array);
        unset($link_array[array_key_last($link_array)]);
    }
    foreach($link_array as $key => $element) {
        if($key != 0) {
            $link_array[$key] = ucfirst($element);
        }
    }
    $page = implode('', $link_array);
    if($page == '') {
        Header('Location: home');
    }

    session_start();

    if($page != 'request') {
        $controller = new RouteController();
        if(!method_exists($controller, $page)) {
            http_response_code(404);
        } else {
            $controller->$page(array_merge($_GET, ['urlId' => $id]));
        }
    } else {
        $controllerName = $_REQUEST['target'] . 'Controller';
        $method = $_REQUEST['action'];
        $controller = new $controllerName();
        $controller->$method($_REQUEST);
    }