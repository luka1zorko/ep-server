<?php

require_once("db/item.php");
require_once("db/cart.php");
require_once("db/image.php");
require_once("ViewHelper.php");
#require_once("forms/ItemsForm.php");

class ItemController {

    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if ($data["id"]) {
            echo ViewHelper::render("view/itemDetail.php", [
                "item" => item::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/items.view.php", [
                "items" => item::getAll()
            ]);
        }
    }
    
    public static function itemList(){
        if(isset($_GET['role'])){
            $items = item::getAll();
            echo json_encode($items);
        }
        else
            echo ViewHelper::render("view/itemList.view.php");
    }
    
    public static function toggleActivation(){
        item::itemActivation($_POST['itemId'], $_POST['activated']);
    }
    
    
    public static function addItem() {
        $post = isset($_POST['itemName']);
        //echo($post);
        if($post){
            //print_r("post['itemName'] exists");
            item::insert2($_POST['itemName'], $_POST['itemPrice'], $_POST['description'], $_POST['activated']);
        }
        else{
            echo ViewHelper::render("view/itemAdd.view.php");
        }
    }
    
    public static function edit() {
        print_r($_POST);
        if(isset($_POST['itemName'])){
            item::update([$_POST['itemName'], $_POST['itemPrice'], $_POST['description'], $_POST['activated'], $_GET['itemId']]);
            echo "post['itemName'] exists";
        }
        echo "post['itemName'] does not exist]";
    }
    
    public static function saveCart(){
        session_start();
        //print_r("saving cart");
        //print_r($_POST);
        //print_r($_SESSION['userId']);
        //$array = json_decode($_POST['cart']);
        cart::removeAllItems($_SESSION['userId']);
        foreach($_POST as $itemId => $quantity){
            //print_r($itemId);
            //print_r($quantity);
            cart::insert($_SESSION['userId'], $itemId, $quantity);
        }
    }
    
    public static function emptyCart(){
        session_start();
        cart::removeAllItems($_SESSION['userId']);
    }
    
    public static function itemDetails(){
        $item = item::get2($_GET['itemId']);
        $images = image::getAllForItem($_GET['itemId']);
        $data = ["item"=> $item, "images" => $images];
        //var_dump($data);
        echo ViewHelper::render("view/item.view.php", $data);
    }
     
}
