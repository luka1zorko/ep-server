<?php
require_once("view/navbar.php")
?>
<div class="container">
    <form action="<?= BASE_URL . "profile/updatePersonalInformation?userId=" . $_GET['userId'] . "&role=" . $_GET['role'] ?>" method="post">
    <!--first name, last name, city, postal code, address-->
    <fieldset>
        <legend>Personal information</legend>
        <!--First name-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">First name</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="firstName" placeholder="<?php echo $variables['User_First_Name'];?>">
            </div>
        </div>
        <!--Last name-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Last name</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="lastName" placeholder="<?php echo $variables['User_Last_Name'];?>">
            </div>
        </div>
        <!--Phone number-->
        <div class="form-group row" style="display:<?php echo $_SESSION['userRole'] == 3 ? '':'none' ?>">
            <label class="col-sm-2 col-form-label">Phone number</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="phoneNumber" placeholder="<?php echo $variables['User_Phone_Number'];?>">
            </div>
        </div>
        <!--Username-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Username</label>
            <div class="input-group col-sm-10">
                <input type="text" class="form-control" name="username" readonly placeholder="<?php echo $variables['Username'];?>">
            </div>
        </div>
        <!--email-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="email" placeholder="<?php echo $variables['User_Email'];?>">
            </div>
        </div>
    </fieldset>
    <div class="offset-md-6 col-md-2">
        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </div>
    </form>
    <form style="display:<?php echo isset($variables['Postal_Code']) ? 'block':'none' ?>" action="<?= BASE_URL . "profile/updateAddress?userId=" . $_GET['userId'] . "&role=" . $_GET['role']?>" method="post">
    <fieldset>
        <legend>Address information</legend>
        <!--Postal code-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Postal code</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="postalCode" placeholder="<?php echo $variables['Postal_Code'];?>">
            </div>
        </div>
        <!--City-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="city" placeholder="<?php echo $variables['City'];?>">
            </div>
        </div>
        <!--Street-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Street</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="street" placeholder="<?php echo $variables['Street'];?>">
            </div>
        </div>
        <!--Street number-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">House number</label>
            <div class="input-group col-sm-10">
            <input type="text" class="form-control" name="houseNumber" placeholder="<?php echo $variables['House_Number'] . ($variables['House_Number_Addon']== null ? ' ' : $variables['House_Number_Addon']);?>">
            </div>
        </div>
    </fieldset>
    <div class="offset-md-6 col-md-2">
        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </div>    
    </form>
    <form action="<?= BASE_URL . "profile/updatePassword?userId=" . $_GET['userId']?>" method="post">
    <fieldset>
        <legend>Password</legend>
        <!--Current password-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Current password</label>
            <div class="col-sm-10">
                <input type="password" name="currentPassword" class="form-control" required="">
            </div>
        </div>
        <!--New password-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">New password</label>
            <div class="col-sm-10">
                <input type="password" name="newPassword" class="form-control" required>
            </div>
        </div>
        <!--Repeat password-->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Repeat password</label>
            <div class="col-sm-10">
                <input type="password" name="repeatPassword" class="form-control" required>
            </div>
        </div>
    </fieldset>
    <div class="offset-md-6 col-md-2">
        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </div>
</form>
</div>