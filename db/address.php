<?php

require_once 'database_init.php';

class address {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM address");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function delete($addressId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM address WHERE Address_Id = :addressId");
        $statement->bindParam(":addressId", $addressId, PDO::PARAM_INT);
        $statement->execute();
    }
    
    public static function get($addressId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM address WHERE Address_Id =:addressId");
        $statement->bindParam(":addressId", $addressId);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($postalCode, $city, $street, $houseNumber, $houseNumberAddon=null) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO address(Postal_Code, City, Street, House_Number, House_Number_Addon)  
        VALUES (:postalCode, :city, :street, :houseNumber, :houseNumberAddon)");
        $statement->bindParam(":postalCode", $postalCode);
        $statement->bindParam(":city", $city);
        $statement->bindParam(":street", $street);
        $statement->bindParam(":houseNumber", $houseNumber);
        $statement->bindParam(":houseNumberAddon", $houseNumberAddon);
        $statement->execute();
    }

    public static function update($addressId, $postalCode, $city, $street, $houseNumber, $houseNumberAddon=null) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("UPDATE address SET Postal_Code = :postalCode, City = :city,"
                . "Street = :street,  House_Number = :houseNumber, House_Number_Addon = :houseNumberAddon "
                . "WHERE Address_Id = :addressId");
        $statement->bindParam(":postalCode", $postalCode);
        $statement->bindParam(":city", $city);
        $statement->bindParam(":street", $street);
        $statement->bindParam(":houseNumber", $houseNumber);
        $statement->bindParam(":houseNumberAddon", $houseNumberAddon);
        $statement->execute();
    }
    
    public static function resolveAddress($postalCode, $city, $street, $houseNumber, $houseNumberAddon=null){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT Address_Id FROM address WHERE Postal_Code = :postalCode AND City = :city "
                . "AND Street = :street AND House_Number = :houseNumber AND House_Number_Addon = :houseNumberAddon");
        $statement->bindParam(":postalCode", $postalCode);
        $statement->bindParam(":city", $city);
        $statement->bindParam(":street", $street);
        $statement->bindParam(":houseNumber", $houseNumber);
        $statement->bindParam(":houseNumberAddon", $houseNumberAddon);
        $statement->execute();
        $addressId =  $statement->fetch();
        if($addressId){
            return $addressId;
        }
        else{
            address::insert($postalCode, $city, $street, $houseNumber, $houseNumberAddon);
            return $db->lastInsertId();
        }
    }
}

