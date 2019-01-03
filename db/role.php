<?php

require_once 'database_init.php';

class role {

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
    
    public static function idToName($roleId){
        switch ($roleId){
            case 1:
                return "Administrator";
            case 2:
                return "Salesman";
            case 3: 
                return "Customer";
            default:
                return "Invalid input";    
        }
    }
}

