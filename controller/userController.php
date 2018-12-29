<?php

require_once("db/user.php");
require_once("db/address.php");
require_once("ViewHelper.php");

class UserController {

    public static function signIn() {
        $failedAttempt = false;
        
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            try {
                if ($user = user::login($_POST["username"], $_POST["password"])) {
                    session_start();
                    session_regenerate_id(true);
                    $_SESSION["userId"] = $user['User_Id'];
                    $_SESSION["userRole"] = $user['Role_Id'];
                    echo ViewHelper::redirect(BASE_URL . "items");
                    //var_dump($_SESSION);
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
    
    public static function signUp(){
        $addressId = address::resolveAddress($_POST['postalCode'], $_POST['city'], $_POST['street'], $_POST['houseNumber']);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $roleId = 3;
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
        $confirmed = true;
        user::insert($username, $roleId, $firstName, $lastName, $email, $password, $phoneNumber, $confirmed, $addressId);
        echo ViewHelper::render("view/signIn.view.php");
    }

    public static function signOut(){
        session_start();
        session_destroy();
        echo ViewHelper::render("view/signIn.view.php");
    }
    
    public static function profile() {
        session_start();
        $user = user::get($_SESSION["userId"]);
        $address = address::get($user['Address_Id']);
        $merge = array_merge($user, $address);
        //var_dump($merge);
        echo ViewHelper::render("view/profile.view.php", $merge);
    }
    
    public static function updateProfile() {
        //update naslova ??
        //2 forma....ob spreminjanju naslova kreiraš nov naslov
        //var_dump($_POST);
    }
   
}

