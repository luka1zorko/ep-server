<?php
    include 'layout.php';
?> 
<div style="margin-bottom:10%"></div>   
<form class="text-center">
    <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
    <!--USERNAME PASSWORD-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>
    </div>
    </div>
    <!--NAME-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputFirstName" class="form-control" placeholder="First name" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="password" id="inputLastName" class="form-control" placeholder="Last name" required>
    </div>
    </div>
    </div>
    <!--POSTAL CODE, CITY-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputPostalCode" class="form-control" placeholder="Postal code" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="password" id="inputCity" class="form-control" placeholder="City" required>
    </div>
    </div>
    </div>
    <!--ADDRESS PHONE NUMBER-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="text" id="inputAddress" class="form-control" placeholder="Address" required>
    </div>
    </div>
    <div class="col-md-3 col">
    <div class="input-group mb-3">
        <input type="password" id="inputPhoneNumber" class="form-control" placeholder="Phone Number" required>
    </div>
    </div>
    </div>
    <!--EMAIl-->
    <div class="row">
    <div class="offset-md-3 col-md-3 col">
    <div class="input-group mb-3">
      <input type="email" id="inputEmail" class="form-control" placeholder="Email" required>
    </div>
    </div>
    </div>
    <!--BUTTON-->
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </div>
    </div>
</form>

<!--ime priimek email 
address phone number password-->