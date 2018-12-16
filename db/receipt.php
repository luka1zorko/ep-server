<?php

require_once 'database_init.php';

class receipt {

    public static function getAllReceipts() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM receipt");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function addReceipt($customerUserId, $salesmanUserId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO receipt(Customer_User_Id, Salesman_User_Id) 
        VALUES (:customerUserId, :salesmanUserId)");
        $statement->bindParam(":customerUserId", $customerUserId);
        $statement->bindParam(":salesmanUserId", $salesmanUserId);
        $statement->execute();
    }
    
    public static function addItem($receiptId, $itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO receipt_item(Receipt_Id, Item_Id) 
        VALUES (:receiptId, :itemId)");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }
    
    public static function removeItem($receiptId, $itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM receipt_item WHERE Receipt_Id = :receiptId AND Item_Id = :itemId");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }
    
    public static function getAllItemsOn($receiptId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT Item_Id FROM receipt_item WHERE Receipt_Id = :receiptId");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->execute();
    }
}

