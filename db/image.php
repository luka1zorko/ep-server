<?php

require_once 'database_init.php';

class image {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM image");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getAllForItem($itemId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM image WHERE Item_Id = :itemId");
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function delete($imageId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM image WHERE Image_Id = :imageId");
        $statement->bindParam(":imageId", $imageId);
        $statement->execute();
    }
    
    public static function get($imageId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM image WHERE Image_Id =:imageId");
        $statement->bindParam(":imageId", $imageId);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($itemId, $imageName, $serialNumber, $imagePath) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO image(Item_Id, Image_Name, Serial_Number, Image_Path) 
        VALUES (:itemId, :imageName, :serialNumber, :imagePath)");
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":imageName", $imageName);
        $statement->bindParam(":serialNumber", $serialNumber);
        $statement->bindParam(":imagePath", $imagePath);
        $statement->execute();
    }

    public static function update($imageId, $itemId, $imageName, $serialNumber, $imagePath) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE image SET Item_Id = :itemId, Image_Name = :imageName, "
                . "Serial_Number = :serialNumber, Image_Path = :imagePath"
                . " WHERE Image_Id = :imageId");
        $statement->bindParam(":imageId", $imageId);
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":imageName", $imageName);
        $statement->bindParam(":serialNumber", $serialNumber);
        $statement->bindParam(":imagePath", $imagePath);
        $statement->execute();

    }
}

