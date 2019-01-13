<script>var totalPrice = 0;
$(document).ready(function(){
    $("#totalPrice").html(totalPrice + "€");
});
</script>
<div class="row">
<div class="col-md-2"></div>
<div align="center"  class="col-md-11">
    <h3>Items</h3>
    <br>
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item ID</th>
      <th scope="col">Item</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody id="dynamicTable">
      <?php foreach ($variables['items'] as $index => $item): ?>
      <tr>
          <td><?php echo ($index + 1)?></td>
          <td><?php echo $item['Item_Id'] ?></td>
          <td><?php echo $item['Item_Name'] ?></td>
          <td><?php echo $item['Item_Price'] ?>€</td>
          <td><?php echo $variables['quantities'][$item['Item_Id']] ?></td>
          <script>totalPrice += <?php echo $variables['quantities'][$item['Item_Id']] ?> * <?php echo $item['Item_Price'] ?></script>
      </tr>
      <?php endforeach ?>
            <tr><th>Total Price: </th><td id="totalPrice"></td></tr>
  </tbody>
</table>
</div>
</div>
</div>

