<?php
    include 'navbar.view.php';
?> 
<div style="margin-bottom:10%"></div>    
<form class="form-signin text-center">
    <h1 class="h3 mb-3">Please sign in</h1>
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-user"></i>
          </span>
      </div>
      <input type="text" class="form-control" placeholder="Username" required autofocus>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-lock"></i>
          </span>
      </div>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </div>
    </div>
</form>

