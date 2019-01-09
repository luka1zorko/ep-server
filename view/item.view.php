<?php
    require_once("view/navbar.php");
    require_once("db/cart.php");

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
if(isset($_SESSION['userId'])){
    $cart = cart::getAllItems($_SESSION['userId']);
    //var_dump($cart);
    foreach ($cart as $value)
        $_SESSION["cart"][$value['Item_Id']] = $value['Quantity'];
}

switch ($data["do"]) {
    case "add_into_cart":
        try {
            $item = item::get2($data["id"]);

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

<div id="main">
    <div class="row">
        <div class="col-lg-6">
          <h2 class="my-4"><?php echo $variables['item']['Item_Name']?></h2>
          <div class="list-group">
              <img>    
          </div>
        </div>
        <div class="col-lg-6" style="margin-top:60px">
          <div class="card mt-4">
            <div class="card-body">
              <h4 class="card-title"><?php echo $variables['item']['Item_Name']?></h4>
              <p class="card-text"><?php echo $variables['item']['Item_Description']?>
              <h4><?php echo $variables['item']['Item_Price']?>€</h4>
            </div>
          </div>
          <button class="btn btn-lg btn-danger btn-block" type="submit">
              <i class="fas fa-shopping-cart"></i>Add to cart
          </button>
        </div>
    </div>
</div>
        <div class="cart">
    <h3>Cart</h3>

    <?php
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

    if ($cart):
        $price = 0;

        foreach ($cart as $id => $quantity):
            $item = item::get2($id);
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
        <button class="btn btn-secondary" type="submit">Update</button> 
        </form>
        <?php endforeach; ?>

                <p>Total: <b><?= number_format($price, 2) ?> EUR</b></p>
                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="purge_cart" />
                    <?php if (isset($_SESSION['userId'])): ?>
                    <button id="saveCartButton" class="btn btn-primary btn-block" type="button">Save</button>
                    <?php endif ?>  
                    <button id="emptyCartButton" class="btn btn-danger btn-block" type="submit">Empty cart</button>
                </form>
            <?php else: ?>
                Cart is empty.                
            <?php endif; ?>
        </div>

<script src="../js/itemDetails.js"></script>
<script>
    var BASE_URL = "<?php echo BASE_URL ?>";
    var images = <?php echo json_encode($variables['images'])?>;
    console.log(images);
</script>