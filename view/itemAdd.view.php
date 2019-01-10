<?php
require_once("view/navbar.php")
?>
<script src="../js/itemAdd.js"></script>
<script>
    var itemId = "<?php echo (isset($_GET['itemId']) ? $_GET['itemId'] : 0)?>";
    var BASE_URL = "<?php echo BASE_URL ?>";
</script>
<div class="container">
    <div align="center">
        <h3 id="heading"></h3>
    </div>
    <form id="addItemForm">
    <fieldset>
        <!--Item name-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="input-group col-sm-10">
                <input type="text" class="form-control" name="itemName" value="<?php if(isset($variables['Item_Name'])) echo $variables['Item_Name']?>">
            </div>
        </div>
        <!--Item price-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Price</label>
            <div class="input-group col-sm-10">
                <input type="text" class="form-control" name="itemPrice" value="<?php if(isset($variables['Item_Price'])) echo $variables['Item_Price']?>">
            </div>
        </div>
        <!--Item description-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="input-group col-sm-10">
                <textarea id="textarea" class="form-control" name="description"><?php if(isset($variables['Item_Description'])) echo $variables['Item_Description']?></textarea>
            </div>
        </div>
    </fieldset>
    <div class="offset-md-6 col-md-2">
        <button id="saveItemButton" class="btn btn-primary btn-block" type="button">Save</button>
    </div>
    </form>
</div>