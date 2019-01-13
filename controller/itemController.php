<?php

require_once("db/item.php");
require_once("db/cart.php");
require_once("db/image.php");
require_once("ViewHelper.php");

class ItemController {

    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if ($data["id"]) {
            echo ViewHelper::render("view/itemDetail.php", [
                "item" => item::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/items.view.php", [
                "items" => item::getAllActivated()
            ]);
        }
    }
    
    public static function itemList(){
        if(isset($_GET['role'])){
            $items = item::getAll();
            echo json_encode($items);
        }
        else {echo ViewHelper::render("view/itemList.view.php");}
            
    }
    
    public static function toggleActivation(){
        item::itemActivation($_POST['itemId'], $_POST['activated']);
    }
    
    public static function addImage($itemId) {
        $errors = array();
        $extension = array("jpeg","jpg","png","gif");
	$bytes = 1024;
	$allowedKB = 100;
	$totalBytes = $allowedKB * $bytes;
        if(isset($_FILES["files"])==false) {
            echo "<b>Please, Select the files to upload!!!</b>";
            return;
        }
                
        $serialNumber = 0;
        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
            $uploadThisFile = true;
            $file_name = $_FILES["files"]["name"][$key];
            $file_tmp = $_FILES["files"]["tmp_name"][$key];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);

            if(!in_array(strtolower($ext),$extension)) {
                array_push($errors, "File type is invalid. Name:- ".$file_name);
                $uploadThisFile = false;
            }
                    
            if($_FILES["files"]["size"][$key] > $totalBytes){
                array_push($errors, "File size must be less than 100KB. Name:- ".$file_name);
		$uploadThisFile = false;
            }

            if(file_exists("Upload/".$_FILES["files"]["name"][$key])) {
                array_push($errors, "File is already exist. Name:- ". $file_name);
                $uploadThisFile = false;
            }

            if($uploadThisFile) {
                $filename = basename($file_name,$ext);
                $newFileName = $filename.$ext;
                $path = "resources/images/".$newFileName;
                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $path);
                image::insert($itemId, $filename, $serialNumber, $path);			
            }
            $serialNumber++;

	}
        $count = count($errors);
        if($count != 0){
            foreach($errors as $error) {echo $error."<br/>";}
	}
    }
    
    public static function addItem() {
        if(isset($_POST['itemName'])){
            $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
            $itemPrice = filter_input(INPUT_POST, 'itemPrice', FILTER_SANITIZE_NUMBER_FLOAT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            try{
                $itemId = item::insert2($itemName, $itemPrice, $description, $_POST['activated']);
                ItemController::addImage($itemId);
            } catch (Exception $ex) {
                print_r("EXEPCTION IN ADDITEM");
                print_r($ex);
            }
        }
        else{
            echo ViewHelper::render("view/itemAdd.view.php");
        }
    }
    
    public static function editItem() {
        if(isset($_POST['itemName'])){
            $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
            $itemPrice = filter_input(INPUT_POST, 'itemPrice', FILTER_SANITIZE_NUMBER_FLOAT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            try{
                item::update($_POST['itemId'], $itemName, $itemPrice, $description, $_POST['activated']);
                ItemController::addImage($_POST['itemId']);
            } catch (Exception $ex) {
              print_r($ex);
            }
        }
    }
    
    public static function saveCart(){
        session_start();
        //print_r("saving cart");
        //print_r($_POST);
        //print_r($_SESSION['userId']);
        //$array = json_decode($_POST['cart']);
        cart::removeAllItems($_SESSION['userId']);
        foreach($_POST as $itemId => $quantity){
            //print_r($itemId);
            //print_r($quantity);
            cart::insert($_SESSION['userId'], $itemId, $quantity);
        }
    }
    
    public static function emptyCart(){
        session_start();
        cart::removeAllItems($_SESSION['userId']);
    }
    
    public static function itemDetails(){
        $item = item::get2($_GET['itemId']);
        $images = image::getAllForItem($_GET['itemId']);
        $data = ["item"=> $item, "images" => $images];
        //var_dump($data);
        echo ViewHelper::render("view/item.view.php", $data);
    }
     
}
