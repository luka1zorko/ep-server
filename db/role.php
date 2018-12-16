<?php

require_once 'database_init.php';

class user {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM role");
        $statement->execute();
        return $statement->fetchAll();
    }
        
    public static function get($roleId) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM role WHERE Role_Id =:roleId");
        $statement->bindParam(":roleId", $roleId);
        $statement->execute();
        return $statement->fetch();
    }
}

