<?php
session_start();
if(!isset($_SESSION["email"])){
  echo "<script type='text/javascript'>window.location='login.php';</script> ";
}
include "database/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        header{
            height:700px;
        }
    </style>
</head>
<body>
    <?php include "includes/nav.php" ?>
    <header>
    <?php
if (isset($_POST['submit'])) {
    $password = md5($_POST['password']);

$query ="UPDATE users SET password='$password' WHERE email = '" . $_SESSION['email'] . "'";

	if ($con->query($query)) {
		$msg = "Password Updated successfully";
	}else{
		$msg = "Something went wrong".$con->error;
	}
}
?>
            <div class="login-form">
            <p class="login-text">Change password</p>    
            <form name="chngpwd" action="" method="post" onSubmit="return valid();">
            <p class="form-error-msg"><?php if(isset($msg)) { echo $msg; } ?></p>
           <input type="password" name='password' placeholder="Password" id="password" required>
            <input type="password" placeholder="Confirm Password" id="confirm_password" required>
            <input type="submit" id="btnSubmit" name="submit" value="CHANGE PASSWORD">
            </form>
        </div>
    </header>
<script src="js/password-confirm.js"></script>
</body>
</html>