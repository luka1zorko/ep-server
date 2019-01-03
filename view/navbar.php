<!DOCTYPE>
<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
        <title></title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="<?= BASE_URL . "items" ?>">Store</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--All-->
                <li style="display:<?php echo isset($_SESSION['userRole']) ? 'block':'none' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "profile" ?>"><span class="fas fa-user"></span>&nbsp;Profile</a>
                </li>
                <!--Customer-->
                <li style="display:<?php echo isset($_SESSION['userRole']) && $_SESSION['userRole'] == 3 ? 'block':'none' ?>">
                    <a class="nav-link" href=""><span class="fas fa-shopping-cart"></span>&nbsp;Cart</a>
                </li>
                <!--Customer-->
                <li>
                    <a class="nav-link" href=""><span class="far fa-list-alt"></span>&nbsp;My Orders</a>
                </li>
                <!--Customer-->
                <li style="display:<?php echo isset($_SESSION['userRole']) ? 'none':'block' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "signupRedirect" ?>"><span class=""></span>&nbsp;Sign up</a>
                </li>
                <!--All-->
                <li style="display:<?php echo isset($_SESSION['userRole']) ? 'none':'block' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "signin" ?>">
                        <span class="fas fa-sign-in-alt"></span>&nbsp;Sign In
                    </a>
                </li>
                <!--All-->
                <li style="display:<?php echo isset($_SESSION['userRole']) ? 'block':'none' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "signout" ?>">
                        <span class="fas fa-sign-out-alt"></span>&nbsp;Sign Out
                    </a>
                </li>
                <!--Admin-->
                <li style="display:<?php echo isset($_SESSION['userRole']) && $_SESSION['userRole'] == 1 ? 'block':'none' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "registerSalesman" ?>"><span class="fas fa-user-plus"></span>&nbsp;Register Salesman</a>
                </li>
                <!--Salesman-->
                <li>
                    <a class="nav-link" href=""><span class="far fa-list-alt"></span>&nbsp;Orders</a>
                </li>
                <!--Salesman-->
                <li style="display:<?php echo isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 1 || $_SESSION['userRole'] == 2) ? 'block':'none' ?>">
                    <a class="nav-link" href=""><span class="fas fa-cart-plus"></span>&nbsp;Items</a>
                </li>
                <!--Salesman-->
                <li style="display:<?php echo isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 1 || $_SESSION['userRole'] == 2) ? 'block':'none' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "customerListRedirect" ?>"><span class="fas fa-users"></span>&nbsp;Customers</a>
                </li>
            </ul>
          </div>
        </nav>
    </body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
