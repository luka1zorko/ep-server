<?php

session_start();

require_once 'utils.php';
require_once 'db/address.php';
require_once 'db/item.php';
require_once 'db/rating.php';
require_once 'db/user.php';


$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$validationRules = ['do' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            "regexp" => "/^(add_into_cart|update_cart|purge_cart)$/"
        ]
    ],
    'id' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ],
    'quantity' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ]
];
$data = filter_input_array(INPUT_POST, $validationRules);

switch ($data["do"]) {
    case "add_into_cart":
        try {
            $item = item::get($data["id"]);

            if (isset($_SESSION["cart"][$item["Item_Id"]])) {
                $_SESSION["cart"][$item["Item_Id"]] ++;
            } else {
                $_SESSION["cart"][$item["Item_Id"]] = 1;
            }
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
        break;
    case "update_cart":
        if (isset($_SESSION["cart"][$data["id"]])) {
            if ($data["quantity"] > 0) {
                $_SESSION["cart"][$data["id"]] = $data["quantity"];
            } else {
                unset($_SESSION["cart"][$data["id"]]);
            }
        }
        break;
    case "purge_cart":
        unset($_SESSION["cart"]);
        break;
    default:
        break;
}

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Store</title>
    </head>
    <body>
        <a href="signUp.php">SignUp</a>
        
        <?php if (!Utils::isLoggedIn()): ?>
            <p><a href="signIn.php">Login</a></p>
        <?php else: ?>
            <p><a href="signIn.php?logout">Odjava</a></p>
        <?php endif; ?>
        
            
        <div id="main">
            <?php foreach (item::getAll() as $item): ?>
                <div class="item">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id" value="<?= $item["Item_Id"] ?>" />
                        <p><?= $item["Item_Name"] ?></p>
                        <p><?= number_format($item["Item_Price"], 2) ?> EUR<br/>
                        <button type="submit">Add to cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        
        
        <div class="cart">
            <h3>Cart</h3>

            <?php
            $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

            if ($cart):
                $price = 0;

                foreach ($cart as $id => $quantity):
                    $item = item::get($id);
                    $price += $item["Item_Price"] * $quantity;
                    ?>
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="update_cart" />
                        <input type="hidden" name="id" value="<?= $item["Item_Id"] ?>" />
                        <input type="number" name="quantity" value="<?= $quantity ?>" class="short_input" />
                        &times; <?=
                        (strlen($item["Item_Name"]) < 30) ?
                                $item["Item_Name"] :
                                substr($item["Item_Name"], 0, 26) . " ..."
                        ?> 
                        <button type="submit">Update</button> 
                    </form>
                <?php endforeach; ?>

                <p>Total: <b><?= number_format($price, 2) ?> EUR</b></p>

                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="purge_cart" />
                    <input type="submit" value="Empty cart" />
                </form>
            <?php else: ?>
                Cart is empty.                
            <?php endif; ?>
        </div>
        
    </body>
</html>
