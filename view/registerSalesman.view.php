<?php
    require_once("view/navbar.php")
?> 
<div style="margin-bottom:10%"></div>
<form class="text-center" action="<?= BASE_URL . "registerSalesman" ?>" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Register salesman</h1>
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
    <!--EMAIl-->
    <div class="row">    
    <div class="offset-md-3 col-md-3 col">
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