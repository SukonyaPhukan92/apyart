<?php
include "admin-auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel - Apyart</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/admin-style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .content{
            display: flex;
    align-items: center;
    justify-content: center;
        }
        </style>
</head>
<body>
<?php include "sidebar.php"?>
<div class="content">
    <?php
if (isset($_POST['submit'])) {
    $password = md5($_POST['password']);

$query ="UPDATE admin_users SET password='$password' WHERE username = '" . $_SESSION['admin_username'] . "'";

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
            <input type="password" name="password" id="newPassword" placeholder="New Password" required>
            <input type="password" name="password" id="confirmPassword" placeholder="Confirm Password" required>
            <input type="submit" id="btnSubmit" name="submit" value="CHANGE PASSWORD">
            </form>
        </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="../js/password-confirm.js"></script>
</body>
</html>