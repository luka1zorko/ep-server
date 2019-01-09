<?php
require_once("view/navbar.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout</title>
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <h2>Checkout</h2>
      </div>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
              </div>
              <span class="text-muted">$12</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
              </div>
              <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
              </div>
              <span class="text-muted">$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>$20</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Shipping information</h4>
          <form>
            <!--First name, Last name-->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="abc" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" disabled>
              </div>
            </div>
            <!--Email, Phone number--> 
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="abc" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phoneNumber">Phone number</label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="" disabled>
              </div>
            </div>
            <!--Postal code, City-->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="postalCode">Postal code</label>
                <input type="text" class="form-control" id="postalCode" placeholder="abc" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="" disabled>
              </div>
            </div>
            <!--Street, House number-->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="street">Street</label>
                <input type="text" class="form-control" id="street" placeholder="abc" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="houseNumber">House number</label>
                <input type="text" class="form-control" id="houseNumber" placeholder="" disabled>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit order</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
