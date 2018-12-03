<?php
require_once 'database_store.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Store</title>
    </head>
    <body>
        <h1>All items</h1>
        <?php
        try {
            $all_items = DBJokes::getAll();
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
