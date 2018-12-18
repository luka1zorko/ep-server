<?php
require_once 'db/user.php';
include 'layout.php';
session_start();
$failedAttempt = false;

if (isset($_POST["username"]) && isset($_POST["password"])) {
    try {
        if (user::login($_POST["username"], $_POST["password"])) {
            session_regenerate_id(true);
            $_SESSION["logged_in"] = true;
            header("Location: index.php");
        } else {
            $failedAttempt = true;
        }
    } catch (Exception $exc) {
        echo $exc->getMessage();
        exit(-1);
    }
} elseif (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
}
?>

<div style="margin-bottom:10%"></div>    
<form class="form-signin text-center", action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <h1 class="h3 mb-3">Please sign in</h1>
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-user"></i>
          </span>
      </div>
      <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
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
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="offset-md-4 col-md-4">
    <?php
    if ($failedAttempt) {
        echo "<p><b>Napačno uporabniško ime in geslo.</b></p>";
    }
    ?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </div>
    </div>
</form>

