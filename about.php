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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>
<body>

 <?php include "includes/nav.php" ?>
  <div class="page-header">
  </div>
<!-- first-row -->
  <div class="rowa about-r" >
    <div class="columna">
     <h2>Connecting art with people around the globe</h2>
      <p>Apyart is the home to the worlds best and fastest growing community of artists. Feel free to join today and be a part of this great community.</p>
    </div>

      <div class="columna">
      
    <img class='photo' src='img/placeholder.png' data-src="img/painting-tool.jpg" alt="painting-tool-apyart">
      </div>
  </div>

<!-- second-row -->
  <div class="rowa about-r" >
    <div class="columna">
    <div class="about-cards">
    <?php 
require "database/db.php";
$get2 = mysqli_query($con,"SELECT id, filename, uploader FROM artwork WHERE cat='tech' OR cat ='Landscape' OR cat ='portrait' ORDER by RAND() LIMIT 4");

while ($row = mysqli_fetch_array($get2)) {
    $art_id2 =$row['id'];
    $filename2 = $row['filename'];
    echo "<div class='about-card'><a href='artist-artwork.php?id=".$art_id2."'><img class='photo' src='img/placeholder.png' data-src='img/uploads/".$filename2."' /></a>";
?>
    </div>
    <?php }?>
    </div>
</div>
      <div class="columna">
      <h2>Let your art reach a new height</h2>
      <p>Let your art be seen and your talent be recognised around the globe. Its absolutely FREE to Submit your art in any of the apyart category.</p>
      </div>
</div>



<!-- third-row -->
  <div class="rowa about-r" >
    <div class="columna">
    
    <h2>Explore the collection</h2>
      <p>Browse through a handfull of categories and explore the beautiful arts contributed by the artists of.</p>
    </div>
    
      <div class="columna">
      <div class="about-cards">
    <?php 
require "database/db.php";
$get3 = mysqli_query($con,"SELECT * FROM artwork WHERE cat='Landscape' OR cat ='tech' OR cat ='portrait' ORDER by RAND() LIMIT 3");

while ($row = mysqli_fetch_array($get3)) {
    $art_id3 =$row['id'];
    $cat3 = $row['cat'];
    $filename3 = $row['filename'];
    echo "<div class='about-card'><a href='artist-artwork.php?id=".$art_id3."'><img class='photo' src='img/placeholder.png' data-src='img/uploads/".$filename3."' /></a><p class='cat-name'>".$cat3."</p>";
?>
    </div>
    <?php }?>
    </div>
      </div>
  </div>
<!-- fourth-row -->
  <div class="rowa about-r" >
    <div class="columna">
    <div class="about-cards">
    <?php 
require "database/db.php";
$get4 = mysqli_query($con,"SELECT * FROM artwork WHERE cat='portrait' OR cat ='Landscape' OR cat ='tech' ORDER by RAND() LIMIT 3");

while ($row = mysqli_fetch_array($get4)) {
    $art_id4 =$row['id'];
    $cat4 = $row['cat'];
    $filename4 = $row['filename'];
    echo "<div class='about-card'><a href='artist-artwork.php?id=".$art_id4."'><img class='photo' src='img/placeholder.png' data-src='img/uploads/".$filename4."' /><p class='cat-name'>".$cat4."</p></a>";
?>
    </div>
    <?php }?>
    </div>
    </div>
    
      <div class="columna">
      <h2>The perfect market place</h2>
      <p>No middle man between customers and the artists.<br>If an Artist wants to sell ,can list your art for free.</p>
      </div>
  </div>


  <div class="rowa about-r">
    <div class="columna">
      <h2>Feedbacks and suggestions are welcomed…</h2>
      <p class="sub-title">ApyArt<br>Patna, Bihar<br>India<br><a class="mail" href="mailto:contact@apyart.com">contact@apyart.com</a></p>
      <p class="sub-title">Social Links</p>
      <div class="social-box">
        <a href="#" class="fa fa-instagram social-links"></a>
        <a href="#" class="fa fa-youtube social-links"></a>
        <a href="#" class="fa fa-linkedin social-links"></a>
      </div>
      </div>
    <div class="columna" style="background-color: white;">
      <h2>Send us feedback</h2>
      <?php
include "database/db.php";

if (isset($_POST['submit'])){   
	$name = stripslashes($_POST['name']);
  $name = mysqli_real_escape_string($con,$name);      
  $message = stripslashes($_POST['message']);
  $message = mysqli_real_escape_string($con,$message); 
  $date = date("Y-m-d H:i:s");

  $query = "INSERT into `feedback` (name, msg, date) VALUES ('$name', '$message', '$date')";
  $result = mysqli_query($con,$query);
  if($result){
    $status = "Thank you for your valuable feedback";
  }
} 
?>
        <form method="POST" action="">
        <p class='sucess-form-msg'></p><?php if(isset($status)){echo $status;}?></p>
          <input type="text" name="name" placeholder="Name" required>
          <textarea type="text" name="message" placeholder="Write Feedback here"  required></textarea>
          <input type="submit" name="submit" value="SEND" class="quote-btn">
        </form>
    </div>
  </div>
</div>
</div>


<?php include "includes/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.1.0/dist/lazyload.min.js"></script>
<script src="js/lazy-load-img.js"></script>
</body>
</html>