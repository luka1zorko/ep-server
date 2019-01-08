<?php

require_once 'database_init.php';
require_once 'db/AbstractDB.php';

class item extends AbstractDB {

    public static function getAllActivated() {
        return parent::query("SELECT * FROM item WHERE Item_Activated = 1");
    }
    
    public static function getAll() {
        return parent::query("SELECT * FROM item");
    }
    
    public static function delete(array $id) {
        return parent::modify("DELETE FROM item WHERE Item_Id = :id", $id);
    }
    
    public static function get(array $id) {
        $items = parent::query("SELECT *"
                        . " FROM item"
                        . " WHERE Item_Id = :id", $id);

        if (count($items) == 1) {
            return $items[0];
        } else {
            throw new InvalidArgumentException("No such item");
        }
    }
    
    public static function get2($itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM item WHERE Item_Id =:itemId");
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
        return $statement->fetch();
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT Item_Id, Item_Name, Item_Price, Item_Activated, "
                        . "CONCAT(:prefix, Item_Id) as uri "
                        . "FROM item "
                        . "WHERE Item_Activated = 1 "
                        . "ORDER BY Item_Id ASC", $prefix);
    }

    public static function insert(array $params) {
        return parent::modify("INSERT INTO item (Item_Name, Item_Description, Item_Price, Item_Activated) "
                        . " VALUES (:name, :description, :price, :itemActivated)", $params);
    }
    
    public static function insert2($itemName, $itemPrice, $description, $activated) {
        
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO item(Item_Name, Item_Price, Item_Description, Item_Activated)  
        VALUES (:itemName, :itemPrice, :description, activated)");
        $statement->bindParam(":itemName", $itemName);
        $statement->bindParam(":itemPrice", $itemPrice);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":activated", $activated);
        $statement->execute();
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE item SET Item_Name = :itemName, Item_Price = :itemPrice, Item_Activated = :itemActivated"
                . "WHERE Item_Id = :itemId", $params);
    }
    
    public static function itemActivation($itemId, $activated){
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE item SET Item_Activated = :activated"
                . " WHERE Item_Id = :itemId");
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":activated", $activated);
        $statement->execute();
    }

}
