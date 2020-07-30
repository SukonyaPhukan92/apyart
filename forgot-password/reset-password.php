<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<style>
        body, html{
            height: 100%;
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
<nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"><i class="fa fa-bars"></i></label>
        <label class="logo">ApyArt</label>
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../artwork.php">Artwork</a></li>
          <li><a href="../artist.php">Artist</a></li>
          <li><a href="../collection.php">Collection</a></li>
          <li><a href="../about.php">About us</a></li>
          <li><a href="../contact.php">Contact us</a></li>
		  <li><a href='../login.php' class='login-btn'>Login</a></li>
		  <li><a href='../register.php' class='join-btn'>Register</a></li>
</ul>
</nav>
<header>
<div class="login-form">
<p class="login-text">Reset password</p>

<?php
include('../database/db.php');
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($con,"
SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
if ($row==""){
$error .= '<p class="form-error-msg">The Link is Invalid or expired</p>
<p><a href="https://digitalyashwant.tech/apyart/forgot-password/index.php">Click here</a> to reset password.</p>';
	}else{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
	?>
	<form method="post" action="" name="update">
	<input type="hidden" name="action" value="update" />
	<input type="password" name="pass1" id="pass1" maxlength="15" placeholder="Enter new Password" required />
	<input type="password" name="pass2" id="pass2" maxlength="15" placeholder="Re - Enter Password" required/>
	<input type="hidden" name="email" value="<?php echo $email;?>"/>
	<input type="submit" id="reset" value="Reset Password" />
	</form>
<?php
}else{
$error .= "<p class='form-error-msg'Link has been Expired</p>'";
				}
		}
if($error!=""){
	echo "<p class='form-error-msg'>".$error."</p>";
	}			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
		$error .= "<p class='form-error-msg'>Password does not match</p>";
		}
	if($error!=""){
		echo "<p class='form-error-msg'>".$error."</p>";
		}else{

$pass1 = md5($pass1);
mysqli_query($con,
"UPDATE `users` SET `password`='".$pass1."' WHERE `email`='".$email."';");	

mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
	
echo '<p class="form-sucess-msg"><p>Congratulations! Your password has been Changed successfully.</p>
<p>Click here<a href="../login.php">Login</a>';
		}		
}
?>
</div>
</header>
</body>
</html>