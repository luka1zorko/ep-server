<?php
require_once("view/navbar.php")
?>
<script type="text/javascript">
    var BASE_URL = "<?php echo BASE_URL ?>";
</script>
<script src="../js/customerList.js"></script>
<div class="row">
  <div class="col-md-2"></div>
  <div align="center"  class="col-md-8">
    <h3>Customers</h3>
    <br><br>
<div class="row">
<table class="table table-hover" id="dynamicTable">
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
  <tbody>
    <tr>
      <td>1</td>
      <td>username</td>
      <td>first</td>
      <td>last</td>
      <td>Customer</td>
      <td>
      <button type="button" class="btn btn-xs btn-primary">Activate</button>
      <button type="button" class="btn btn-xs btn-danger">Deactivate</button>
      </td>
    </tr>
    <tr>
      <td>2</th>
      <td>Jacob</td>
      <td>Mark</td>
      <td>Thornton</td>
      <td>salesman</td>
      <td>
        <button type="button" class="btn btn-xs btn-primary">Activate</button>
        <button type="button" class="btn btn-xs btn-danger">Deactivate</button>
      </td>
    </tr>
  </tbody>
</table>
    </div>
  </div>
</div>

