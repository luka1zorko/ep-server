<?php

session_start();

require_once 'utils.php';
require_once 'db/address.php';
require_once 'db/item.php';
require_once 'db/rating.php';
require_once 'db/user.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Store</title>
    </head>
    <body>
        <a href="signIn.php">link</a>
        
        <?php if (!Utils::isLoggedIn()): ?>
            <p><a href="signIn.php">Prijava</a></p>
        <?php else: ?>
            <p><a href="signIn.php?logout">Odjava</a></p>
        <?php endif; ?>
        
        
        
        <h1>All items</h1>
        <?php
        try {
            $all_items = item::getAll();
        } catch (Exception $e) {
            echo "Prišlo je do napake: {$e->getMessage()}";
        }
        foreach ($all_items as $num => $row) {
            $name = $row["Item_Name"];
            $price = $row["Item_Price"];
            echo "<p><b>$name</b>:$price</p>\n";
        }
        ?>
        
    </body>
</html>
