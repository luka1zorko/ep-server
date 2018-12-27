<?php

require_once("db/user.php");
require_once("ViewHelper.php");

class UserController {

    public static function signIn() {
        
        session_start();
        $failedAttempt = false;

        if (isset($_POST["username"]) && isset($_POST["password"])) {
            try {
                if (user::login($_POST["username"], $_POST["password"])) {
                    session_regenerate_id(true);
                    $_SESSION["logged_in"] = true;
                    echo ViewHelper::redirect(BASE_URL . "items");
                } else {
                    $failedAttempt = true;
                }
            } catch (Exception $exc) {
                echo $exc->getMessage();
                exit(-1);
            }
        } elseif (isset($_GET["logout"])) {
            session_destroy();
            echo ViewHelper::redirect(BASE_URL . "items");
        }
        
        echo ViewHelper::render("view/signIn.view.php");
        
        if ($failedAttempt) {
            echo "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>Napačno uporabniško ime in geslo.</b></p></div>,</div>";
        }
    }
}


