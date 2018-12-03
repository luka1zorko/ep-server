<?php

require_once 'database_init.php';

class DBJokes {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Item_Id, Item_Name, Item_Price FROM item");
        $statement->execute();

        return $statement->fetchAll();
    }
    /*
    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }
    
    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes 
            WHERE id =:id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($joke_date, $joke_text) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO jokes (joke_date, joke_text)
            VALUES (:joke_date, :joke_text)");
        $statement->bindParam(":joke_date", $joke_date);
        $statement->bindParam(":joke_text", $joke_text);
        $statement->execute();
    }

    public static function update($id, $joke_date, $joke_text) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE jokes SET joke_date = :joke_date,
            joke_text = :joke_text WHERE id =:id");
        $statement->bindParam(":joke_date", $joke_date);
        $statement->bindParam(":joke_text", $joke_text);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }
    */
}

