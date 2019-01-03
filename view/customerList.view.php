<?php
require_once("view/navbar.php")
?>
<script type="text/javascript">
    var BASE_URL = "<?php echo BASE_URL ?>";
    var role = "<?php echo $_SESSION['userRole']?>";
    var userId = "<?php echo $_SESSION['userId']?>";
</script>
<script src="../js/customerList.js"></script>
<div class="row">
  <div class="col-md-2"></div>
  <div align="center"  class="col-md-8">
    <h3>Customers</h3>
    <br><br>
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Role</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="dynamicTable">
  </tbody>
</table>
    </div>
  </div>
</div>

