<?php

require_once("db/item.php");
require_once("db/receipt.php");
require_once("ViewHelper.php");
#require_once("forms/ItemsForm.php");

class OrderController {
    
    public static function checkout(){
        session_start();
        $user = user::get($_GET['userId']);
        $address = address::get($user['Address_Id']);
        $cart = $_SESSION['cart'];
        $data = ['user' => $user, 'address' => $address, 'cart' => $cart];
        echo ViewHelper::render("view/checkout.view.php", $data);
    }

    public static function createReceipt(){
        
    }
}
