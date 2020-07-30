<?php session_start();
include "database/db.php";
?>
<?php 
$id = $_REQUEST['id'];
$get = mysqli_query($con,"SELECT * FROM artist WHERE id=$id");
while ($con=mysqli_fetch_array($get)) {
$name=$con['name'];
$coverpic=$con['coverpic'];
$artist_email=$con['email'];
$mobile=$con['mobile'];
$bio=$con['bio'];
$country=$con['country'];
$state=$con['state'];
$city=$con['city'];
}
?>
<?php 
include "database/db.php";
$sql = "SELECT profilepic, reg_date FROM users WHERE email = '$artist_email' ";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$artist_profilepic=$row['profilepic'];
$date=$row['reg_date'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name;?> | ApyArt - Free stock images and illustartion</title>
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
    
<div class="profile-section">

    <div class="cover-p">
    <img src="img/uploads/profile/<?php echo $coverpic; ?>" alt="cover-photo" style="position: relative;">
    </div>
</div>
</div>
    <div class="profile-pic">
    <img src="<?php echo $artist_profilepic;?>">
    </div>

    <p class="p-name"> <?php echo $name; ?></p>
    <div class="bio-box">
    <p class="p-bio"> <?php echo $bio; ?></p>
    </div>   
    </div>
    <div class="share-button" style="margin:auto;">
      <span>Share</span>
      <a href="https://www.facebook.com/sharer/sharer.php?u=https://apyart.com/artist-profile.php?id=<?php echo $id;?>" target="blank"><i class="fa fa-facebook-official"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="https://api.whatsapp.com/send?text=https://apyart.com/artist-profile.php?id=<?php echo $id;?>" traget="blank"><i class="fa fa-whatsapp"></i></a>
    </div>
    <div class="rowa">
        <div class="columna">
        <p class="col-title">Intro</p>
        <div class="intro-text-line">
        <i class="fa fa-location-arrow irow" aria-hidden="true"></i>
        <div class="col-text">From <?php echo $country;?>, <?php echo $state; ?></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-clock-o irow" aria-hidden="true"></i>
        <div class="col-text">Joined <?php echo $date; ?></div>
        </div>
<?php 
include "database/db.php";
$sqlsocial = "SELECT email, website, fb, insta, wa FROM socialmedia WHERE email= '$artist_email' ";
$result = $con->query($sqlsocial);
$rows = $result->fetch_array(MYSQLI_ASSOC);
$website=$rows['website'];
$fb=$rows['fb'];
$insta=$rows['insta'];
$wa=$rows['wa'];
?>
        <div class="intro-text-line">
        <i class="fa fa-globe irow" aria-hidden="true"></i>
        <div class="col-text"><a href="<?php echo $website; ?>" target="blank">Website</a></div>
        </div>
        <!--social-media-handles -->
        <div class="intro-text-line">
        <i class="fa fa-facebook-official irow" aria-hidden="true"></i>
        <div class="col-text"><a href="https://www.facebook.com/profile.php?id=<?php echo $fb; ?>" target="blank">Facebook</a></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-instagram irow" aria-hidden="true"></i>
        <div class="col-text"><a href="https://instagram.com/<?php echo $insta; ?>" target="blank">Instagram</a></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-whatsapp irow" aria-hidden="true"></i>
        <div class="col-text"><a href="https://wa.me/<?php echo $wa; ?>" target="blank">Whatsapp</a></div>
        </div>
        <button class="modal-button" href="#myModal1">Contact</button>


</div>

<div id="myModal1" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Contact Artist</h2>
    </div>
    <div class="modal-body">
    <div class="p-edit-box">
    <?php
include "database/db.php";

if (isset($_POST['contactartist'])){   
	$email = stripslashes($_POST['email']);
  $email = mysqli_real_escape_string($con,$email);      
	$mobile = stripslashes($_POST['mobile']);
  $mobile = mysqli_real_escape_string($con,$mobile);
  $sub = stripslashes($_POST['sub']);
  $sub = mysqli_real_escape_string($con,$sub); 
  $message = stripslashes($_POST['message']);
  $message = mysqli_real_escape_string($con,$message); 
  $date = date("Y-m-d H:i:s");

  $query = "INSERT into `artistmsg` (artist_id, email, mobile, sub, msg, date) VALUES ('$id', '$email', '$mobile', '$sub', '$message', '$date')";
  $result = mysqli_query($con,$query);
  if($result){
    echo "<script type='text/javascript'>window.location='sucess.php?a=$id';</script> ";
  }
} 
?>
    
         <form action="" method="POST">
        <input type="email" name="email" placeholder="Email">
        <input type="number" name="mobile" placeholder="Mobile">
        <input type="text" name="sub" placeholder="subject">
        <textarea name="message" placeholder="Messsage"></textarea>
        <input name="contactartist" type="submit" value="Send">
        </form>   
     </div>
    </div> 
  </div>
</div>

        <div class="columna">
        <p class="col-title">Artwork</p>
        <div class="cards">
        <?php
        include "database/db.php";
$sqlarts = "SELECT * FROM artwork WHERE uploader = '$id'";
$result = $con->query($sqlarts);
while ($row = $result->fetch_array(MYSQLI_ASSOC)){
$art_id=$row['id'];
$art_name=$row['title'];
$artworks_src=$row['filename'];
echo "<div class='card'><a href='artist-artwork.php?id=".$art_id."'><img src='img/uploads/".$artworks_src."' loading='lazy'/></a>";

?>
<br>
      <div class="card-like-comments">
          <?php
          if(isset($_SESSION['login_user'])){
            $user_id = $_SESSION['login_user'];
          }else{
            $user_id = '';
          }
          // Count all likes and comments against this Artwork
          $likes_count = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$row['id']);
          $comments_count = mysqli_query($con, "SELECT * FROM comments WHERE artwork_id = ".$row['id']);
          
          // Check logged in user's likes
          $check_my_like = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$row['id']." AND user_id = ".$user_id);
          if(isset($_SESSION['email'])){
            if(mysqli_num_rows($check_my_like) == 0){
            ?>
              <span id="like_id_<?php echo $row['id'] ?>">
                <a onclick="Like('<?php echo $row['id'] ?>')" class="card-link"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            </span>
          <?php }else{ ?>
              <a class="card-link" title="Liked"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <?php } ?>  
        <?php }else{ ?> 
          <b><a href="login.php" class='card-link'><i class="fa fa-heart-o" aria-hidden="true"></i></a></b>
        <?php } ?>  
          · <span id="like_counter_<?php echo $row['id'] ?>"><?php echo mysqli_num_rows($likes_count); ?></span>

          &nbsp;&nbsp;&nbsp;

        <?php if(isset($_SESSION['email'])){ ?>
          <a onclick="document.getElementById('comment_input_<?php echo $row['id'] ?>').focus()" class="card-link"><i class="fa fa-comment-o" aria-hidden="true"></i></a> 
        <?php }else{ ?>
          <b><a href="login.php" class='card-link'><i class="fa fa-comment-o" aria-hidden="true"></i></a></b>
        <?php } ?>
          · <span id="comment_counter_<?php echo $row['id'] ?>"><?php echo mysqli_num_rows($comments_count); ?></span>
      </div>
</div>
<?php }?>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/script.js"></script>
<script src="js/modal.js"></script>
</body>
</html>