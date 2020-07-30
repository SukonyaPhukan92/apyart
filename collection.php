<?php 
include "database/db.php";
session_start();
if(isset($_SESSION['login_user'])){
    $user_id = $_SESSION['login_user'];
  }else{
    $user_id = '';
  }

?>
<?php
$status ="";
if(!isset($_SESSION['login_user'])){
    $status = "You are not logged in yet";
}else{
}
?>
<?php
include "database/db.php";
if(isset($_SESSION['email'])){
  include "database/db.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
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
    <div class="status-box">
       <p><?php if(isset($status)){ echo $status;} ?></p>
    </div>
<div class="cards">
<?php 
include "database/db.php";
$get = mysqli_query($con,"SELECT * FROM collection WHERE user_id = '$user_id' ");
while ($con=mysqli_fetch_array($get)) {
$collection_id=$con['id'];
$artwork_id=$con['artwork_id'];
?>
<?php 
include "database/db.php";
$get2 = mysqli_query($con,"SELECT uploader, filename FROM artwork WHERE id = '$artwork_id'");
while ($con=mysqli_fetch_array($get2)) {
$uploader=$con['uploader'];
$filename=$con['filename'];
?>
<?php 
include "database/db.php";
$get3 = mysqli_query($con,"SELECT id, name FROM artist WHERE id = '$uploader'");
while ($con=mysqli_fetch_array($get3)) {
$artist_id=$con['id'];
$name=$con['name'];
?>
        <div class="card">
        <a href="artist-artwork.php?id=<?php echo $artwork_id?>"><img src="img/uploads/<?php echo $filename ?>" alt=""></a>
           <div class="collection-btn-box">
           <a href="artist-profile.php?id=<?php echo $artist_id ?>" class="artist-name"><?php echo $name;?></a>
           <a href="delete-collection.php?id=<?php echo $collection_id?>" class="delete-btn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
        </div>
<?php }?>
<?php }?>
<?php }?>
</div>
</body>
</html>