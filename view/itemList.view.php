<?php
require_once("view/navbar.php")
?>
<script type="text/javascript">
    var BASE_URL = "<?php echo BASE_URL ?>";
    var role = "<?php echo $_SESSION['userRole']?>";
</script>
<script src="../js/itemList.js"></script>
<div class="row">
  <div class="col-md-2"></div>
  <div align="center"  class="col-md-8">
    <h3>Items</h3>
    <br><br>
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item ID</th>
      <th scope="col">Item</th>
      <th scope="col">Price</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="dynamicTable">
  </tbody>
</table>
    
    <div class="offset-md-4 col-md-4">
        <button id="addItemButton" class="btn btn-primary btn-block" type="button">Add item</button>
    </div>
    </div>
  </div>
</div>

