<?php session_start();
if(!isset($_SESSION["email"])){
    // echo "login not done";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<?php include "includes/nav.php" ?>
    <div class="page-header">
    </div>
    <div class="rowa">
    <div class="columna">
      <h2>Need help?</h2>
      <p>You can contact us anytime. we usually respond in 24 hours</p>
      <p class="sub-title">ApyArt<br>Patna, Bihar<br>India<br><a class="mail" href="mailto:contact@apyart.com">contact@apyart.com</a></p>
      <p class="sub-title">Social Links</p>
      <div class="social-box">
        <a href="#" class="fa fa-instagram social-links"></a>
        <a href="#" class="fa fa-youtube social-links"></a>
        <a href="#" class="fa fa-linkedin social-links"></a>
      </div>
      </div>
    <div class="columna" style="background-color: white;">
      <h2>Quick Contact</h2>
<?php
if(isset($_POST['submit'])){
$name = $_POST['name'];
$email = $_POST['email'];
$sub = $_POST['subject'];
$message = $_POST['msg'];
$formcontent="From: $name \n Email: $email \n Subject: $sub \n Message: $message \n";
$recipient = "yashwantkumar751@gmail.com";
$subject = $sub;
$mailheader = "From: $email \r\n";
$sendmail = (mail($recipient, $subject, $formcontent, $mailheader) or die("Error!"));
if (!$sendmail){
    echo "Something went wrong";
}else{
   echo "Thank you we will get back to you soon"; 
}

}
?>
        <form method="POST" action="">
          <input type="text" name="name" id="name" maxlength="100" placeholder="Full name" required>
          <input type="email" name="email" id="email" maxlength="100" placeholder="Email" required>
          <input type="text" name="subject" maxlength="50" id="subject" placeholder="Subject" required>
          <textarea type="text" name="msg" placeholder="Message (Max - 200 chr)"  maxlength="200" required></textarea>
          <input type="submit" name="submit" value="SEND" class="quote-btn">
        </form>
    </div>
  </div>
</div>
</div>
<?php include "includes/footer.php" ?>
</body>
</html>