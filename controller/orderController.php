<?php

require_once("db/item.php");
require_once("db/receipt.php");
require_once("ViewHelper.php");
#require_once("forms/ItemsForm.php");

class OrderController {
    
    public static function checkout(){
        if(!isset($_SESSION['cart']))
            echo ViewHelper::redirect(BASE_URL . "items");
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

    public static function submitOrder(){
        $receiptId = receipt::addReceipt($_SESSION['userId']);
        foreach ($_POST['cart'] as $itemId => $details){
            receipt::addItem($receiptId, $itemId, $details['quantity']);
        }
        unset($_SESSION["cart"]);
        cart::removeAllItems($_SESSION['userId']);
    }
    
    public static function displayOrders(){
        if($_SESSION['userRole'] == 3){
            $receipts = receipt::getAllReceiptsFor($_SESSION['userId']);
        }
        else{
            $receipts = receipt::getAllReceipts();
        }
        echo ViewHelper::render("view/orders.view.php", $receipts);
    }
    
    public static function orderItems(){
        $items = receipt::getAllItemDataOn($_POST['receiptId']);
        $receipt_items = receipt::getAllIReceiptItemDataOn($_POST['receiptId']);
        $quantities = [];
        foreach($receipt_items as $receipt_item){
           $quantities[$receipt_item['Item_Id']] = $receipt_item['Quantity'];
        }
        $data = ['items' => $items, 'quantities' => $quantities];
        echo ViewHelper::render("view/orderItems.view.php", $data);
    }
    
    public static function confirmOrder(){
        echo "confirming order";
        receipt::updateStatus($_POST['receiptId'], $_SESSION['userId'], 2);
    }
    
    public static function cancelOrder(){
        echo "canceling order";
        receipt::updateStatus($_POST['receiptId'], $_SESSION['userId'], 3);
    }
}
