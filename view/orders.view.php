<?php
require_once("view/navbar.php")
?>
<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <?php foreach ($variables as $receipt): ?>  
      <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
          <span>Receipt ID: <span><?php echo $receipt['Receipt_Id']?></span></span><br>
          <span>Status: <span><?php if ($receipt['Status_Id'] == 1) {echo "Submitted";} elseif($receipt['Status_Id'] == 2) {echo "Confirmed";} else {echo "Canceled";}?></span></span>
          <?php if($_SESSION['userRole'] != 3): ?>
          <br>
          <span>Customer ID: <span><?php echo $receipt['Customer_User_Id'] ?></span></span>
          <?php endif ?>
          <?php if (isset($receipt['Salesman_User_Id'])): ?>
          <br>
          <span>Salesman ID: <span><?php echo $receipt['Salesman_User_Id'] ?></span></span>
          <?php elseif ($_SESSION['userRole'] < 3):?>
          <br>
          <button class="btn btn-success confirmOrder">Confirm</button>
          <button class="btn btn-danger cancelOrder">Cancel</button>
          <?php endif ?>
          
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
          <div id="orderItems">
          </div>
      </div>
    </div>
  </div>
</div>
<script>
    var BASE_URL = "<?php echo BASE_URL ?>";
</script>
<script src ="../js/orders.js"></script>
