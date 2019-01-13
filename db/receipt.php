<?php

require_once 'database_init.php';

class receipt {

    public static function getAllReceipts() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM receipt");
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getAllReceiptsFor($customerUserId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM receipt WHERE Customer_User_Id = :customerUserId");
        $statement->bindParam(":customerUserId", $customerUserId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function addReceipt($customerUserId, $salesmanUserId=null, $statusId=1) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO receipt(Customer_User_Id, Salesman_User_Id, Status_Id) 
        VALUES (:customerUserId, :salesmanUserId, :statusId)");
        $statement->bindParam(":customerUserId", $customerUserId);
        $statement->bindParam(":salesmanUserId", $salesmanUserId);
        $statement->bindParam(":statusId", $statusId);
        $statement->execute();
        return $db->lastInsertId();
    }
    
    public static function updateStatus($receiptId, $salesmanId, $statusId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE receipt SET Status_Id = :statusId, Salesman_User_Id = :salesmanId"
                . " WHERE Receipt_Id = :receiptId");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->bindParam(":statusId", $statusId);
        $statement->bindParam(":salesmanId", $salesmanId);
        $statement->execute();
    }
    
    public static function addItem($receiptId, $itemId, $quantity) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO receipt_item(Receipt_Id, Item_Id, Quantity) 
        VALUES (:receiptId, :itemId, :quantity)");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":quantity", $quantity);
        $statement->execute();
    }
    
    public static function removeItem($receiptId, $itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM receipt_item WHERE Receipt_Id = :receiptId AND Item_Id = :itemId");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }
    
    public static function getAllIReceiptItemDataOn($receiptId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT Item_Id, Quantity FROM receipt_item WHERE Receipt_Id = :receiptId");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getAllItemDataOn($receiptId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM item WHERE Item_Id IN (SELECT Item_Id FROM receipt_item WHERE Receipt_Id = :receiptId)");
        $statement->bindParam(":receiptId", $receiptId);
        $statement->execute();
        return $statement->fetchAll();
    }
}

