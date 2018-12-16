<?php

require_once 'database_init.php';

class rating {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM rating");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function delete($userId, $itemId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM rating WHERE User_Id = :userId AND Item_Id = :itemId");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();
    }
    
    public static function get($userId, $itemId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM rating WHERE User_Id =:userId AND Item_Id = :itemId");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($userId, $itemId, $rating) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO rating(User_Id, Item_Id, Rating)  
        VALUES (:userId, :itemId, :rating)");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":rating", $rating);
        $statement->execute();
    }

    public static function update($userId, $itemId, $rating) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE rating SET Rating = :rating "
                . "WHERE User_Id = :userId AND Item_Id = :itemId");
        $statement->bindParam(":userId", $userId);
        $statement->bindParam(":itemId", $itemId);
        $statement->bindParam(":rating", $rating);
        $statement->execute();
    }
}

