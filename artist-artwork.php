<?php 
session_start();
include "database/db.php";
?>
<?php 
include "database/db.php";
$art_id = $_REQUEST['id'];
$get = mysqli_query($con,"SELECT * FROM artwork WHERE id=$art_id");
while ($con=mysqli_fetch_array($get)) {
$uploader=$con['uploader'];
$title=$con['title'];
$cat=$con['cat'];
$tags=$con['tags'];
$filename=$con['filename'];
}
?>
<?php
include "database/db.php";
$v= "UPDATE artwork SET views = views + 1 WHERE id='$art_id'";
$con->query($v)
?>
<?php 
include "database/db.php";
$get2 = mysqli_query($con,"SELECT name FROM artist WHERE id=$uploader");
while ($con=mysqli_fetch_array($get2)) {
$artist_name=$con['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?> | ApyArt - Free stock images and illustartion</title>
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

    <div class="rowa">
    <div class="columna">
    <img src="img/uploads/<?php echo $filename;?>" alt="">
    <?php
    if(isset($_SESSION['email'])){
    $sql = "SELECT id FROM artist WHERE email = '" . $_SESSION['email'] . "' ";
    $result = $con->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $artist_id_check=$row['id'];
    if(isset($artist_id_check)){
    if($artist_id_check == $uploader){
      echo "<div class='share-collecion-box'><button class='modal-button' href='#myModal2'>Edit Intro <i class='fa fa-pencil-square-o btn-icon' aria-hidden='true'></i></button><a href='delete-artwork.php?id=$art_id&artist=$uploader' class='delete-btn'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>";
    }else{
      
    }
  }
}
    ?>
    </div>
    <div class="columna">
    <h2><?php echo $title;?></h2>
    <p class="artist-name"><?php echo $artist_name;?></p>
    <div class="like-comments-counter">
          <?php
          include "database/db.php";
          if(isset($_SESSION['login_user'])){
            $user_id = $_SESSION['login_user'];
          }else{
            $user_id = '';
          }
          // Count all likes and comments against this Artwork
          $likes_count = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id =  '$art_id' ");
          $comments_count = mysqli_query($con, "SELECT * FROM comments WHERE artwork_id = ".$art_id);
          
          // Check logged in user's likes
          $check_my_like = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$art_id." AND user_id = '$user_id' ");
          if(isset($_SESSION['email'])){
            if(mysqli_num_rows($check_my_like) == 0){
            ?>
              <span id="like_id_<?php echo $art_id ?>">
                <a onclick="Like('<?php echo $art_id ?>')" class="card-link"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            </span>
          <?php }else{ ?>
              <a class="card-link" title="Liked"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <?php } ?>  
        <?php }else{ ?> 
          <b><a href="login.php" class='card-link'><i class="fa fa-heart-o" aria-hidden="true"></i></a></b>
        <?php } ?>  
          · <span id="like_counter_<?php echo $art_id ?>"><?php echo mysqli_num_rows($likes_count); ?></span>

          &nbsp;&nbsp;&nbsp;

        <?php if(isset($_SESSION['email'])){ ?>
          <a onclick="document.getElementById('comment_input_<?php echo $art_id ?>').focus()" class="card-link"><i class="fa fa-comment-o" aria-hidden="true"></i></a> 
        <?php }else{ ?>
          <b><a href="login.php" class='card-link'><i class="fa fa-comment-o" aria-hidden="true"></i></a></b>
        <?php } ?>
          · <span id="comment_counter_<?php echo $art_id ?>"><?php echo mysqli_num_rows($comments_count); ?></span>
      </div>


      
    <a href="artist-profile.php?id=<?php echo $uploader;?>" class="join-btn">Buy Now</a>
    <p><?php if(isset($_REQUEST['msg'])){echo $_REQUEST['msg'];} ?></p>
    <div class="share-collecion-box">
    <div class="share-button">
      <span>Share</span>
      <a href="https://www.facebook.com/sharer/sharer.php?u=https://apyart.com/artist-artwork.php?id=<?php echo $art_id;?>" target="blank"><i class="fa fa-facebook-official"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="https://api.whatsapp.com/send?text=https://apyart.com/artist-artwork.php?id=<?php echo $art_id;?>" traget="blank"><i class="fa fa-whatsapp"></i></a>
    </div>
    <a href="add-to-collection.php?id=<?php echo $art_id;?>" class="add-coll-btn">Collection + </a>
    </div>
      <br>
      <hr>
      <br>

      <div class="card-comments">
        <ul class="comment-ul" id="comment_result_<?php echo $art_id ?>">
          <?php
            $comments = $con->query("SELECT * FROM comments WHERE artwork_id = ".$art_id);
            if ($comments->num_rows > 0) {
              while($comment = $comments->fetch_assoc()) {
          ?>
            <li class="list-group-item"><?php echo $comment['comment']; ?> <br> <small><?php echo date("Y M, d · h:i a", strtotime($comment['created_at'])) ?></small></li>
          <?php } }?>
        </ul>

        <?php if(isset($_SESSION['login_user'])){ ?>
          <form action="add-comment.php" method="post" class="row" onsubmit="return false;" id="comment_form_<?php echo $art_id ?>">
            <input type="hidden" name="artwork_id" value="<?php echo $art_id ?>">
            <div class="comment-input-form">
              <input type="text" name="comment" id="comment_input_<?php echo $art_id ?>" placeholder="Comment here..." style="border: 2px solid #ccc;">
            
              <input type="submit" value="Submit" onclick="Comment('<?php echo $art_id ?>')" id="comment_button_<?php echo $art_id ?>" class="btn btn-primary">
              <input type="submit" style="display: none;" id="comment_temp_<?php echo $art_id ?>" class="btn btn-primary" value="Submitting...">
            </div>
          </form>
        <?php } ?>
    </div>
    </div>
    <?php
    if($artist_id_check == $uploader){
    ?>
    <!-- edit-modal  -->
    <div id="myModal2" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Edit details</h2>
    </div>
    <div class="modal-body">
    <div class="p-edit-box">
    <?php
include "database/db.php";
if (isset($_REQUEST['artworkupdate'])) {

    $titleup = stripslashes($_POST['titleup']);
    $titleup = mysqli_real_escape_string($con,$titleup);

    $catup = stripslashes($_POST['catup']);
    $catup = mysqli_real_escape_string($con,$catup);

    $tagup = stripslashes($_POST['tagsup']);
    $tagup= mysqli_real_escape_string($con,$tagup);
	
$query ="UPDATE artwork SET title = '$titleup', cat = '$catup', tags = '$tagup' WHERE id = '$art_id'";
 
	if ($con->query($query)) {
		echo "<script type='text/javascript'>window.location='artist-artwork.php?id=".$art_id."';</script>";
	}else{
		echo "<script type='text/javascript'>window.location='index.php';</script>";
	}

}
?>
         <form action="" method="POST">
        <input type="text" name="titleup" placeholder="Artwork Title" value="<?php if(isset($title)){echo $title;}?>">
        <select name="catup" >
          <option value="<?php if(isset($cat)){echo $cat;}?>"><?php if(isset($cat)){echo $cat;}?></option>
          <option value="portrait">Portrait</option>
          <option value="Landscape">Landscape</option>
          <option value="abstract">Abstract</option>
          <option value="still life">Still Life</option>
          <option value="doodle">Doodle</option>
          <option value="mandala">Mandala</option>
          <option value="digital painting">Digital Painting</option>
          <option value="animation">Animation</option>
          <option value="vector art">Vector Art</option>
          <option value="quote">Quote</option>
          <option value="tech">Tech</option>
          <option value="craft">Craft</option>
        </select>
        <input type="text" name="tagsup" placeholder="Artwork Tags" value="<?php if(isset($tags)){echo $tags;}?>">
        <input type="submit" name="artworkupdate"  value="Confirm">
        </form>   
     </div>
    </div> 
  </div>
</div>
<?php } ?>
</div>
<h3 style='padding-left: 1rem;letter-spacing: 2px;'>Releted artwork</h3>
<div class="cards">
<?php 
require "database/db.php";
if(isset($_SESSION['login_user'])){
  $user_id = $_SESSION['login_user'];
}else{
  $user_id = '';
}

$get = mysqli_query($con,"SELECT id, filename, uploader,views FROM artwork WHERE ad = 1 AND cat = '$cat' order by views DESC Limit 6");
while ($row = mysqli_fetch_array($get)) {
    $art_id =$row['id'];
    $uploader = $row['uploader'];
    $filename = $row['filename'];
    echo "<div class='card'><a href='artist-artwork.php?id=".$art_id."'><img src='img/placeholder.png' class='photo' data-src='img/uploads/".$filename."'></a>";
?>
<?php
    echo "</div>";
    }
    
?>
</div>
<?php include "includes/footer.php"?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.1.0/dist/lazyload.min.js"></script>
<script src="js/lazy-load-img.js"></script>
<script src="js/modal.js"></script>
<script src="js/script.js"></script>
</body>
</html>