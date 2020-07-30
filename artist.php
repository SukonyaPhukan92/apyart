<?php 
session_start();
include "database/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist | ApyArt - Free stock images and illustartion</title>
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
include "database/db.php";
$get = mysqli_query($con,"SELECT users.profilepic, artist.id, artist.email, artist.name, artist.bio , socialmedia.email, socialmedia.fb, socialmedia.insta, socialmedia.wa FROM users, artist, socialmedia WHERE artist.email = users.email AND  artist.email = socialmedia.email AND approval=1 AND ad=1");

while ($con=mysqli_fetch_array($get)) {
	$id = $con['id'];
    $profilepic = $con['profilepic'];
    $name = $con['name'];
    $bio = $con['bio'];
    $fb = $con['fb'];
    $insta = $con['insta'];
    $wa = $con['wa'];
    echo "<div class='artist-card'>";
    echo "<div class='profile-image'>";
    echo "<img src='".$profilepic."'>";
    echo "</div>";
    echo "<h3>".$name."</h3>";
    echo "<div class='artist-bio'>";
    echo "<p>".$bio."</p>";
    echo "</div>";
    echo "<a href='artist-profile.php?id=".$id."' class='artist-btn'>View Profile</a>";
    echo "<div class='social-icon-box'>";
    echo "<a href='https://www.facebook.com/profile.php?id=".$fb."'><i class='fa fa-facebook-official social-icon' aria-hidden='true'></i></a>";
    echo "<a href='https://instagram.com/".$insta."'><i class='fa fa-instagram social-icon' aria-hidden='true'></i></a>";
    echo "<a href='https://wa.me/".$wa."'><i class='fa fa-whatsapp social-icon' aria-hidden='true'></i></a>";
    echo "</div>";
    echo "</div>";

}
?>  
</div>
</div>




</body>
</html>