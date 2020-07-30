<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vector Art | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/category.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="fonts/ComicSansMS3.ttf" rel="stylesheet"> 
</head>
<body>
    <?php include "includes/nav.php" ?>
    <div class="nav-fix">
    </div>
<?php include "includes/category-menu.php"?>
    <div class="cat-header">
    <h1>Vector Art</h1>
    <p>This is an art made with vector illustration software like
Adobe Illustrator. Vector artwork is built from vector graphics, which are
images created with mathematical formulas.</p> 
    </div>


<div class="cards">
<?php 
require "database/db.php";
if(isset($_SESSION['login_user'])){
  $user_id = $_SESSION['login_user'];
}else{
  $user_id = '';
}
$get = mysqli_query($con,"SELECT id, filename, uploader,views FROM artwork WHERE cat = 'Vector art' AND ad = 1 order by views DESC");
while ($row = mysqli_fetch_array($get)) {
    $art_id =$row['id'];
    $uploader = $row['uploader'];
    $filename = $row['filename'];
    echo "<div class='card'><a href='artist-artwork.php?id=".$art_id."'><img src='img/placeholder.png' class='photo' data-src='img/uploads/".$filename."'></a>";
    ?>
    <br>
      <div class="card-like-comments">
          <?php
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
       
    <?php
    echo "</div>";
    }
    
?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.1.0/dist/lazyload.min.js"></script>
<script src="js/lazy-load-img.js"></script>
<script src="js/script.js"></script>
</body>
</html>