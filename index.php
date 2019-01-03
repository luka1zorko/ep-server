<?php

// enables sessions
#session_start();

require_once("controller/itemController.php");
require_once("controller/userController.php");
require_once("utils.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "resources/images/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// ROUTER: defines mapping between URLS and controllers
$urls = [
    "signin" => function() {
        userController::signIn();
    },
    "signout" => function() {
        userController::signOut();
    },
    "items" => function () {
        itemController::index();
    },
    "items/add" => function () {
        itemController::add();
    },
    "items/edit" => function () {
        itemController::edit();
    },
    "items/delete" => function () {
        itemController::delete();
    },
    "profile" => function () {
        userController::profile();
    },     
    "signupRedirect" => function () {
        echo ViewHelper::render("view/signUp.view.php");
    },
    "signup" => function () {
        UserController::signUp();
    },
    "profile/updatePersonalInformation" => function () {
        UserController::updatePersonalInformation();
    },
    "profile/updateAddress" => function () {
        UserController::updateAddress();
    },
    "profile/updatePassword" => function () {
        UserController::updatePassword();
    },   
    "customerListRedirect" => function () {
        echo ViewHelper::render("view/customerList.view.php");
    },          
    "customerList" => function () {
        UserController::customerList();
    },
    "registerSalesman" => function () {
        UserController::registerSalesman();
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
