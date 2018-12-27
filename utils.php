<?php

class Utils {

    public static function isLoggedIn() {
        return isset($_SESSION["logged_in"]);
    }

}

