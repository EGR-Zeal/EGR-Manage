<?php

// this function will automatically include the files for the classes we want to use
// a class in a namespace looks like this
// models\DB
function autoload($class) {
    // so we convert the class name to a filepath
    // by replacing backslashes with forward slashes
    // because on linux file paths use forward slashes
    // then we add .class.php to the end
    // so if $class = models\DB
    // then $path = models/DB.class.php
    $path = str_replace("\\", "/", $class) . ".class.php";
    // here we include the file in our script
    require_once $path;
}

// this tells PHP to use our function whenever it can't find the class we are
// trying to use
spl_autoload_register('autoload');

// so here we can use a class we haven't specifically included
// and PHP will use our function to automatically include the file where it is
// defined
// here we will create a simple autoloader for controllers
function request() {
    $self = $_SERVER["PHP_SELF"];
    $curr_path = preg_replace("/[^\/]+$/", "", $self);
    $request_relative = str_replace($curr_path, "", $_SERVER["REQUEST_URI"]);
    $request = preg_replace("/\/$/", "", $request_relative);
    return $request;
}

$args = null;

function load_controller() {
    global $args;
    require_once 'controllers/index.php';
    require_once 'router.php';
    $req = request();
    $controller = "404";
    foreach ($controllers as $path => $ctrl) {
        $test = match_route($req, $path);
        if($test !== FALSE){
            $args = $test;
            $controller = $ctrl;
            break;
        }
    }
    return "controllers/" . $controller . ".ctrl.php";
}

$page = [
    "title" => "",
    "head" => "",
    "body" => ""
];

function template($tmp, $pge) {
    $page = $pge;
    require_once "views/" . $tmp . ".tmp.php";
}

require_once 'password.php';

$db = new models\DB();

require_once load_controller();

unset($db);
