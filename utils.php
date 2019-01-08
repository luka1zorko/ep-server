<?php

class Utils {

    public static function isLoggedIn() {
        return isset($_SESSION["userId"]);
    }
    
     public static function use_HTTPS() {
         if (!isset($_SERVER["HTTPS"])) {
            $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            header("Location: " . $url);
        }
    }
    
    public static function isAdmin() {
        return $_SESSION['userId'] == 1;
    }
    
    public static function isSalesman() {
        return $_SESSION['userId'] == 1 || $_SESSION['userId'] == 2;
    }

}

