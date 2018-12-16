<?php

require_once 'database_init.php';

class item {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM item");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function delete($itemId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM item WHERE Item_Id = :itemId");
        $statement->bindParam(":itemId", $itemId, PDO::PARAM_INT);
        $statement->execute();
    }
    
    public static function get($itemId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM item WHERE Item_Id =:itemId");
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($itemName, $itemPrice) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO item(Item_Name, Item_Price)  
        VALUES (:itemName, :itemPrice)");
        $statement->bindParam(":itemName", $itemName);
        $statement->bindParam(":itemPrice", $itemPrice);
        $statement->execute();
    }

    public static function update($itemId, $itemName, $itemPrice) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE item SET Item_Name = :itemName, Item_Price = :itemPrice "
                . "WHERE Item_Id = :itemId");
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":itemName", $itemName);
        $statement->bindParam(":itemPrice", $itemPrice);
        $statement->execute();
    }
}

