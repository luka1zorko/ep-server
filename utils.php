<?php

class Utils {

    public static function isLoggedIn() {
        return isset($_SESSION["logged_in"]);
    }
    
     public static function use_HTTPS() {
         if (!isset($_SERVER["HTTPS"])) {
            $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            header("Location: " . $url);
        }
    }

}

