<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Apyart</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/admin-style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{
            display: flex;
    align-items: center;
    justify-content: center;
        }
        </style>
</head>
<body>
    <main>
        <div class="login-form">
            <p class="login-text">Admin Login</p>
            <?php
	require('../database/db.php');
	session_start();
    if (isset($_POST['username'])){
		
		$username = stripslashes($_POST['username']); 
		$username = mysqli_real_escape_string($con,$username); 
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
        $query = "SELECT * FROM `admin_users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['admin_username'] = $username;
			echo "<script type='text/javascript'>window.location='index.php';</script> ";
            }else{
				$msg = "Username or Password is incorrect";
				}
    }
?>
            <form action="" method="POST">
            <p class="form-error-msg"><?php if(isset($msg)){ echo $msg;} ?></p>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="LOGIN">
            </form>
        </div>
</main>
</body>
</html>