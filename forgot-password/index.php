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
<body>
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
include "../database/db.php";
$error ="";
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
  	$error .="<p class='form-error-msg'>Please enter a valid email address</p>";
	}else{
	$sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
	if ($row==""){
		$error .= "<p class='form-error-msg'>No user is registered with this email address</p>";
		}
	}
	if($error!=""){
	echo "<p class='form-error-msg'>".$error."</p>
	<br /><a href='javascript:history.go(-1)'>Retry</a>";
		}else{
	$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
	$expDate = date("Y-m-d H:i:s",$expFormat);
	$key = md5(2418*2+$email);
	$addKey = substr(md5(uniqid(rand(),1)),3,10);
	$key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://digitalyashwant.tech/apyart/forgot-password/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">https://digitalyashwant.tech/apyart/forgot-password/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Make sure to copy the whole code. The link will be expired in 24 Hour for security reasons</p>';
$output.='<p>If you did not requested this feel free to ignore this email.</p>';   	
$output.='<p>Thanks</p>';
$output.='<p>Apyart Team</p>';
$body = $output; 
$subject = "Password Recovery - Apyart";

$email_to = $email;
$fromserver = "Your email"; 
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "Host name"; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "Your email"; // Enter your email here
$mail->Password = "Password"; //Enter your passwrod here
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = "Your name";
$mail->FromName = "Apyart";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<p class='form-sucess-msg'>Password Reset link has been sent to your email</p>";
	}
	}	
}else{
?>
<form method="post" action="" name="reset">
<input type="email" name="email" placeholder="username@email.com" />
<input type="submit" value="Reset"/>
</form>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
</div>
</header>
</body>
</html>