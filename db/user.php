<?php

require_once 'database_init.php';

class user {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM user");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function delete($username) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM user WHERE Username = :username");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();
    }
    
    public static function get($username) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM user WHERE Username =:username");
        $statement->bindParam(":username", $username);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($username, $roleId, $firstName, $lastName, $email, $password, 
            $phoneNumber=null, $confirmed=null, $addressId=null) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO user(Username, User_First_Name, User_Last_Name, User_Email, 
        User_Password, Role_Id, Address_Id, User_Phone_Number, User_Confirmed) 
        VALUES (:username, :firstName, :lastName, :email, :password, :roleId, :addressId, :phoneNumber, :confirmed)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":firstName", $firstName);
        $statement->bindParam(":lastName", $lastName);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":roleId", $roleId);
        $statement->bindParam(":addressId", $addressId);
        $statement->bindParam(":phoneNumber", $phoneNumber);
        $statement->bindParam(":confirmed", $confirmed);
        $statement->execute();
    }

    public static function update($username, $roleId, $firstName, $lastName, $email, $password, 
        $phoneNumber=null, $confirmed=null, $addressId=null) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE user SET Username = :username, Role_Id = :roleId, User_First_Name = :firstName, "
                . "User_Last_Name = :lastName, User_Email = :email, User_Password = :password, "
                . "User_Phone_Number = :phoneNumber, User_Confirmed = :confirmed, Address_Id = :addressId"
                . " WHERE Username = :username");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":firstName", $firstName);
        $statement->bindParam(":lastName", $lastName);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":roleId", $roleId);
        $statement->bindParam(":addressId", $addressId);
        $statement->bindParam(":phoneNumber", $phoneNumber);
        $statement->bindParam(":confirmed", $confirmed);
        $statement->execute();

    }
}
