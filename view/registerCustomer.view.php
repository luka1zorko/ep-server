<?php
    require_once("view/navbar.php")
?> 
<div style="margin-bottom:10%"></div>
<form class="text-center" action="<?= BASE_URL . "registerCustomer" ?>" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Register customer</h1>
    <!--USERNAME PASSWORD-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    </div>
    </div>
    </div>
    <!--NAME-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="First name" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="Last name" required>
    </div>
    </div>
    </div>
    <!--POSTAL CODE, CITY-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputPostalCode" name="postalCode" class="form-control" placeholder="Postal code" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="text" id="inputCity" name="city" class="form-control" placeholder="City" required>
    </div>
    </div>
    </div>
    <!--ADDRESS PHONE NUMBER-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputStreet" name="street" class="form-control" placeholder="Street" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="text" id="inputHouseNumber" name="houseNumber" class="form-control" placeholder="House number" required>
    </div>
    </div>
    </div>
    <!--EMAIl-->
    <div class="row">    
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputPhoneNumber" name="phoneNumber" class="form-control" placeholder="Phone Number" required>
    </div>
    </div>
    <div class="col-md-3 col">    
    <div class="input-group mb-3">
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
    </div>
    </div>
    </div>
    <!--BUTTON-->
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </div>
    </div>
</form>