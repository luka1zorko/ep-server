<?php

// enables sessions
#session_start();

require_once("controller/itemController.php");
require_once("controller/itemRESTController.php");
require_once("controller/userController.php");
require_once("utils.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "resources/images/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// ROUTER: defines mapping between URLS and controllers
$urls = [
    "/^signin$/" => function() {
        userController::signIn();
    },
    "/^signout$/" => function() {
        userController::signOut();
    },
    "/^items$/" => function () {
        itemController::index();
    },
    "/^items\/add$/" => function () {
        itemController::add();
    },
    "/^items\/edit$/" => function () {
        itemController::edit();
    },
    "/^items\/delete$/" => function () {
        itemController::delete();
    },
    "/^profile$/" => function () {
        userController::profile();
    },     
    "/^profile\/update$/" => function () {
        userController::updateProfile();
    },            
    "/^signupRedirect$/" => function () {
        echo ViewHelper::render("view/signUp.view.php");
    },
    "/^signup$/" => function () {
        UserController::signUp();
    },
    "/^profile\/updatePersonalInformation$/" => function () {
        UserController::updatePersonalInformation();
    },
    "/^profile\/updateAddress$/" => function () {
        UserController::updateAddress();
    },
    "/^profile\/updatePassword$/" => function () {
        UserController::updatePassword();
    },   
    "/^customerListRedirect$/" => function () {
        echo ViewHelper::render("view/customerList.view.php");
    },          
    "/^customerList$/" => function () {
        UserController::customerList();
    },
    "/^toggleConfirmation$/" => function () {
        UserController::toggleConfirmation();
    },
    "/^registerSalesman$/" => function () {
        UserController::registerSalesman();
    },      
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "items");
    },
    
    # REST API
    "/^api\/items\/(\d+)$/" => function ($method, $id) {
        // TODO: izbris knjige z uporabo HTTP metode DELETE
        switch ($method) {
            case "PUT":
                itemRESTController::edit($id);
                break;
            default: # GET
                itemRESTController::get($id);
                break;
        }
    },
    "/^api\/items$/" => function ($method) {
        switch ($method) {
            case "POST":
                itemRESTController::add();
                break;
            default: # GET
                itemRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
