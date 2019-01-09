<?php

require_once("db/user.php");
require_once("db/address.php");
require_once("ViewHelper.php");

class UserController {

    public static function checkCertificat($user) {
        if ($user['Role_Id'] != 3) { # if user is not customer
            $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
                            
            if ($client_cert == null) {
                die('err: Spremenljivka SSL_CLIENT_CERT ni nastavljena.');
                return false;
            }
            $cert_data = openssl_x509_parse($client_cert);
            $commonname = (is_array($cert_data['subject']['CN']) ?
                            $cert_data['subject']['CN'][0] : $cert_data['subject']['CN']);
            if ($commonname != $user['Username']) {return false;}               
        }
        return true;
    }
    
    public static function signIn() {
        $wrongPassword = false;
        $notConfirmed = false;
        $isCertified = True;
        
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password = $_POST['password'];
            
            try {
                if(user::getByUsername($username)['User_Confirmed']){
                    
                    if ($user = user::login($username, $password)) {
                        $isCertified = UserController::checkCertificat($user);
                        if ($isCertified) {
                            session_start();
                            session_regenerate_id(true);
                            $_SESSION["isLoggedIn"] = True;
                            $_SESSION["userId"] = $user['User_Id'];
                            $_SESSION["userRole"] = $user['Role_Id'];
                            echo ViewHelper::redirect(BASE_URL . "items");
                        }
                    } else {$wrongPassword = true;}
                }
                else{$notConfirmed = true;}
            } catch (Exception $exc) {
                echo $exc->getMessage();
                exit(-1);
            }
        } elseif (isset($_GET["logout"])) {
            session_destroy();
            echo ViewHelper::redirect(BASE_URL . "items");
        }
        
        echo ViewHelper::render("view/signIn.view.php");
        
        if($wrongPassword){echo "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>Wrong username and/or password</b></p></div></div>";}
        elseif($notConfirmed){echo "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>Account not activated.</b></p></div></div>";}
        elseif(!$isCertified){echo "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>You need a certificat to sign in.</b></p></div></div>";}
    }
    
    public static function signUp(){
        UserController::captcha();
        $postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_NUMBER_INT);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
        $houseNumber = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_STRING);
        
        //$addressId = address::resolveAddress($_POST['postalCode'], $_POST['city'], $_POST['street'], $_POST['houseNumber']);
        $addressId = address::resolveAddress($postalCode, $city, $street, $houseNumber);
        
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $roleId = 3;
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
        $confirmed = 0;
        user::insert($username, $roleId, $firstName, $lastName, $email, $password, $phoneNumber, $confirmed, $addressId);
        echo ViewHelper::render("view/signIn.view.php");
    }
    
    public static function captcha() {
        if(isset($_POST['g-recaptcha-response'])) {$captcha = $_POST['g-recaptcha-response'];}
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lc7MYgUAAAAAJtVNnOoud-dfKtKyPJuT5Unt3Ym&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == false)
        {echo '<h2>You are spammer!</h2>';}
    }
    
    public static function signOut(){
        #session_start();
        session_destroy();
        echo ViewHelper::redirect(BASE_URL . "signin");
    }
    
    public static function profile() {
        #session_start();
        $user = user::get($_GET["userId"]);
        if($user['Role_Id'] == 3)
            $user = array_merge ($user, address::get($user['Address_Id']));
        //var_dump($merge);
        echo ViewHelper::render("view/profile.view.php", $user);
    }
    
    public static function updatePersonalInformation() {
        #session_start();
        $user = user::get($_GET['userId']);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
        user::update(strlen($username) > 0 ? $username : $user['Username'], strlen($firstName) > 0 ? $firstName : $user['User_First_Name'],
                strlen($lastName) > 0 ? $lastName : $user['User_Last_Name'], strlen($email) > 0 ? $email : $user['User_Email'],
                $user['User_Password'], strlen($phoneNumber) > 0 ? $phoneNumber : $user['User_Phone_Number'],
                $user['User_Confirmed'], $user['Address_Id']);
        
        $user = user::get($_GET["userId"]);
        if($user['Role_Id'] == 3)
            $user = array_merge ($user, address::get($user['Address_Id']));
        echo ViewHelper::render("view/profile.view.php", $user);
    }
    
    public static function updatePassword(){
        $newPassword = $_POST['newPassword'];
        $repeatPassword = $_POST['repeatPassword'];
        $currentPassword = $_POST['currentPassword'];
        
        if($newPassword == $repeatPassword){
            $user = user::get($_GET['userId']);
            if(password_verify($currentPassword, $user['User_Password'])){
                user::update($user['Username'], $user['User_First_Name'], $user['User_Last_Name'], $user['User_Email'], password_hash($newPassword, PASSWORD_DEFAULT), $user['User_Phone_Number'], $user['User_Confirmed'], $user['Address_Id']);
                session_destroy();
                echo ViewHelper::redirect(BASE_URL . "signin");
            }
            else
                "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>Napačno geslo.</b></p></div>,</div>";
        }
        else
            echo "<div class='row'><div class='offset-md-4 col-md-4 text-center'><p><b>Gesli se ne ujemata.</b></p></div>,</div>";
    
        $user = user::get($_GET["userId"]);
        if($user['Role_Id'] == 3)
            $user = array_merge ($user, address::get($user['Address_Id']));
        echo ViewHelper::render("view/profile.view.php", $user);
    }
    
    public static function updateAddress(){
        $user = user::get($_SESSION['userId']);
        $addressId = $user['Address_Id'];
        $postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_NUMBER_INT);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
        $houseNumber = filter_input(INPUT_POST, 'houseNumber', FILTER_SANITIZE_STRING);
        $houseNumberAddon = null;
        address::update($addressId, $postalCode, $city, $street, $houseNumber, $houseNumberAddon);

        //$user = user::get($_GET["userId"]);
        if($_GET['role'] == 3)
            $user = array_merge ($user, address::get($user['Address_Id']));
        echo ViewHelper::render("view/profile.view.php", $user);
    }
    
    public static function registerSalesman(){
        if(isset($_POST['username'])){
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $roleId = 2;
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $confirmed = 0;
            user::insert ($username, $roleId, $firstName, $lastName, $email, $password, null, $confirmed, null);
        }
        echo ViewHelper::render("view/registerSalesman.view.php");
    }
    
    public static function registerCustomer(){
        if(isset($_POST['username'])){
            $postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_NUMBER_INT);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
            $houseNumber = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_STRING);
        
            $addressId = address::resolveAddress($postalCode, $city, $street, $houseNumber);
            //$addressId = address::resolveAddress($_POST['postalCode'], $_POST['city'], $_POST['street'], $_POST['houseNumber']);
            
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $roleId = 3;
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
            $confirmed = 1;
            user::insert($username, $roleId, $firstName, $lastName, $email, $password, $phoneNumber, $confirmed, $addressId);
        }
        echo ViewHelper::render("view/registerCustomer.view.php");
    }
    
    public static function customerList(){
        if(isset($_GET['role'])){
            $list = user::getUserList($_GET['role']);
            echo json_encode($list);
        }
        else
            echo ViewHelper::render("view/customerList.view.php");
    }
    
    public static function toggleConfirmation(){
        user::userConfirmation($_POST['username'], $_POST['confirmed']);
    }
   
}

