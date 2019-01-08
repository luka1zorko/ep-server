<?php

require_once 'database_init.php';

class cart {
    
    public static function removeCartItem($userId, $itemId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM cart WHERE User_Id = :userId AND Item_Id = :itemId");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }
    
    public static function removeAllItems($userId){
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM cart WHERE User_Id = :userId");
        $statement->bindParam(":userId", $userId);
        $statement->execute();
    }
    
    public static function getAllItems($userId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT Item_Id, Quantity FROM cart WHERE User_Id =:userId");
        $statement->bindParam(":userId", $userId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function insert($userId, $itemId, $quantity) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO cart(User_Id, Item_Id, Quantity) 
        VALUES (:userId, :itemId, :quantity)");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":quantity", $quantity);
        $statement->execute();
    }

}

