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
        utils::use_HTTPS();
        userController::signIn();
    },
    "/^signout$/" => function() {
        utils::use_HTTPS();
        userController::signOut();
    },
    "/^items$/" => function () {
        itemController::index();
    },
    "/^item\/add$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {itemController::addItem();}
    },
    "/^item\/edit$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {itemController::edit();}
    },
    "/^items\/delete$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {itemController::delete();}
    },
    "/^profile$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {userController::profile();}
    },     
    "/^profile\/update$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {userController::updateProfile();}
    },
    "/^signupRedirect$/" => function () {
        utils::use_HTTPS();
        echo ViewHelper::render("view/signUp.view.php");
    },
    "/^signup$/" => function () {
        utils::use_HTTPS();
        UserController::signUp();
    },
    "/^profile\/updatePersonalInformation$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::updatePersonalInformation();}
    },
    "/^profile\/updateAddress$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::updateAddress();}
    },
    "/^profile\/updatePassword$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::updatePassword();}
    },            
    "/^customerList$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::customerList();}
    },
    "/^toggleConfirmation$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::toggleConfirmation();}
    },
    "/^registerSalesman$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::registerSalesman();}
    }, 
    "/^registerCustomer$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {UserController::registerCustomer();}
    },   
    "/^itemList$/" => function () {
        ItemController::itemList();
    },
    "/^toggleActivation$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::toggleActivation();}
    },
    "/^itemDetails$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::itemDetails();}
    },            
    "/^saveCart$/" => function (){
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::saveCart();}
    },
    "/^emptyCart$/" => function (){
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::emptyCart();}
    },        
    "/^addItem$/" => function () {
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::addItem();}
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
