<?php
session_start();
if(!isset($_SESSION["email"])){
    echo "<script type='text/javascript'>window.location='login.php';</script> ";
}
include "database/db.php";
include "artist-only.php";
?>
<?php
$sql = "SELECT * FROM artist  WHERE email = '" . $_SESSION['email'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$artist_id=$row['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php include "includes/nav.php" ?>

    <div class="page-header">
    </div>

<div class="artist-container">
    <div class="artist-cards">
<?php 
require "database/db.php";
$get = mysqli_query($con,"SELECT * FROM artistmsg WHERE artist_id = '$artist_id' ORDER BY id DESC LIMIT 7");
$count=mysqli_num_rows($get);
if($count>=1){
while ($con=mysqli_fetch_array($get)) {
    $msg_id = $con['id'];
    $email = $con['email'];
    $mobile = $con['mobile'];
    $sub = $con['sub'];
    $msg = $con['msg'];
    echo "<div class='artist-card'>";
    echo "<h4 class='sub'>".$sub."</h4>";
    echo "<h5 class='contact-d'><i class='fa fa-envelope-o' aria-hidden='true'></i> ".$email."<br><i class='fa fa-phone' aria-hidden='true'></i> ".$mobile."</h5>";
    echo "<div class='artist-bio'>";
    echo "<p>".$msg."</p>";
    echo "</div>";
    echo "<a href='mailto:$email' class='artist-btn'>Reply</a>";
    echo "</div>";
}
}else{
    $status = "No new message";
}
?>  
</div>
</div>
<div class='status-box'><p><?php if(isset($status)){ echo $status;} ?></p></div>
</body>
</html>