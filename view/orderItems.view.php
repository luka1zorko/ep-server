<div class="row">
<div class="col-md-2"></div>
<div align="center"  class="col-md-8">
    <h3>Items</h3>
    <br>
<div class="row">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item ID</th>
      <th scope="col">Item</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody id="dynamicTable">
      <?php foreach ($variables as $index => $item): ?>
      <tr>
          <td><?php echo ($index + 1)?></td>
          <td><?php echo $item['Item_Id'] ?></td>
          <td><?php echo $item['Item_Name'] ?></td>
          <td><?php echo $item['Item_Price'] ?>€</td>
      </tr>
      <?php endforeach ?>
  </tbody>
</table>
</div>
</div>
</div>

