<?php

// enables sessions
session_start();

require_once("controller/itemController.php");
require_once("controller/itemRESTController.php");
require_once("controller/userController.php");
require_once("controller/orderController.php");
require_once("utils.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "resources/images/");


$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// ROUTER: defines mapping between URLS and controllers
$urls = [
    "/^items$/" => function () {
        itemController::index();
    },
    "/^itemDetails$/" => function () {
        itemController::itemDetails();
    },  
    "/^signin$/" => function() {
        utils::use_HTTPS();
        userController::signIn();
    },
    "/^signup$/" => function () {
        utils::use_HTTPS();
        UserController::signUp();
    },
    "/^signupRedirect$/" => function () {
        echo ViewHelper::render("view/signUp.view.php");
    },
    "/^signout$/" => function() {
        utils::use_HTTPS();
        userController::signOut();
    },
    # Profile
    "/^profile$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {userController::profile();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },     
    "/^profile\/update$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {itemController::updateProfile();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^profile\/updatePersonalInformation$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {userController::updatePersonalInformation();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^profile\/updateAddress$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {userController::updateAddress();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^profile\/updatePassword$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {userController::updatePassword();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    
    # Customer and Salesman List
    "/^customerList$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn() && utils::isSalesman()) {userController::customerList();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^toggleConfirmation$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn() && utils::isSalesman()) {userController::toggleConfirmation();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^registerSalesman$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn() && utils::isAdmin()) {userController::registerSalesman();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    }, 
    "/^registerCustomer$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn() && utils::isSalesman()) {userController::registerCustomer();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    
    # Item List
    "/^itemList$/" => function () {
        if (utils::isLoggedIn() && utils::isSalesman()) {itemController::itemList();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^toggleActivation$/" => function () {
        utils::use_HTTPS();
        if (utils::isLoggedIn() && utils::isSalesman()) {itemController::toggleActivation();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^addItem$/" => function () {
        if (utils::isLoggedIn()) {itemController::addItem();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^editItem/" => function () {
        if (utils::isLoggedIn()) {itemController::editItem();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
            
    # Cart
    "/^saveCart$/" => function (){
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {itemController::saveCart();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },
    "/^emptyCart$/" => function (){
        utils::use_HTTPS();
        if (utils::isLoggedIn()) {itemController::emptyCart();}
        else {ViewHelper::redirect(BASE_URL . "items");}
    },        
    "/^addItem$/" => function () {
        utils::use_HTTPS();
        if (!utils::isLoggedIn()) {userController::signIn();}
        else {ItemController::addItem();}
    },    
    "/^checkout$/" => function (){
        OrderController::checkout();
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
