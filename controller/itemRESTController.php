<?php

require_once("db/item.php");
require_once("controller/itemController.php");
require_once("ViewHelper.php");

class itemRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(item::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(item::getAllwithURI(["prefix" => $prefix]));
    }
    
    public static function add() {
        $data = filter_input_array(INPUT_POST, itemController::getRules());

        if (BooksController::checkValues($data)) {
            $id = item::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/items/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, itemController::getRules());

        if (itemController::checkValues($data)) {
            $data["Item_Id"] = $id;
            item::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 200 v primeru uspeha
        // Vrni kodo 404 v primeru neobstoječe knjige
    }

}
