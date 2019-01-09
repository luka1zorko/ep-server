<?php

require_once("db/item.php");
require_once("db/receipt.php");
require_once("ViewHelper.php");
#require_once("forms/ItemsForm.php");

class OrderController {
    
    public static function checkout(){
        $user = user::get($_GET['userId']);
        $address = address::get($user['Address_Id']);
        $cart = $_SESSION['cart'];
        $displayCart = [];
        $totalPrice = 0;
        foreach ($cart as $id => $quantiy){
            $item = item::get2($id);
            $displayCart[$id]['itemName'] = $item['Item_Name'];
            $displayCart[$id]['itemPrice'] = $item['Item_Price'];
            $displayCart[$id]['quantity'] = $quantiy;
            $totalPrice += $quantiy * $item['Item_Price'];
        }
        $data = ['user' => $user, 'address' => $address, 'cart' => $displayCart, 'totalPrice' => (string)$totalPrice];
        echo ViewHelper::render("view/checkout.view.php", $data);
    }

    public static function createReceipt(){
        
    }
}
