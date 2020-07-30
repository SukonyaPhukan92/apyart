<?php
session_start();
if(!isset($_SESSION["email"])){
  echo "<script type='text/javascript'>window.location='login.php';</script> ";
}
include "database/db.php";
include "artist-only.php";
?>
<?php 
$sql = "SELECT name, reg_date FROM users WHERE email = '" . $_SESSION['email'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$title_name=$row['name'];
$profilepic=$row['profilepic'];
$date=$row['reg_date'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_name; ?> | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <link rel="stylesheet" href="css/media.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ajax-library  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/profile-image.js"></script>
</head>
<body>

    <?php include "includes/nav.php" ?>
    <div class="page-header">
    </div>
    <?php
$sql = "SELECT * FROM artist  WHERE email = '" . $_SESSION['email'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$id=$row['id'];
$name=$row['name'];
$coverpic=$row['coverpic'];
$p_email=$row['email'];
$mobile=$row['mobile'];
$bio=$row['bio'];
$country=$row['country'];
$state=$row['state'];
$city=$row['city'];
?>

<div class="profile-section">

    <div class="cover-p">
    <img src="img/uploads/profile/<?php echo $coverpic; ?>" alt="cover-photo" style="position: relative;">
    </div>

    <div class="cpic-update-box" style="position: absolute; bottom:0; top:-55%;" >
      <form action="profile-cover-update.php" method="POST" enctype="multipart/form-data">
      <div class="cover-upload">
      <input type="file" name="updatecover" id="cimage"/>
      </div>
    <input type="submit" value="Update cover Pic" name="coverpic" id="cpicsubmit"/>
      </form>
    </div>
    </div>
     </div>
    <div class="profile-pic">
            <img src="<?php echo $profilepic;?>">
    </div>

    <div class="ppic-update-box">
    <form action="profile-pic-update.php" method="POST" enctype="multipart/form-data">
    <label class="fileContainer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        <input type="file" name="uploadfile" id="pimage"/> 
    </label>
    <input type="submit" value="Update profile Pic" name="profilepic" id="ppicsubmit"/>
    </form>
    </div>

    <p class="p-name"> <?php echo $name; ?></p>
    <div class="bio-box">
    <p class="p-bio"> <?php echo $bio; ?></p>
    <div class="share-collecion-box">
    <div class="share-button">
      <span>Share</span>
      <a href="https://www.facebook.com/sharer/sharer.php?u=https://apyart.com/artist-profile.php?id=<?php echo $id;?>" target="blank"><i class="fa fa-facebook-official"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="https://api.whatsapp.com/send?text=https://apyart.com/artist-profile.php?id=<?php echo $id;?>" traget="blank"><i class="fa fa-whatsapp"></i></a>
    </div>
    <div class='dropdown'>
            <button class='dropbtn' id="showdropdown"><i class="fa fa-bell" aria-hidden="true"></i></button>
            <div class='dropdown-content' id="dropdownContent">
            <a href='message.php'>Message</a>
            <?php if($_SESSION['login_type']==2){ echo "<a href='change-password.php'>Change Password</a>";} ?>
            <a href='logout.php'>Logout</a>
            </div>
          </div>
    
</div>
    </div>
</div> 

</div>

    
<div id="myModal1" class="modal">

  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Edit Bio</h2>
    </div>
    <div class="modal-body">
      <div class="p-edit-box">
        <form action="profile-update-1.php" method="POST">
        <textarea type="text" name="newbio" placeholder="Bio"><?php echo $bio; ?></textarea>
        <input name="submit" type="submit" value="Confirm">
        </form>
      </div>
    </div>
  </div>
</div>


    <div class="rowa">
        <div class="columna">
        <p class="col-title">Intro</p>
        <div class="intro-text-line">
        <i class="fa fa-location-arrow icon" aria-hidden="true"></i>
        <div class="col-text">From <?php echo $country;?>, <?php echo $state; ?></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-clock-o icon" aria-hidden="true"></i>
        <div class="col-text">Joined <?php echo $date; ?></div>
        </div>
<?php 
$sqlsocial = "SELECT * FROM socialmedia  WHERE email = '" . $_SESSION['email'] . "' ";
$result = $con->query($sqlsocial);
$row = $result->fetch_array(MYSQLI_ASSOC);
$website=$row['website'];
$fb=$row['fb'];
$insta=$row['insta'];
$wa=$row['wa'];
?>
        <div class="intro-text-line">
        <i class="fa fa-globe icon" aria-hidden="true"></i>
        <div class="col-text"><a href="<?php echo $website; ?>" target="blank"><?php echo $website; ?></a></div>
        </div>
        <!--social-media-handles -->
        <div class="intro-text-line">
        <i class="fa fa-facebook-official icon" aria-hidden="true"></i>
        <div class="col-text"><a href="https://www.facebook.com/profile.php?id=<?php echo $fb; ?>" target="blank">Facebook</a></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-instagram icon" aria-hidden="true"></i>
        <div class="col-text"><a href="https://instagram.com/<?php echo $insta; ?>" target="blank">Instagram</a></div>
        </div>

        <div class="intro-text-line">
        <i class="fa fa-whatsapp icon" aria-hidden="true"></i>
        <div class="col-text"><a href="https://wa.me/<?php echo $wa; ?>" target="blank">Whatsapp</a></div>
        </div>
        <button class="modal-button" href="#myModal1">Edit Bio <i class="fa fa-pencil-square-o btn-icon" aria-hidden="true"></i></button>

        <button class="modal-button" href="#myModal2">Edit Intro <i class="fa fa-pencil-square-o btn-icon" aria-hidden="true"></i></button>

        


<div id="myModal2" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Edit details</h2>
    </div>
    <div class="modal-body">
    <div class="p-edit-box">
         <form action="profile-update-2.php" method="POST">
        <input type="text" name="website" placeholder="Website url" value="<?php echo $website; ?>">
        <input type="text" name="fb" placeholder="Facebook Profile ID" value="<?php echo $fb; ?>">
        <input type="text" name="insta" placeholder="Instagram Username" value="<?php echo $insta; ?>">
        <input type="number" name="wa" placeholder="Whatsapp number" value="<?php echo $wa; ?>">
        <input name="linkupdate" type="submit" value="Confirm">
        </form>   
     </div>
    </div> 
  </div>
</div>
        </div>
        <div class="columna">
        <p class="col-title">My Artwork</p>
        <a href='upload.php' class='login-btn' style='display: block; text-align: center;width: 50%;margin: 20px 15px;'>Upload Artwork</a>
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

<script src="js/dropdown.js"></script>
<script src="js/modal.js"></script>
<script src="js/script.js"></script> 
</body>
</html>