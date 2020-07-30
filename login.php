<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- google oauth -->
    <meta name="google-signin-client_id" content="1038680536927-m3l8mhgcvte548pes835tij0ml6i6dsf.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script>
        function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  window.location.href = "https://digitalyashwant.tech/apyart/google-login.php?email="+profile.getEmail()+"&name="+profile.getName()+"&profilepic="+profile.getImageUrl();
}
</script>
    <style>
    body, html{
            height: 100%;
        }
        header{
            height:700px;
        }
        
        header{
            height:700px;
        }
        @media(max-width:800px){
            header{
                background-position: center;
                background-size: cover;
                height: 100%;
            }
        }
    </style>
</head>
<body>
<?php include "includes/nav.php" ?>
    <header>
        <div class="login-form">
            <p class="login-text">Login</p>
            <?php
	require('database/db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['email'])){
		
		$email = stripslashes($_POST['email']); // removes backslashes
		$email = mysqli_real_escape_string($con,$email); //escapes special characters in a string
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE email='$email' and password='".md5($password)."' and status =1";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
            $fetch_id = mysqli_fetch_assoc($result);
            $_SESSION['login_user'] = $fetch_id['id'];
			$_SESSION['email'] = $email;
			$_SESSION['login_type'] = 2;
			echo "<script type='text/javascript'>window.location='index.php';</script> ";// Redirect user to index.php
            }else{
				$msg = "E-mail or Password is incorrect";
				}
    }
?>
<div class="social-login" >
<div class="g-signin2" data-onsuccess="onSignIn" data-width="300" data-height="40"  data-longtitle='true'>-</div>
</div>
<h3><span>OR</span></h3>
            <form action="" method="POST">
            <p class="form-error-msg"><?php if(isset($msg)){ echo $msg;} ?></p>
            <label for="input-label">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" required>
            <label for="input-label">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="LOGIN">
            <div class="lower-form-options">
                <!--<div>-->
                <!--<input type="checkbox" name="reme" id="" checked>-->
                <!--<label for="rememberme">Remember me</label>-->
                <!--</div>-->
                <a href="forgot-password">Forgot password?</a>
            </div>
            </form>
            <hr>
            <p class="form-lower-text"><a href="register.php">Not yet registered? Register now</a></p>
        </div>
    </header>

</body>
</html>