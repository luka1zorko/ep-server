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
                <input type="text" class="form-control" name="itemName">
            </div>
        </div>
        <!--Item price-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Price</label>
            <div class="input-group col-sm-10">
                <input type="text" class="form-control" name="itemPrice">
            </div>
        </div>
        <!--Item description-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="input-group col-sm-10">
                <textarea id="textarea" class="form-control" name="description"></textarea>
            </div>
        </div>
        <!--Images-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="input-group col-sm-10">
                <input type="file" id="images" name="files[]" multiple="multiple">
                <p class="help-block"><span class="label label-info">Note:</span> Please, Select the only images (.jpg, .jpeg, .png, .gif) to upload with the size of 100KB only.</p>
            </div>
        </div>
    </fieldset>
    <div class="offset-md-6 col-md-2">
        <button id="saveItemButton" class="btn btn-primary btn-block" type="button">Save</button>
    </div>
    </form>
</div>