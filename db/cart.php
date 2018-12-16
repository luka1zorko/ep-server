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
    
    public static function getAllItems($userId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT Item_Id FROM cart WHERE User_Id =:userId");
        $statement->bindParam(":userId", $userId);
        $statement->execute();
        return $statement->fetch();
    }

    public static function insert($userId, $itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO cart(User_Id, Item_Id) 
        VALUES (:userId, :itemId)");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }

}

