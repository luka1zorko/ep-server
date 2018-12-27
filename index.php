<?php

// enables sessions
#session_start();

require_once("controller/itemController.php");
require_once("controller/userController.php");
require_once("utils.php");
require_once("view/navbar.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "resources/images/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// ROUTER: defines mapping between URLS and controllers
$urls = [
    "signin" => function() {
        UserController::signIn();
    },
    "items" => function () {
        ItemController::index();
    },
    "items/add" => function () {
        ItemController::add();
    },
    "items/edit" => function () {
        ItemController::edit();
    },
    "items/delete" => function () {
        ItemController::delete();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "items");
    },
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (InvalidArgumentException $e) {
    ViewHelper::error404();
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 

