<?php
session_start();
$artist_id = $_REQUEST['a'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Thank You | ApyArt</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "includes/nav.php"?>
<main class="sucess error">
  <div class="box">
  <img src="img/sucess.png" alt="error"><br>
    <h3>Thank you, we will get back to you soon!</h3>
      <div>
      <a href="artist-profile.php?id=<?php echo $artist_id;?>" class="home-btn" >go to Back</a>
      </div>
    </div>
  </main>

  <?php include "includes/footer.php"?>
</body>
</html>