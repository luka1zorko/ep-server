<!DOCTYPE html>
<meta charset="UTF-8" />
<title>Library</title>


<?php if (!Utils::isLoggedIn()): ?>
    <p><a href="<?= BASE_URL . "signin" ?>">LogIn</a></p>
<?php else: ?>
    <p><a href="<?= BASE_URL . "items"?>">Logout</a></p>
<?php endif; ?>


<h1>All items</h1>

<ul>

    <?php foreach ($items as $item): ?>
        <li><a href="<?= BASE_URL . "item/" . $item["Item_Id"] ?>"> <?= $item["Item_Name"] ?> (<?= $item["Item_Price"] ?> EUR)</a></li>
    <?php endforeach; ?>

</ul>
